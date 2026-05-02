<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$liq_id = intval($data['id'] ?? 0);

if ($liq_id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid ID']);
    exit;
}

$stmt = $conn->prepare("SELECT status FROM liquidation_of_expenses WHERE id = ?");
$stmt->bind_param("i", $liq_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'Record not found']);
    exit;
}
$current = $result->fetch_assoc();

if ($current['status'] != 0) {
    echo json_encode(['success' => false, 'message' => 'Already processed']);
    exit;
}

$update = $conn->prepare("UPDATE liquidation_of_expenses SET status = 0 WHERE id = ?");
$update->bind_param("i", $liq_id);

if ($update->execute() && $update->affected_rows > 0) {
    echo json_encode(['success' => true, 'message' => 'Liquidation approved successfully!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to approve']);
}
exit;
?>