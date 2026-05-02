<?php
ob_clean();
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';
header('Content-Type: application/json');

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo json_encode(['success' => false, 'message' => 'ID required']);
    exit;
}
$id = (int)$_GET['id'];

$sql = "SELECT * FROM fee_type WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'Fee type not found']);
    $stmt->close();
    exit;
}

$fee = $result->fetch_assoc();
$stmt->close();

$fee['amount_formatted'] = number_format($fee['amount'], 2);
$fee['effectivity_formatted'] = date('F j, Y', strtotime($fee['effectivity_date']));
$fee['status_label'] = $fee['status'] == 1 ? 'Active' : 'Inactive';
$fee['recurring_label'] = $fee['is_recurring'] == 1 ? 'Yes (Recurring)' : 'No (One-time)';

echo json_encode(['success' => true, 'data' => $fee], JSON_PRETTY_PRINT);
exit;
?>