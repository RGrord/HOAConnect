<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';

$limit  = (int)($_GET['limit'] ?? 10);
$page   = max(1, (int)($_GET['page'] ?? 1));
$search = trim($_GET['search'] ?? '');
$offset = ($page - 1) * $limit;

$where = '';
$params = [];
$types  = '';

if ($search !== '') {
    $where = "AND (
        CONCAT(i.first_name, ' ', i.middle_name, ' ', i.last_name) LIKE ?
        OR u.email_address LIKE ?
    )";
    
    $searchTerm = "%$search%";
    $params = [$searchTerm, $searchTerm];
    $types = 'ss';
}

$totalSql = "
    SELECT COUNT(*) AS total
    FROM users u
    LEFT JOIN user_info i ON u.user_id = i.user_id
    LEFT JOIN roles r ON u.role_id = r.id
    WHERE u.role_id = 6 $where
";

$totalStmt = mysqli_prepare($conn, $totalSql);

if ($types) {
    $refs = []; 
    foreach ($params as $k => $v) {
        $refs[$k] = &$params[$k];
    }
    call_user_func_array([$totalStmt, 'bind_param'], array_merge([$types], $refs));
}

mysqli_stmt_execute($totalStmt);
$total = mysqli_fetch_assoc(mysqli_stmt_get_result($totalStmt))['total'];
$totalPages = ceil($total / $limit);

$sql = "
    SELECT 
        u.id,
        u.user_id,
        u.role_id,
        u.email_address,
        u.status AS raw_status,
        CONCAT(i.first_name, ' ', i.middle_name, ' ', i.last_name) AS fullName,
        r.name AS role_name,
        CASE WHEN u.status = 1 THEN 'Active' ELSE 'Inactive' END AS status
    FROM users u
    LEFT JOIN user_info i ON u.user_id = i.user_id
    LEFT JOIN roles r ON u.role_id = r.id
    WHERE u.role_id = 6 $where
    ORDER BY id DESC
    LIMIT ?
    OFFSET ?
";

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