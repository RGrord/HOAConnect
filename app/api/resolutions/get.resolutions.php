<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';

header('Content-Type: application/json');

$id     = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$limit  = isset($_GET['limit']) ? max(1, (int)$_GET['limit']) : 10;
$page   = max(1, (int)($_GET['page'] ?? 1));
$search = trim($_GET['search'] ?? '');
$offset = ($page - 1) * $limit;

$role = $_SESSION['role'];

$where = '';
$params = [];
$types = '';

if ($role == 4) {
    $where = "WHERE r.status = 1 AND is_budget_released = 1 OR is_budget_released IS NULL";
} else if ($role == 3 || $role == 5 || $role == 6) {
    $where = "WHERE r.status = 1 AND is_budget_released = 1";
} else {
    $where = "";
}

if ($id > 0) {
    if ($where) $where .= " AND r.id = ?";
    else $where = "WHERE r.id = ?";
    $params[] = $id;
    $types .= 'i';
}
elseif ($search !== '') {
    if ($where) {
        $where .= " AND (r.project_resolution_title LIKE ? 
                        OR r.resolution_summary LIKE ? 
                        OR r.id LIKE ? 
                        OR r.proposed_by LIKE ?)";
    } else {
        $where = "WHERE (r.project_resolution_title LIKE ? 
                        OR r.resolution_summary LIKE ? 
                        OR r.id LIKE ? 
                        OR r.proposed_by LIKE ?)";
    }
    $like = "%$search%";
    $params[] = $like;
    $params[] = $like;
    $params[] = $like;
    $params[] = $like;
    $types .= 'ssss';
}



$totalSql = "SELECT COUNT(*) AS total FROM resolution r $where";
$totalStmt = $conn->prepare($totalSql);
if (!empty($types)) {
    $totalStmt->bind_param($types, ...$params);
}
$totalStmt->execute();
$totalRow = $totalStmt->get_result()->fetch_assoc();
$total = (int)$totalRow['total'];

$sql = "SELECT 
            r.id,
            r.project_resolution_title,
            r.resolution_summary,
            r.estimated_budget,
            r.target_start_date,
            r.target_end_date,
            r.proposed_by,
            r.project_proposal_document,
            r.upload_signed_resolution,
            r.status,
            r.has_financial_summary,
            r.is_budget_released,
            r.created_by,
            r.date_created,
            fs.has_validated,
            lq.status AS liquidation_status,
            CONCAT(u.first_name, ' ', u.last_name) AS creator_name
        FROM resolution r
        LEFT JOIN financial_summary fs ON r.id = fs.project_id
        LEFT JOIN liquidation_of_expenses lq ON r.id = lq.project_resolution_id
        LEFT JOIN user_info u ON r.created_by = u.user_id
        $where
        ORDER BY r.date_created DESC, r.id DESC
        LIMIT ? OFFSET ?";

$stmt = $conn->prepare($sql);

$bindParams = $params;
$bindParams[] = $limit;
$bindParams[] = $offset;
$bindTypes = $types . 'ii';

$stmt->bind_param($bindTypes, ...$bindParams);
$stmt->execute();
$result = $stmt->get_result();

$resolutions = [];
while ($row = $result->fetch_assoc()) {
    $row['estimated_budget'] = $row['estimated_budget'] ? (float)$row['estimated_budget'] : null;
    $row['status'] = (int)$row['status'];
    $row['has_financial_summary'] = (bool)$row['has_financial_summary'];
    $row['is_budget_released'] = (bool)$row['is_budget_released'];
    
    $row['target_start_date'] = $row['target_start_date'] ?: null;
    $row['target_end_date']   = $row['target_end_date'] ?: null;
    $row['date_created']      = $row['date_created'];

    $resolutions[] = $row;
}

if ($id > 0) {
    echo json_encode([
        'success' => true,
        'data'    => $resolutions[0] ?? null
    ]);
} else {
    echo json_encode([
        'success' => true,
        'data'    => $resolutions,
        'pagination' => [
            'totalRecords' => $total,
            'totalPages'   => max(1, ceil($total / $limit)),
            'currentPage'  => $page,
            'limit'        => $limit
        ]
    ]);
}

$conn->close();
?>