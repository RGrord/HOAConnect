<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';
header('Content-Type: application/json');

$limit  = intval($_GET['limit'] ?? 10);
$page   = intval($_GET['page'] ?? 1);
$search = trim($_GET['search'] ?? '');
$offset = ($page - 1) * $limit;

$user = $_SESSION['user_id'];
$sql = "
    SELECT 
        p.id,
        p.user_id,
        u.first_name AS user_name,
        p.amount_paid,
        p.payment_method,
        p.ref_no,
        p.attachment,
        p.status,
        p.remarks,
        p.date_created
    FROM homeowner_fees p
    LEFT JOIN user_info u ON p.user_id = u.user_id
    WHERE p.user_id = $user
";

$params = [];
$types = '';

if ($search !== '') {
    $sql .= " AND (u.name LIKE ? OR p.ref_no LIKE ? OR p.remarks LIKE ?)";
    $searchTerm = "%$search%";
    $params[] = $searchTerm;
    $params[] = $searchTerm;
    $params[] = $searchTerm;
    $types .= 'sss';
}

$countSql = "SELECT COUNT(*) as total FROM homeowner_fees p LEFT JOIN user_info u ON p.user_id = u.user_id WHERE 1=1";
if ($search !== '') {
    $countSql .= " AND (u.name LIKE ? OR p.ref_no LIKE ? OR p.remarks LIKE ?)";
}
$countStmt = $conn->prepare($countSql);
if ($search !== '') {
    $countStmt->bind_param(str_repeat('s', count($params)), ...$params);
}
$countStmt->execute();
$totalRecords = $countStmt->get_result()->fetch_assoc()['total'];
$countStmt->close();

$sql .= " ORDER BY p.date_created DESC LIMIT ? OFFSET ?";
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