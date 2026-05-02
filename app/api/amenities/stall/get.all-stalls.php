<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';

header('Content-Type: application/json');

$limit  = (int)($_GET['limit'] ?? 10);
$page   = max(1, (int)($_GET['page'] ?? 1));
$search = trim($_GET['search'] ?? '');
$offset = ($page - 1) * $limit;

$where = '';
$params = [];
$types = '';

if ($search !== '') {
    $where = "AND (stall_no LIKE ? OR `status` LIKE ? OR date_created LIKE ?)";
    $params = ["%$search%", "%$search%", "%$search%", "%$search%"];
    $types = 'ssss';
}

$totalSql = "SELECT COUNT(*) AS total FROM stalls WHERE 1=1 $where";
$totalStmt = mysqli_prepare($conn, $totalSql);
if ($types) {
    $refs = [];
    foreach ($params as $k => $v) $refs[$k] = &$params[$k];
    call_user_func_array([$totalStmt, 'bind_param'], array_merge([$types], $refs));
}
mysqli_stmt_execute($totalStmt);
$totalResult = mysqli_stmt_get_result($totalStmt);
$total = mysqli_fetch_assoc($totalResult)['total'];
$totalPages = ceil($total / $limit);

$sql = "SELECT *
FROM stalls
WHERE 1=1 $where
ORDER BY id DESC
LIMIT ? OFFSET ?";

$stmt = mysqli_prepare($conn, $sql);

$bindParams = array_merge($params, [$limit, $offset]);
$bindTypes = $types . 'ii';
$refs = [];
foreach ($bindParams as $k => $v) $refs[$k] = &$bindParams[$k];
call_user_func_array([$stmt, 'bind_param'], array_merge([$bindTypes], $refs));

mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$rentals = [];
while ($row = mysqli_fetch_assoc($result)) {
    $rentals[] = $row;
}

// Return JSON
echo json_encode([
    'success' => true,
    'data' => $rentals,
    'pagination' => [
        'totalRecords' => (int)$total,
        'totalPages' => $totalPages,
        'currentPage' => $page,
        'limit' => $limit
    ]
]);
?>
