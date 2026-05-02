<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

// Required fields
$required = [
    'renter_name',
    'contact_no',
    'stall_id',
    'start_date',
    'amount',
    'status'
];

foreach ($required as $field) {
    if (empty(trim($_POST[$field] ?? ''))) {
        echo json_encode([
            'success' => false,
            'message' => ucfirst(str_replace('_', ' ', $field)) . ' is required'
        ]);
        exit;
    }
}

// Collect POST data
$renter          = trim($_POST['renter_name']);
$contact_no      = trim($_POST['contact_no']);
$stall_id        = intval($_POST['stall_id']);
$rental_duration = isset($_POST['rental_duration']) ? intval($_POST['rental_duration']) : null;
$start_date      = $_POST['start_date'] ?? null;
$end_date        = $_POST['end_date'] ?? null; 
$amount          = floatval($_POST['amount']);
$status          = trim($_POST['status']);
$remarks         = trim($_POST['remarks'] ?? null);

$contract_path = null;
if (isset($_FILES['contract']) && $_FILES['contract']['error'] === UPLOAD_ERR_OK) {
    $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/uploads/contracts/';
    if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);

    $filename = basename($_FILES['contract']['name']);
    $target_file = $upload_dir . time() . '_' . $filename;

    if (move_uploaded_file($_FILES['contract']['tmp_name'], $target_file)) {
        $contract_path = '/hoa_system/uploads/contracts/' . time() . '_' . $filename;
    }
}

try {
    $stmt = $conn->prepare("
        INSERT INTO stall_renter
        (renter_name, contact_no, stall_id, rental_duration, start_date, end_date, amount, contract, status, remarks, date_created)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())
    ");

    $stmt->bind_param(
        "ssisssisss",
        $renter,
        $contact_no,
        $stall_id,
        $rental_duration,
        $start_date,
        $end_date,
        $amount,
        $contract_path,
        $remarks,
        $status
    );

    $stmt->execute();
    $new_id = $stmt->insert_id;
    $stmt->close();

    echo json_encode([
        'success' => true,
        'message' => 'Stall rental record created successfully!',
        'data' => ['id' => $_POST]
    ]);

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'DB Error: ' . $e->getMessage()
    ]);
}
?>
