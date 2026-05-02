<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';
header('Content-Type: application/json');

$limit  = intval($_GET['limit'] ?? 10);
$page   = intval($_GET['page'] ?? 1);
$search = trim($_GET['search'] ?? '');

$offset = ($page - 1) * $limit;

$sql = "
  SELECT cf.*, c.renter_name AS fullName
  FROM court_fees cf 
  LEFT JOIN court c ON cf.court_id = c.id
  WHERE cf.status = 1
";

$params = [];
$types = '';

if ($search !== '') {
  $sql .= " AND (
    c.renter_name LIKE ?
    OR cf.court_id LIKE ?
    OR cf.amount_paid LIKE ?
  )";

  $searchTerm = "%$search%";
  $params[] = $searchTerm;
  $params[] = $searchTerm;
  $params[] = $searchTerm;
  $types .= 'sss';
}
$countSql = "
  SELECT COUNT(*) AS total
  FROM court_fees cf
  LEFT JOIN court c ON cf.court_id = c.id
  WHERE cf.status = 1
";

if ($search !== '') {
  $countSql .= " AND (
    c.renter_name LIKE ?
    OR cf.court_id LIKE ?
    OR cf.amount_paid LIKE ?
  )";
}

$countStmt = $conn->prepare($countSql);
if ($search !== '') {
    $countStmt->bind_param(str_repeat('s', count($params)), ...$params);
}
$countStmt->execute();
$totalRecords = $countStmt->get_result()->fetch_assoc()['total'];
$countStmt->close();

$sql .= " ORDER BY id DESC LIMIT ? OFFSET ?";
$params[] = $limit;
$params[] = $offset;
$types .= 'ii';

$stmt = $conn->prepare($sql);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

$payments = [];
while ($row = $result->fetch_assoc()) {
    $row['amount_paid'] = number_format((float)$row['amount_paid'], 2, '.', '');
    $payments[] = $row;
}

$stmt->close();
$conn->close();

echo json_encode([
    'success' => true,
    'data' => $payments,
    'pagination' => [
        'currentPage' => $page,
        'limit' => $limit,
        'totalPages' => ceil($totalRecords / $limit),
        'totalRecords' => (int)$totalRecords
    ]
]);
?>