<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';
header('Content-Type: application/json');

$limit  = intval($_GET['limit'] ?? 10);
$page   = intval($_GET['page'] ?? 1);
$search = trim($_GET['search'] ?? '');

$offset = ($page - 1) * $limit;

$sql = "
    SELECT srf.*, sr.renter_name AS fullName
    FROM stall_renter_fees srf
    LEFT JOIN stall_renter sr ON srf.stall_renter_id = sr.id
    WHERE srf.status = 1
";

$params = [];
$types = '';

if ($search !== '') {
  $sql .= " AND (
    sr.renter_name LIKE ?
    OR srf.stall_renter_id LIKE ?
    OR srf.amount_paid LIKE ?
    OR srf.status LIKE ?
  )";

  $searchTerm = "%$search%";
  $params[] = $searchTerm;
  $params[] = $searchTerm;
  $params[] = $searchTerm;
  $params[] = $searchTerm;
  $types .= 'ssss';
}
$countSql = "
  SELECT COUNT(*) AS total
  FROM stall_renter_fees srf
  LEFT JOIN stall_renter sr ON srf.stall_renter_id = sr.id
  WHERE srf.status = 1
";

if ($search !== '') {
  $countSql .= " AND (
    sr.renter_name LIKE ?
    OR srf.stall_renter_id LIKE ?
    OR srf.amount_paid LIKE ?
    OR srf.status LIKE ?
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
    
    if ($row['attachment'] && !str_starts_with($row['attachment'], 'http')) {
        $row['attachment'] = "/hoa_system/{$row['attachment']}";
    }

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