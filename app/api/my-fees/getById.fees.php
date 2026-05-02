<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access.']);
    exit;
}

$user_id = (int)$_SESSION['user_id']; 
$homeownerId = $_SESSION['user_id'];

if ($homeownerId <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid homeowner ID']);
    exit;
}

$limit  = max(1, (int)($_GET['limit'] ?? 20));
$page   = max(1, (int)($_GET['page'] ?? 1));
$search = trim($_GET['search'] ?? '');
$offset = ($page - 1) * $limit;

$where = ["fa.user_id = ?", "fa.status != 1"];
$params = [$homeownerId];
$types = 'i';

if ($search !== '') {
    $where[] = "(ft.fee_name LIKE ? OR fa.amount LIKE ? OR fa.due_date LIKE ?)";
    $like = "%$search%";
    $params[] = $like;
    $params[] = $like;
    $params[] = $like;
    $types .= 'sss';
}

$whereClause = 'WHERE ' . implode(' AND ', $where);

$whereClause = 'WHERE ' . implode(' AND ', $where);

$totalSql = "SELECT COUNT(*) AS total 
             FROM fee_assignments fa
             LEFT JOIN fee_type ft ON fa.fee_type_id = ft.id
             $whereClause";

$totalStmt = $conn->prepare($totalSql);
$totalStmt->bind_param($types, ...$params);
$totalStmt->execute();
$total = (int)$totalStmt->get_result()->fetch_assoc()['total'];

/** Main Records */
$sql = "SELECT 
            fa.id,
            fa.amount,
            fa.due_date,
            fa.status,
            fa.date_created,
            fa.fee_type_id,
            ft.fee_name,
            ft.description
        FROM fee_assignments fa
        LEFT JOIN fee_type ft ON fa.fee_type_id = ft.id
        $whereClause
        ORDER BY 
            fa.due_date ASC,
            fa.id DESC
        LIMIT ? OFFSET ?";

$finalParams = $params;
$finalParams[] = $limit;
$finalParams[] = $offset;

$finalTypes = $types . 'ii';

$stmt = $conn->prepare($sql);
$stmt->bind_param($finalTypes, ...$finalParams);
$stmt->execute();

$result = $stmt->get_result();
$fees = [];

while ($row = $result->fetch_assoc()) {

    $row['amount'] = (float)$row['amount'];
    $row['due_date_formatted'] = date('M d, Y', strtotime($row['due_date']));
    $row['is_overdue'] = strtotime($row['due_date']) < time();

    $row['status_text'] = match ($row['status']) {
        0 => 'Unpaid',
        1 => 'Paid',
        2 => 'Cancelled',
        4 => 'Waiting for Verification',
        default => 'Unknown'
    };

    $row['badge_class'] = match ($row['status']) {
        0 => $row['is_overdue'] ? 'bg-red-100 text-red-800' : 'bg-red-100 text-red-800',
        1 => 'bg-green-100 text-green-800',
        2 => 'bg-gray-100 text-gray-800',
        4 => 'bg-yellow-100 text-yellow-800',
        default => 'bg-gray-100 text-gray-800'
    };

    $fees[] = $row;
}

echo json_encode([
    'success' => true,
    'data' => $fees,
    'pagination' => [
        'totalRecords' => $total,
        'totalPages'   => max(1, ceil($total / $limit)),
        'currentPage'  => $page,
        'limit'        => $limit
    ]
]);

$conn->close();
?>
