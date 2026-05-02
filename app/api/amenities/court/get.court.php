<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';

$limit  = (int)($_GET['limit'] ?? 10);
$page   = max(1, (int)($_GET['page'] ?? 1));
$search = trim($_GET['search'] ?? '');
$offset = ($page - 1) * $limit;

$where = '';
$params = [];
$types = '';

if ($search !== '') {
    $where = "AND (renter_name LIKE ? OR contact_no LIKE ? OR purpose LIKE ? OR `start_date` LIKE ? OR end_date LIKE ?)";
    $params = ["%$search%", "%$search%", "%$search%" , "%$search%", "%$search%"];
    $types = 'sssss';
}

$totalSql = "SELECT COUNT(*) AS total FROM court WHERE 1=1 $where";
$totalStmt = mysqli_prepare($conn, $totalSql);
if ($types) {
    $refs = []; foreach ($params as $k => $v) $refs[$k] = &$params[$k];
    call_user_func_array([$totalStmt, 'bind_param'], array_merge([$types], $refs));
}
mysqli_stmt_execute($totalStmt);
$total = mysqli_fetch_assoc(mysqli_stmt_get_result($totalStmt))['total'];
$totalPages = ceil($total / $limit);

$sql = "SELECT * FROM court WHERE 1=1 $where ORDER BY id DESC LIMIT ? OFFSET ?";
$stmt = mysqli_prepare($conn, $sql);

$bindParams = array_merge($params, [$limit, $offset]);
$bindTypes = $types . 'ii';
$refs = []; foreach ($bindParams as $k => $v) $refs[$k] = &$bindParams[$k];
call_user_func_array([$stmt, 'bind_param'], array_merge([$bindTypes], $refs));

mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$rentals = [];
while ($row = mysqli_fetch_assoc($result)) {
    $rentals[] = $row;
}

json_success([
    'data' => $rentals,
    'pagination' => [
        'totalRecords' => (int)$total,
        'totalPages' => $totalPages,
        'currentPage' => $page,
        'limit' => $limit
    ]
]);
