<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/';
require_once $root . 'config.php';
require_once $root . 'app/core/init.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

$user_id        = intval($_POST['user_id'] ?? 0);
$fee_ids        = $_POST['fee_ids'] ?? [];
$amount         = floatval($_POST['amount'] ?? 0);
$payment_method = trim($_POST['payment_method'] ?? '');
$payment_date   = $_POST['payment_date'] ?? '';
$receipt_name   = trim($_POST['receipt_name'] ?? '');
$remarks        = trim($_POST['remarks'] ?? '');

if (!$user_id || empty($fee_ids) || !$amount || !$payment_method || !$payment_date || !$receipt_name) {
    echo json_encode(['success' => false, 'message' => 'All required fields must be filled.']);
    exit;
}

$fee_ids_placeholders = implode(',', array_fill(0, count($fee_ids), '?'));

$conn->begin_transaction();

try {
    $stmt = $conn->prepare("
        INSERT INTO payment_verification (user_id, payment_for, amount, status, date_created)
        VALUES (?, 'Monthly Fees', ?, 0, NOW())
    ");
    $stmt->bind_param("id", $user_id, $amount);
    $stmt->execute();
    $payment_verification_id = $stmt->insert_id;
    $stmt->close();

    $types = str_repeat('i', count($fee_ids)) . 'i';
    $stmt = $conn->prepare("UPDATE fee_assignments SET status = 1 WHERE id IN ($fee_ids_placeholders) AND user_id = ?");
    $bind_params = array_merge($fee_ids, [$user_id]);
    $stmt->bind_param($types, ...$bind_params);
    $stmt->execute();
    $stmt->close();

    $stmt = $conn->prepare("
        INSERT INTO homeowner_fees (user_id, amount_paid, payment_method, ref_no, attachment, status, remarks, date_created)
        VALUES (?, ?, ?, ?, '', 0, ?, NOW())
    ");
    $ref_no = 'PV' . str_pad($payment_verification_id, 6, '0', STR_PAD_LEFT);
    $stmt->bind_param("idsss", $user_id, $amount, $payment_method, $ref_no, $remarks);
    $stmt->execute();
    $stmt->close();

    $conn->commit();
    echo json_encode(['success' => true, 'message' => 'Payment recorded successfully.']);

} catch (Exception $e) {
    $conn->rollback();
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>
