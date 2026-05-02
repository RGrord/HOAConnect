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
    $where = " WHERE (CONCAT(u.first_name, ' ', COALESCE(u.middle_name,''), ' ', u.last_name) LIKE ? 
        OR f.fee_name LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
    $types = 'ss';
}

$totalSql = "SELECT COUNT(*) AS total 
  FROM fees f 
  LEFT JOIN monthly_dues m ON f.due_id = m.id
  LEFT JOIN user_info u ON f.user_id = u.user_id
  $where";

$totalStmt = mysqli_prepare($conn, $totalSql);

if ($types !== '') {
    $refs = [];
    foreach ($params as $k => $v) {
        $refs[$k] = &$params[$k];
    }
    call_user_func_array([$totalStmt, 'bind_param'], array_merge([$types], $refs));
}

mysqli_stmt_execute($totalStmt);
$totalResult = mysqli_stmt_get_result($totalStmt);
$totalRow = mysqli_fetch_assoc($totalResult);
$total = (int)$totalRow['total'];
$totalPages = max(1, ceil($total / $limit));

$sql = "SELECT 
            f.id,
            f.user_id,
            f.due_id,
            f.fee_name,
            f.fee_type_id,
            f.amount,
            f.status,
            f.next_due_date,
            f.date_created,
            m.due_name,
            CONCAT(u.first_name, ' ', COALESCE(u.middle_name,''), ' ', u.last_name) AS fullName
        FROM fees f 
        LEFT JOIN monthly_dues m ON f.due_id = m.id
        LEFT JOIN user_info u ON f.user_id = u.user_id
        $where
        ORDER BY f.id DESC
        LIMIT ? OFFSET ?";

$stmt = mysqli_prepare($conn, $sql);

$bindParams = $params;
$bindParams[] = $limit;
$bindParams[] = $offset;
$bindTypes = $types . 'ii';

$refs = [];
foreach ($bindParams as $k => $v) {
    $refs[$k] = &$bindParams[$k];
}

call_user_func_array([$stmt, 'bind_param'], array_merge([$bindTypes], $refs));

mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$fees = [];
while ($row = mysqli_fetch_assoc($result)) {
  $row['status'] = match ((int)$row['status']) {
      0 => 'Pending',
      1 => 'Paid',
      2 => 'Overdue',
      3 => 'Waived',
      4 => 'Cancelled',
      default => 'Unknown',
  };
  $row['fee_type'] = match((int)$row['fee_type_id']) {
    1 => 'Monthly Fee',
    2 => 'One Time Fee',
  };

  $fees[] = $row;
}

json_success([
    'data' => $fees,
    'pagination' => [
        'totalRecords' => $total,
        'totalPages' => $totalPages,
        'currentPage' => $page,
        'limit' => $limit
    ]
]);