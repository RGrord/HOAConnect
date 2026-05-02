<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';

header('Content-Type: application/json');

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$limit = (int)($_GET['limit'] ?? 10);
$page = max(1, (int)($_GET['page'] ?? 1));
$search = trim($_GET['search'] ?? '');
$offset = ($page - 1) * $limit;

$where = '';
$params = [];
$types = '';

if ($id > 0) {
    $where = "WHERE r.id = ?";
    $params[] = $id;
    $types .= 'i';
} else if ($search !== '') {
    $where = "WHERE r.particular LIKE ?";
    $params[] = "%$search%";
    $types .= 's';
}

$totalSql = "SELECT COUNT(*) AS total FROM remittance r $where";
$totalStmt = mysqli_prepare($conn, $totalSql);

if (!empty($types)) {
    $refs = [];
    foreach ($params as $k => $v) { $refs[$k] = &$params[$k]; }
    call_user_func_array([$totalStmt,'bind_param'], array_merge([$types], $refs));
}

mysqli_stmt_execute($totalStmt);
$totalResult = mysqli_stmt_get_result($totalStmt);
$total = ($row = mysqli_fetch_assoc($totalResult)) ? (int)$row['total'] : 0;

$sql = "SELECT r.id, r.user_id, r.particular, r.amount, r.date, r.transaction_type, r.status, r.date_created,
        CONCAT(u.first_name, ' ', COALESCE(u.middle_name, ''), ' ', u.last_name) AS full_name
        FROM remittance r
        LEFT JOIN user_info u ON r.user_id = u.user_id
        $where
        ORDER BY r.id DESC
        LIMIT ? OFFSET ?";

$stmt = mysqli_prepare($conn, $sql);

$bindParams = $params;
$bindParams[] = $limit;
$bindParams[] = $offset;
$bindTypes = $types . 'ii';

$refs = [];
foreach ($bindParams as $k => $v) { $refs[$k] = &$bindParams[$k]; }
call_user_func_array([$stmt,'bind_param'], array_merge([$bindTypes], $refs));

mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$records = [];
while ($row = mysqli_fetch_assoc($result)) {
    $row['amount'] = (float)$row['amount'];
    $row['status'] = (int)$row['status'];
    $records[] = $row;
}

if ($id > 0) {
    echo json_encode([
        'success' => true,
        'data' => $records[0] ?? null
    ]);
} else {
    echo json_encode([
        'success' => true,
        'data' => $records,
        'pagination' => [
            'totalRecords' => $total,
            'totalPages' => max(1, ceil($total / $limit)),
            'currentPage' => $page,
            'limit' => $limit
        ]
    ]);
}
?>
