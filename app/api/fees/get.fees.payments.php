<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';

header('Content-Type: application/json');

$limit  = (int)($_GET['limit'] ?? 10);
$page   = max(1, (int)($_GET['page'] ?? 1));
$search = trim($_GET['search'] ?? '');
$offset = ($page - 1) * $limit;

$where = "WHERE hf.user_id IS NOT NULL";
$params = [];
$types = '';

if ($search !== '') {
    $where .= " AND (hf.remarks LIKE ? OR pv.payment_for LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
    $types .= 'ss';
}

$totalSql = "
SELECT COUNT(*) AS total
FROM homeowner_fees hf
LEFT JOIN payment_verification pv
    ON pv.user_id = hf.user_id
    AND pv.payment_for = hf.remarks
$where
";
$totalStmt = mysqli_prepare($conn, $totalSql);
if ($types !== '') {
    $refs = [];
    foreach ($params as $k => $v) $refs[$k] = &$params[$k];
    call_user_func_array([$totalStmt, 'bind_param'], array_merge([$types], $refs));
}
mysqli_stmt_execute($totalStmt);
$totalResult = mysqli_stmt_get_result($totalStmt);
$totalRow = mysqli_fetch_assoc($totalResult);
$total = (int)$totalRow['total'];
$totalPages = max(1, ceil($total / $limit));

$sql = "
SELECT
    hf.id AS fee_id,
    hf.user_id,
    hf.amount_paid,
    hf.status AS fee_status,
    hf.remarks,
    hf.date_created AS fee_date,
    pv.id AS payment_id,
    pv.payment_for,
    pv.amount AS paid_amount,
    pv.status AS payment_status,
    pv.date_created AS payment_date
FROM homeowner_fees hf
LEFT JOIN payment_verification pv
    ON pv.user_id = hf.user_id
    AND pv.payment_for = hf.remarks
$where
ORDER BY hf.date_created DESC
LIMIT ? OFFSET ?
";

$stmt = mysqli_prepare($conn, $sql);
$bindParams = $params;
$bindParams[] = $limit;
$bindParams[] = $offset;
$bindTypes = $types . 'ii';
$refs = [];
foreach ($bindParams as $k => $v) $refs[$k] = &$bindParams[$k];
call_user_func_array([$stmt, 'bind_param'], array_merge([$bindTypes], $refs));

mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$records = [];
while ($row = mysqli_fetch_assoc($result)) {
    $records[] = [
        'fee_id'        => (int)$row['fee_id'],
        'user_id'       => (int)$row['user_id'],
        'amount_due'    => (float)$row['amount_paid'],
        'fee_status'    => (int)$row['fee_status'],
        'remarks'       => $row['remarks'],
        'fee_date'      => $row['fee_date'],
        'payment_id'    => $row['payment_id'] ? (int)$row['payment_id'] : null,
        'payment_for'   => $row['payment_for'],
        'paid_amount'   => $row['paid_amount'] !== null ? (float)$row['paid_amount'] : null,
        'payment_status'=> $row['payment_status'] !== null ? (int)$row['payment_status'] : null,
        'payment_date'  => $row['payment_date']
    ];
}

echo json_encode([
    'success' => true,
    'data' => $records,
    'pagination' => [
        'totalRecords' => $total,
        'totalPages' => $totalPages,
        'currentPage' => $page,
        'limit' => $limit
    ]
]);
