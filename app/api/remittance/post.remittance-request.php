<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/hoa_system/app/core/init.php';
header('Content-Type: application/json');

$user_id = (int)($_POST['user_id'] ?? 0);
$amount = (float)($_POST['amount'] ?? 0);
$date = trim($_POST['date'] ?? '');
$transaction_type = trim($_POST['transaction_type'] ?? '');
$particular = trim($_POST['particular'] ?? '');

if ($user_id <= 0 || $amount <= 0 || !$date || !$transaction_type || !$particular) {
    echo json_encode(['success' => false, 'message' => 'Missing required fields']);
    exit;
}

$stmt = $conn->prepare("
    INSERT INTO remittance
    (user_id, particular, amount, date, transaction_type, status, date_created)
    VALUES (?, ?, ?, ?, ?, 0, NOW())
");

$stmt->bind_param("isdss", $user_id, $particular, $amount, $date, $transaction_type);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Remittance submitted']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to insert remittance']);
}

$stmt->close();
$conn->close();
