<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';

$limit  = (int)($_GET['limit'] ?? 10);
$page   = max(1, (int)($_GET['page'] ?? 1));
$search = trim($_GET['search'] ?? '');
$offset = ($page - 1) * $limit;

$where = 'WHERE u.role_id = 6 AND u.status = 1';
$params = [];
$types = '';

if ($search !== '') {
    $where .= " AND (CONCAT(ui.first_name, ' ', ui.middle_name, ' ', ui.last_name) LIKE ? OR u.email_address LIKE ?)";
    $params = ["%$search%", "%$search%"];
    $types = 'ss';
}

$totalSql = "SELECT COUNT(*) AS total
    FROM users u
    LEFT JOIN user_info i ON u.user_id = i.user_id
    LEFT JOIN roles r ON u.role_id = r.id
    $where";

$totalStmt = mysqli_prepare($conn, $totalSql);
if (!empty($types)) {
    $refs = []; foreach ($params as $k => $v) $refs[$k] = &$params[$k];
    call_user_func_array([$totalStmt, 'bind_param'], array_merge([$types], $refs));
}
mysqli_stmt_execute($totalStmt);
$total = mysqli_fetch_assoc(mysqli_stmt_get_result($totalStmt))['total'];
$totalPages = ceil($total / $limit);

$sql = "
SELECT 
    u.user_id AS id,
    CONCAT(ui.first_name, ' ', ui.middle_name, ' ', ui.last_name) AS fullName,
    u.email_address,
    SUM(fa.amount) AS total_unpaid_amount,
    CASE 
        WHEN COUNT(CASE WHEN fa.status = 0 THEN 1 END) > 0 THEN 0 
        WHEN COUNT(CASE WHEN fa.status = 4 THEN 1 END) > 0 THEN 4 
        ELSE 1 
    END AS status,
    MIN(fa.due_date) AS next_due_date
FROM fee_assignments fa
LEFT JOIN users u ON fa.user_id = u.user_id
LEFT JOIN user_info ui ON ui.user_id = u.user_id
WHERE u.role_id = 6 AND u.status = 1
GROUP BY u.user_id
ORDER BY ui.last_name, ui.first_name
LIMIT ? OFFSET ?";

$stmt = mysqli_prepare($conn, $sql);
$bindParams = array_merge($params, [$limit, $offset]);
$bindTypes = $types . 'ii';
$refs = []; foreach ($bindParams as $k => $v) $refs[$k] = &$bindParams[$k];
call_user_func_array([$stmt, 'bind_param'], array_merge([$bindTypes], $refs));

mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$users = [];
while ($row = mysqli_fetch_assoc($result)) {
    $status = '';
    switch ($row['status']) {
        case 1:
            $status = 'Paid';
            break;
        case 0:
            $status = 'Unpaid';
            break;
        case 4:
            $status = 'Waiting for Approval';
            break;
        default:
            $status = 'Unknown';
            break;
    }
    $row['status'] = $status;

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
