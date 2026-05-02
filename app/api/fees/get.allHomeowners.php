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
    $where = "AND (CONCAT(i.first_name, ' ', i.middle_name, ' ', i.last_name) LIKE ? OR u.email_address LIKE ?)";
    $params = ["%$search%", "%$search%"];
    $types = 'ss';
}

$totalSql = "SELECT COUNT(DISTINCT u.user_id) AS total 
    FROM users u 
    LEFT JOIN user_info i ON u.user_id = i.user_id 
    WHERE u.role_id = 6 $where";

$totalStmt = mysqli_prepare($conn, $totalSql);
if ($types) {
    $refs = [];
    foreach ($params as $k => $v) $refs[$k] = &$params[$k];
    call_user_func_array([$totalStmt, 'bind_param'], array_merge([$types], $refs));
}
mysqli_stmt_execute($totalStmt);
$total = mysqli_fetch_assoc(mysqli_stmt_get_result($totalStmt))['total'];
$totalPages = ceil($total / $limit);

$sql = "SELECT 
            u.user_id,
            u.email_address,
            u.status AS user_status,
            CONCAT(i.first_name, ' ', COALESCE(i.middle_name,''), ' ', i.last_name) AS full_name,
            f.due_id,
            f.fee_name,
            f.fee_type_id,
            f.amount,
            f.status AS fee_status,
            f.next_due_date,
            f.date_created
        FROM users u 
        LEFT JOIN user_info i ON u.user_id = i.user_id 
        LEFT JOIN fees f ON u.user_id = f.user_id
        WHERE u.role_id = 6 AND u.status = 1 $where
        ORDER BY full_name, f.date_created DESC
        LIMIT ? OFFSET ?";

$stmt = mysqli_prepare($conn, $sql);

$bindParams = array_merge($params, [$limit, $offset]);
$bindTypes = $types . 'ii';
$refs = [];
foreach ($bindParams as $k => $v) $refs[$k] = &$bindParams[$k];

call_user_func_array([$stmt, 'bind_param'], array_merge([$bindTypes], $refs));
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$homeowners = [];

while ($row = mysqli_fetch_assoc($result)) {
  $userId = $row['user_id'];

  if (!isset($homeowners[$userId])) {
    $homeowners[$userId] = [
      'user_id'      => $userId,
      'name'         => $row['full_name'],
      'email'        => $row['email_address'],
      'status'       => $row['user_status'] == 1 ? 'Active' : 'Inactive',
      'fees'         => []
    ];
  }
  if ($row['due_id'] !== null) {
    $homeowners[$userId]['fees'][] = [
      'due_id'        => $row['due_id'],
      'fee_name'      => $row['fee_name'],
      'fee_type_id'   => $row['fee_type_id'],
      'amount'        => (float)$row['amount'],
      'status'        => match ((int)$row['fee_status']) {
          0 => 'Pending',
          1 => 'Paid',
          2 => 'Overdue',
          3 => 'Waived',
          4 => 'Cancelled',
          default => 'Unknown',
      },
      'next_due_date' => $row['next_due_date'],
      'date_created'  => $row['date_created']
    ];
  }
}

$homeowners = array_values($homeowners);

json_success([
    'data' => $homeowners,
    'pagination' => [
        'totalRecords' => (int)$total,
        'totalPages'   => $totalPages,
        'currentPage'  => $page,
        'limit'        => $limit
    ]
]);