<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

// Required fields
$required = ['rental_id', 'renter_name', 'contact_no', 'stall_id', 'amount', 'date_start', 'status'];

foreach ($required as $field) {
    if (empty($_POST[$field])) {
        echo json_encode(['success' => false, 'message' => ucfirst(str_replace('_', ' ', $field)) . ' is required']);
        exit;
    }
}

$rental_id   = intval($_POST['rental_id']);
$renter_name = trim($_POST['renter_name']);
$contact_no  = trim($_POST['contact_no']);
$stall_id    = intval($_POST['stall_id']);
$amount      = floatval($_POST['amount']);
$date_start  = $_POST['date_start'];
$date_end    = !empty($_POST['date_end']) ? $_POST['date_end'] : null;
$status      = trim($_POST['status']);

$sql = "
    UPDATE stall_renter
    SET renter_name = ?, contact_no = ?, stall_id = ?, amount = ?, start_date = ?, end_date = ?, status = ?
    WHERE id = ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "ssidsisi",
    $renter_name,
    $contact_no,
    $stall_id,
    $amount,
    $date_start,
    $date_end,
    $status,
    $rental_id
);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Stall rental updated successfully!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to update stall rental.']);
}

$stmt->close();
?>
