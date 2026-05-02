<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';
header('Content-Type: application/json');

$id     = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$limit  = isset($_GET['limit']) ? max(1, (int)$_GET['limit']) : 10;
$page   = max(1, (int)($_GET['page'] ?? 1));
$search = trim($_GET['search'] ?? '');
$offset = ($page - 1) * $limit;

$where = "WHERE r.is_budget_released = 1";
$params = [];
$types = '';

if ($id > 0) {
    $where .= " AND r.id = ?";
    $params[] = $id;
    $types .= 'i';
}
elseif ($search !== '') {
    $where .= " AND (
        r.project_resolution_title LIKE ? 
        OR r.resolution_summary LIKE ? 
        OR r.id LIKE ?
    )";
    $like = "%$search%";
    $params[] = $like;
    $params[] = $like;
    $params[] = $like;
    $types .= 'sss';
}


$totalSql = "SELECT COUNT(*) AS total 
             FROM resolution r
             LEFT JOIN liquidation_of_expenses l ON r.id = l.project_resolution_id
             $where";

$totalStmt = $conn->prepare($totalSql);
if (!empty($types)) {
    $totalStmt->bind_param($types, ...$params);
}
$totalStmt->execute();
$total = (int)$totalStmt->get_result()->fetch_assoc()['total'];

$sql = "SELECT 
            r.id AS proj_id,
            r.project_resolution_title,
            r.estimated_budget,
            r.status AS res_status,
            l.id AS liq_id,
            l.status AS liq_status,
            r.is_budget_released,
            r.date_created
        FROM resolution r
        LEFT JOIN liquidation_of_expenses l ON r.id = l.project_resolution_id
        $where
        ORDER BY r.id DESC
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
    $row['res_status']       = (int)$row['res_status'];
    $row['liq_status']       = $row['liq_status'] !== null ? (int)$row['liq_status'] : null;
    $row['is_budget_released'] = (bool)$row['is_budget_released'];
    $row['date_created']     = $row['date_created'];

    $resolutions[] = $row;
}

if ($id > 0) {
    echo json_encode([
        'success' => count($resolutions) > 0,
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