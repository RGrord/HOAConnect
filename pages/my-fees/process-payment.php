<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Please login first']);
    exit;
}

$fee_id = (int)$_POST['fee_assignment_id'] ?? 0;
$method = $_POST['payment_method'] ?? '';
$ref_no = trim($_POST['ref_no'] ?? '');

if ($fee_id <= 0 || empty($method)) {
    echo json_encode(['success' => false, 'message' => 'Invalid data']);
    exit;
}

$stmt = $conn->prepare("SELECT fa.amount, ft.fee_name 
  FROM fee_assignments fa 
  LEFT JOIN fee_type ft ON fa.fee_type_id = ft.id 
  WHERE fa.id = ? AND fa.user_id = ? AND fa.status = 0");
$stmt->bind_param("ii", $fee_id, $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'Fee not found or already paid']);
    exit;
}

$fee = $result->fetch_assoc();

$uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/uploads/payments/';
if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

$attachment = null;
if (!empty($_FILES['attachment']['name'])) {
    $ext = strtolower(pathinfo($_FILES['attachment']['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, ['jpg','jpeg','png','pdf'])) {
        echo json_encode(['success' => false, 'message' => 'Invalid file type']);
        exit;
    }
    if ($_FILES['attachment']['size'] > 5*1024*1024) {
        echo json_encode(['success' => false, 'message' => 'File too large. Max 5MB']);
        exit;
    }

    $filename = 'proof_' . $fee_id . '_' . time() . '.' . $ext;
    $path = $uploadDir . $filename;
    if (move_uploaded_file($_FILES['attachment']['tmp_name'], $path)) {
        $attachment = '/hoa_system/uploads/payments/' . $filename;
    }
}

$conn->autocommit(false);

try {
    $stmt1 = $conn->prepare("INSERT INTO homeowner_fees 
        (user_id, amount_paid, payment_method, ref_no, attachment, status, remarks, is_remitted, date_created)
        VALUES (?, ?, ?, ?, ?, 0, 'Submitted via online payment', 0, NOW())");

    $stmt1->bind_param("idsss", 
        $_SESSION['user_id'],
        $fee['amount'],
        $method,
        $ref_no,
        $attachment
    );

    if (!$stmt1->execute()) {
        throw new Exception("Failed to save payment record");
    }

    $stmt2 = $conn->prepare("INSERT INTO payment_verification 
        (user_id, payment_for, amount, status, date_created)
        VALUES (?, 'Monthly Fee', ?, 0, NOW())");

    $stmt2->bind_param("id", $_SESSION['user_id'], $fee['amount']);
    
    if (!$stmt2->execute()) {
        throw new Exception("Failed to submit for verification");
    }

    $conn->query("UPDATE fee_assignments SET status = 1 WHERE id = $fee_id");

    $conn->commit();
    echo json_encode(['success' => true, 'message' => 'Payment submitted! Waiting for verification.']);

} catch (Exception $e) {
    $conn->rollback();
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

$conn->autocommit(true);
?>