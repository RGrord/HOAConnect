<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request method.'
    ]);
    exit;
}

// Required Fields
$required = ['toda_id', 'toda_name', 'no_of_tricycles', 'representative', 'contact_no', 'date_start'];

foreach ($required as $key) {
    if (empty($_POST[$key])) {
        echo json_encode([
            'success' => false,
            'message' => ucfirst(str_replace('_', ' ', $key)) . " is required"
        ]);
        exit;
    }
}

$toda_id         = intval($_POST['toda_id']);
$toda_name       = trim($_POST['toda_name']);
$no_of_tricycles = intval($_POST['no_of_tricycles']);
$representative  = trim($_POST['representative']);
$contact_no      = trim($_POST['contact_no']);
$date_start      = $_POST['date_start'];
$date_end        = !empty($_POST['date_end']) ? $_POST['date_end'] : null;

try {
    $stmt = $conn->prepare("
        UPDATE toda 
        SET toda_name = ?, 
            no_of_tricycles = ?, 
            representative = ?, 
            contact_no = ?, 
            start_date = ?, 
            end_date = ?, 
            date_updated = NOW()
        WHERE id = ?
    ");

    $stmt->bind_param(
        "sissssi",
        $toda_name,
        $no_of_tricycles,
        $representative,
        $contact_no,
        $date_start,
        $date_end,
        $toda_id
    );

    if ($stmt->execute()) {
        echo json_encode([
            'success' => true,
            'message' => 'TODA updated successfully.'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Database update failed: ' . $stmt->error
        ]);
    }

    $stmt->close();

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'DB Error: ' . $e->getMessage()
    ]);
}
?>
