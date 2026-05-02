<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';
header('Content-Type: application/json');

$limit  = (int)($_GET['limit'] ?? 10);
$page   = max(1, (int)($_GET['page'] ?? 1));
$search = trim($_GET['search'] ?? '');
$offset = ($page - 1) * $limit;

$where = " WHERE status = 0 ";
$params = [];
$types = "";

if ($search !== "") {
    $where .= " AND (
        CONCAT(u.first_name, ' ', COALESCE(u.middle_name,''), ' ', u.last_name) LIKE ?
        OR pv.ref_no LIKE ?
        OR pv.payment_for LIKE ?
    )";

    $params[] = "%$search%";
    $params[] = "%$search%";
    $params[] = "%$search%";
    $types .= "sss";
}

$totalSql = "
    SELECT COUNT(*) AS total
    FROM payment_verification pv
    LEFT JOIN user_info u ON pv.user_id = u.user_id
    $where
";

$totalStmt = $conn->prepare($totalSql);
if ($types !== "") {
    $totalStmt->bind_param($types, ...$params);
}
$totalStmt->execute();
$total = (int)$totalStmt->get_result()->fetch_assoc()['total'];
$totalStmt->close();


$sql = "
    SELECT 
        pv.id,
        pv.user_id,
        pv.payment_for,
        pv.amount,
        pv.status,
        pv.ref_no,
        pv.date_created,
        CONCAT(u.first_name,' ',COALESCE(u.middle_name,''),' ',u.last_name) AS full_name
    FROM payment_verification pv
    LEFT JOIN user_info u ON pv.user_id = u.user_id
    $where
    ORDER BY pv.id DESC
    LIMIT ? OFFSET ?
";

$allParams = $params;
$allParams[] = $limit;
$allParams[] = $offset;

$stmt = $conn->prepare($sql);
$stmt->bind_param($types . "ii", ...$allParams);
$stmt->execute();

$result = $stmt->get_result();

$records = [];
while ($row = $result->fetch_assoc()) {
    $records[] = [
        "id" => (int)$row['id'],
        "user_id" => $row['user_id'],
        "full_name" => $row['full_name'],
        "payment_for" => $row['payment_for'],
        "amount" => (float)$row['amount'],
        "status" => (int)$row['status'],
        "ref_no" => $row['ref_no'],
        "date_created" => $row['date_created']
    ];
}

echo json_encode([
    "success" => true,
    "data" => $records,
    "pagination" => [
        "totalRecords" => $total,
        "totalPages" => max(1, ceil($total / $limit)),
        "currentPage" => $page,
        "limit" => $limit
    ]
]);

$conn->close();
?>
