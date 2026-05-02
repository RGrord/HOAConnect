<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

$required = [
    'renter_name',
    'contact_no',
    'amount',
    'start_date',
    'end_date',
    'no_of_participants',
    'purpose'
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

$renter_name        = trim($_POST['renter_name']);
$contact_no         = trim($_POST['contact_no']);
$amount             = floatval($_POST['amount']);
$start_date         = $_POST['start_date'];
$end_date           = $_POST['end_date'];
$no_of_participants = intval($_POST['no_of_participants']);
$purpose            = trim($_POST['purpose']);

try {
    $stmt = $conn->prepare("
        INSERT INTO court 
        (renter_name, contact_no, purpose, amount, start_date, end_date, no_of_participants, status, date_created)
        VALUES (?, ?, ?, ?, ?, ?, ?, 1, NOW())
    ");

    $stmt->bind_param(
        "sssdssi",
        $renter_name,
        $contact_no,
        $purpose,
        $amount,
        $start_date,
        $end_date,
        $no_of_participants
    );

    $stmt->execute();
    $new_id = $stmt->insert_id;
    $stmt->close();

    echo json_encode([
        'success' => true,
        'message' => 'Record added successfully!',
        'data' => ['id' => $new_id]
    ]);

} catch (Exception $e) {

    echo json_encode([
        'success' => false,
        'message' => 'DB Error: ' . $e->getMessage()
    ]);
}
?>
