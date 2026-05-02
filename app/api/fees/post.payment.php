<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

$required = [
    'created_by',
    'payment_method',
    'reference_number',
    'fee_ids',
];

foreach ($required as $field) {
    if (empty($_POST[$field] ?? '')) {
        echo json_encode([
            'success' => false,
            'message' => ucfirst(str_replace('_', ' ', $field)) . ' is required'
        ]);
        exit;
    }
}

$created_by       = intval($_POST['created_by']);
$payment_method   = trim($_POST['payment_method']);
$reference_number = trim($_POST['reference_number']);
$is_walk_in       = isset($_POST['is_walk_in']) ? 1 : 0;

$fee_ids = explode(',', $_POST['fee_ids']);
$fee_ids = array_map('intval', $fee_ids);

$attachment_path = null;
if (!empty($_FILES['attachment']['name'])) {
    $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/uploads/payments/';
    if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);

    $filename = time() . '_' . basename($_FILES['attachment']['name']);
    $target_file = $upload_dir . $filename;

    if (move_uploaded_file($_FILES['attachment']['tmp_name'], $target_file)) {
        $attachment_path = '/hoa_system/uploads/payments/' . $filename;
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to upload attachment']);
        exit;
    }
}

$conn->begin_transaction();

try {
    $stmt = $conn->prepare("
        INSERT INTO payment_verification
        (created_by, payment_method, reference_number, is_walk_in, attachment, date_created)
        VALUES (?, ?, ?, ?, ?, NOW())
    ");
    $stmt->bind_param("issis", $created_by, $payment_method, $reference_number, $is_walk_in, $attachment_path);
    $stmt->execute();
    $payment_verification_id = $stmt->insert_id;
    $stmt->close();

    $stmtLink = $conn->prepare("
        INSERT INTO payment_verification_fees (payment_verification_id, fee_id)
        VALUES (?, ?)
    ");

    foreach ($fee_ids as $fee_id) {
        $stmtLink->bind_param("ii", $payment_verification_id, $fee_id);
        $stmtLink->execute();
    }
    $stmtLink->close();

    $conn->commit();

    echo json_encode([
        'success' => true,
        'message' => 'Payment and fees linked successfully!',
        'data' => ['payment_verification_id' => $payment_verification_id]
    ]);

} catch (Exception $e) {
    $conn->rollback();
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage()
    ]);
}
?>
