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
    $where = "WHERE (fee_name LIKE ? OR `status` LIKE ?)";
    $params = ["%$search%", "%$search%"];
    $types = 'ss';
}

$totalSql = "SELECT COUNT(*) AS total 
  FROM fee_type $where";
$totalStmt = mysqli_prepare($conn, $totalSql);
if ($types) {
    $refs = []; foreach ($params as $k => $v) $refs[$k] = &$params[$k];
    call_user_func_array([$totalStmt, 'bind_param'], array_merge([$types], $refs));
}
mysqli_stmt_execute($totalStmt);
$total = mysqli_fetch_assoc(mysqli_stmt_get_result($totalStmt))['total'];
$totalPages = ceil($total / $limit);

$sql = "SELECT * FROM fee_type 
  $where 
  ORDER BY id DESC 
  LIMIT ? 
  OFFSET ?";
$stmt = mysqli_prepare($conn, $sql);

$bindParams = array_merge($params, [$limit, $offset]);
$bindTypes = $types . 'ii';
$refs = []; foreach ($bindParams as $k => $v) $refs[$k] = &$bindParams[$k];

call_user_func_array(
    [$stmt, 'bind_param'],
    array_merge([$bindTypes], $refs)
);

mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$users = [];
while ($row = mysqli_fetch_assoc($result)) {
  $row['status'] = match ($row['status']) {
      0 => 'Pending',
      1 => 'Active',
      2 => 'Inactive',
      3 => 'Rejected',
      default => 'Unknown',
  };
  $users[] = $row;
}

json_success([
    'data' => $users,
    'pagination' => [
        'totalRecords' => (int)$total,
        'totalPages' => $totalPages,
        'currentPage' => $page,
        'limit' => $limit
    ]
]);