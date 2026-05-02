<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

if (!isset($_GET['ids']) || empty($_GET['ids'])) {
    echo json_encode(['success' => false, 'message' => 'No fee IDs provided']);
    exit;
}

$ids = explode(',', $_GET['ids']);
$ids = array_filter($ids, fn($id) => is_numeric($id));

if (empty($ids)) {
    echo json_encode(['success' => false, 'message' => 'Invalid fee IDs']);
    exit;
}

$placeholders = implode(',', array_fill(0, count($ids), '?'));
$types = str_repeat('i', count($ids));

$sql = "
    SELECT 
        fa.id,
        fa.user_id,
        fa.amount,
        fa.due_date,
        fa.status,
        fa.date_created,
        ft.fee_name,
        ft.description,
        CONCAT(u.first_name, ' ', u.last_name) AS full_name
    FROM fee_assignments fa
    LEFT JOIN fee_type ft ON fa.fee_type_id = ft.id
    LEFT JOIN user_info u ON fa.user_id = u.user_id
    WHERE fa.id IN ($placeholders)
";

$stmt = $conn->prepare($sql);
$stmt->bind_param($types, ...$ids);
$stmt->execute();
$result = $stmt->get_result();

$grouped = [];
while ($row = $result->fetch_assoc()) {
    $row['amount'] = (float)$row['amount'];
    $row['due_date_formatted'] = date('M d, Y', strtotime($row['due_date']));

    $name = $row['full_name'] ?? 'Unknown';
    if (!isset($grouped[$name])) {
        $grouped[$name] = [
            'name' => $name,
            'user_id' => $row['user_id'] ?? null,
            'data' => []
        ];
    }
    $grouped[$name]['data'][] = $row;
}

echo json_encode([
    'success' => true,
    'data' => array_values($grouped)
]);

$stmt->close();
$conn->close();
?>
