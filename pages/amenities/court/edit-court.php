<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request method.'
    ]);
    exit;
}

$required = ['id', 'renter_name', 'contact_no', 'start_date', 'end_date', 'amount', 'status'];

foreach ($required as $field) {
    if (empty($_POST[$field])) {
        echo json_encode([
            'success' => false,
            'message' => ucfirst(str_replace('_', ' ', $field)) . ' is required.'
        ]);
        exit;
    }
}

$id                 = intval($_POST['id']);
$renter_name        = trim($_POST['renter_name']);
$contact_no         = trim($_POST['contact_no']);
$purpose            = !empty($_POST['purpose']) ? trim($_POST['purpose']) : null;
$amount             = floatval($_POST['amount']);
$start_date         = $_POST['start_date'];
$end_date           = $_POST['end_date'];
$no_of_participants = !empty($_POST['no_of_participants']) ? intval($_POST['no_of_participants']) : null;
$status             = trim($_POST['status']);
$date_updated       = date('Y-m-d H:i:s');

try {
    $sql = "
        UPDATE stall_rentals SET
            renter_name = ?,
            contact_no = ?,
            purpose = ?,
            amount = ?,
            start_date = ?,
            end_date = ?,
            no_of_participants = ?,
            status = ?,
            date_updated = ?
        WHERE id = ?
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sssdssissi",
        $renter_name,
        $contact_no,
        $purpose,
        $amount,
        $start_date,
        $end_date,
        $no_of_participants,
        $status,
        $date_updated,
        $id
    );

    $result = $stmt->execute();

    if ($result) {
        echo json_encode([
            'success' => true,
            'message' => 'Stall rental updated successfully!'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Failed to update stall rental.'
        ]);
    }

    $stmt->close();

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage()
    ]);
}
?>
