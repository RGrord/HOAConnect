<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

$user_id        = (int)($_POST['user_id'] ?? 0);
$fee_ids        = $_POST['fee_ids'] ?? [];
$payment_method = trim($_POST['payment_method'] ?? '');
$payment_date   = trim($_POST['payment_date'] ?? '');
$receipt        = trim($_POST['receipt_name'] ?? '');
$remarks        = trim($_POST['remarks'] ?? '');

if ($user_id <= 0 || empty($fee_ids)) {
    echo json_encode(['success' => false, 'message' => 'Missing required fields']);
    exit;
}

if (!is_array($fee_ids)) {
    echo json_encode(['success' => false, 'message' => 'Invalid fee ID format']);
    exit;
}

$attachment = null;
if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] === UPLOAD_ERR_OK) {
    $fileTmp  = $_FILES['attachment']['tmp_name'];
    $fileName = basename($_FILES['attachment']['name']);
    $fileExt  = pathinfo($fileName, PATHINFO_EXTENSION);
    $allowed  = ['jpg', 'jpeg', 'png'];
    if (!in_array(strtolower($fileExt), $allowed)) {
        echo json_encode(['success' => false, 'message' => 'Invalid file type']);
        exit;
    }

    $newFileName = uniqid('proof_', true) . '.' . $fileExt;
    $uploadDir   = $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/uploads/payments/';
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

    if (!move_uploaded_file($fileTmp, $uploadDir . $newFileName)) {
        echo json_encode(['success' => false, 'message' => 'Failed to upload file']);
        exit;
    }

    $attachment = 'uploads/payments/' . $newFileName;
}

$conn->begin_transaction();

try {
    $placeholders = implode(',', array_fill(0, count($fee_ids), '?'));
    $types = str_repeat('i', count($fee_ids));

    $sql = "SELECT SUM(amount) AS total_amount FROM fee_assignments WHERE id IN ($placeholders)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param($types, ...$fee_ids);
    $stmt->execute();
    $total_amount = (float)$stmt->get_result()->fetch_assoc()['total_amount'];
    $stmt->close();

    $homeownerSql = "
        INSERT INTO homeowner_fees 
        (user_id, amount_paid, payment_method, ref_no, attachment, status, remarks)
        VALUES (?, ?, ?, ?, ?, 4, ?)
    ";
    $homeStmt = $conn->prepare($homeownerSql);

    foreach ($fee_ids as $fee_id) {
        $feeAmountSql = "SELECT amount FROM fee_assignments WHERE id = ?";
        $feeStmt = $conn->prepare($feeAmountSql);
        $feeStmt->bind_param("i", $fee_id);
        $feeStmt->execute();
        $feeAmount = (float)$feeStmt->get_result()->fetch_assoc()['amount'];
        $feeStmt->close();

        $homeStmt->bind_param("idssss", $user_id, $feeAmount, $payment_method, $receipt, $attachment, $remarks);
        $homeStmt->execute();
    }
    $homeStmt->close();

    $verificationSql = "
        INSERT INTO payment_verification
        (user_id, payment_for, amount, status, ref_no, date_created)
        VALUES (?, 'Walk-in Payment', ?, 0, ?, NOW())
    ";
    $verifyStmt = $conn->prepare($verificationSql);
    $verifyStmt->bind_param("ids", $user_id, $total_amount, $receipt);
    $verifyStmt->execute();
    $verifyStmt->close();

    $updateSql = "
        UPDATE fee_assignments 
        SET status = 4, date_updated = NOW()
        WHERE id IN ($placeholders)
    ";
    $stmt2 = $conn->prepare($updateSql);
    $stmt2->bind_param($types, ...$fee_ids);
    $stmt2->execute();
    $stmt2->close();

    $conn->commit();

    echo json_encode([
        'success' => true,
        'message' => 'Walk-in payment recorded successfully',
        'total_amount' => $total_amount,
        'attachment' => $attachment
    ]);

} catch (Exception $e) {
    $conn->rollback();
    echo json_encode([
        'success' => false,
        'message' => 'Transaction failed: ' . $e->getMessage(),
         'debug' => [
            'user_id' => $user_id,
            'fee_ids' => $fee_ids,
            'payment_method' => $payment_method,
            'payment_date' => $payment_date,
            'receipt_name' => $receipt,
            'remarks' => $remarks,
            'files' => $_FILES
        ]

    ]);
}

$conn->close();
?>
