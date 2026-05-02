<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';

$limit  = (int)($_GET['limit'] ?? 10);
$page   = max(1, (int)($_GET['page'] ?? 1));
$search = trim($_GET['search'] ?? '');
$offset = ($page - 1) * $limit;

$where = '';
$params = [];
$types = '';

// Dynamic search
if ($search !== '') {
    $where = "AND (
      a.action LIKE ? OR 
      a.ip_address LIKE ? OR 
      a.user_agent LIKE ? OR
      a.description LIKE ? OR
      DATE(a.created_at) LIKE ? OR
      u.first_name LIKE ? OR
      u.last_name LIKE ? OR
      CONCAT(u.first_name, ' ', u.last_name) LIKE ?
    )";

    $params = array_fill(0, 8, "%$search%");
    $types = str_repeat('s', count($params));
}


$totalSql = "SELECT COUNT(*) AS total 
  FROM activity_logs a
  LEFT JOIN user_info u ON a.user_id = u.user_id
  WHERE 1=1 $where";
$totalStmt = mysqli_prepare($conn, $totalSql);

if ($types) {
    $refs = []; 
    foreach ($params as $k => $v) $refs[$k] = &$params[$k];
    call_user_func_array([$totalStmt, 'bind_param'], array_merge([$types], $refs));
}

mysqli_stmt_execute($totalStmt);
$total = mysqli_fetch_assoc(mysqli_stmt_get_result($totalStmt))['total'];
$totalPages = ceil($total / $limit);

$sql = "SELECT a.*, u.first_name, u.last_name, CONCAT(u.first_name, ' ', u.last_name) AS full_name
        FROM activity_logs a
        LEFT JOIN user_info u ON a.user_id = u.user_id
        WHERE 1=1 $where
        ORDER BY a.created_at DESC
        LIMIT ? OFFSET ?";

$stmt = mysqli_prepare($conn, $sql);

$bindParams = array_merge($params, [$limit, $offset]);
$bindTypes = $types . 'ii';

$refs = [];
foreach ($bindParams as $k => $v) $refs[$k] = &$bindParams[$k];
call_user_func_array([$stmt, 'bind_param'], array_merge([$bindTypes], $refs));

mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$logs = [];
while ($row = mysqli_fetch_assoc($result)) {
    $row['full_name'] = trim(($row['first_name'] ?? '') . ' ' . ($row['last_name'] ?? ''));
    $logs[] = $row;
}

json_success([
    'data' => $logs,
    'pagination' => [
        'totalRecords' => (int)$total,
        'totalPages'   => $totalPages,
        'currentPage'  => $page,
        'limit'        => $limit
    ]
]);
