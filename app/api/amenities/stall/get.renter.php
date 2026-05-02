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
    $where = "AND (sr.renter_name LIKE ? OR sr.contact_no LIKE ? OR sr.start_date LIKE ? OR sr.end_date LIKE ?)";
    $params = ["%$search%", "%$search%", "%$search%", "%$search%"];
    $types = 'ssss';
}

// Total count
$totalSql = "SELECT COUNT(*) AS total FROM stall_renter sr WHERE 1=1 $where";
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

// Fetch records
$sql = "SELECT
    sr.id,
    sr.renter_name,
    sr.contact_no,
    sr.stall_id,
    sr.rental_duration,
    sr.start_date,
    sr.end_date,
    sr.amount,
    sr.contract,
    sr.status,
    sr.remarks,
    sr.date_created,
    s.stall_no AS stall_number,
    s.status AS stall_status
FROM stall_renter sr
INNER JOIN stalls s ON sr.stall_id = s.id
WHERE 1=1 $where
ORDER BY sr.id DESC
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
