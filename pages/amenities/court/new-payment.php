<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

$required = ['id', 'amount'];
foreach ($required as $field) {
    if (!isset($_POST[$field]) || trim($_POST[$field]) === '') {
        echo json_encode([
            'success' => false,
            'message' => ucfirst(str_replace('_', ' ', $field)) . ' is required.'
        ]);
        exit;
    }
}

$court_id     = $_POST['id'];
$amount       = $_POST['amount'];

if ($court_id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid court booking ID.']);
    exit;
}
if ($amount <= 0) {
    echo json_encode(['success' => false, 'message' => 'Amount must be greater than zero.']);
    exit;
}

$attachmentPath = null;

if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] !== UPLOAD_ERR_NO_FILE) {
    $file = $_FILES['attachment'];

    if ($file['error'] !== UPLOAD_ERR_OK) {
        echo json_encode(['success' => false, 'message' => 'Upload error: ' . $file['error']]);
        exit;
    }

    if ($file['size'] > 5 * 1024 * 1024) {
        echo json_encode(['success' => false, 'message' => 'Attachment too large. Max 5MB.']);
        exit;
    }

    $allowed = ['image/jpeg', 'image/jpg', 'image/png', 'application/pdf'];
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $type = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);

    if (!in_array($type, $allowed)) {
        echo json_encode(['success' => false, 'message' => 'Only JPG, PNG, or PDF allowed.']);
        exit;
    }

    $ext = $type === 'application/pdf' ? '.pdf' : ($type === 'image/png' ? '.png' : '.jpg');
    $name = pathinfo($file['name'], PATHINFO_FILENAME);
    $name = preg_replace('/[^a-zA-Z0-9_-]/', '_', $name);
    $fileName = 'court_' . $court_id . '_payment_' . time() . '_' . $name . $ext;

    $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/uploads/attachments/';
    $target = $uploadDir . $fileName;
    $relative = 'uploads/attachments/' . $fileName;

    if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

    if (move_uploaded_file($file['tmp_name'], $target)) {
        chmod($target, 0644);
        $attachmentPath = $relative;
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to save attachment.']);
        exit;
    }
}

try {
    $check = $conn->prepare("SELECT id FROM court WHERE id = ?");
    $check->bind_param("i", $court_id);
    $check->execute();
    $check->store_result();
    if ($check->num_rows === 0) {
        $check->close();
        echo json_encode(['success' => false, 'message' => 'Court booking not found.']);
        exit;
    }
    $check->close();

    $sql = "INSERT INTO court_fees 
            (court_id, amount_paid, status, date_created) 
            VALUES (?, ?, 1, NOW())";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("id", $court_id, $amount);

    if ($stmt->execute()) {
        $payment_id = $stmt->insert_id;
        $stmt->close();

        $update = $conn->prepare("UPDATE court SET status = 'paid', date_updated = NOW() WHERE id = ?");
        $update->bind_param("i", $court_id);
        $update->execute();
        $update->close();

        echo json_encode([
            'success' => true,
            'message' => 'Payment recorded successfully!',
            'data' => ['payment_id' => $payment_id]
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to record payment.']);
    }

} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'DB Error: ' . $e->getMessage()]);
}

$conn->close();
?>