<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

$required = [
    'due_name',
    'description',
    'amount',
    'start_date',
    'is_recurring',
    'created_by',
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

$due_name     = trim($_POST['due_name']);
$description  = trim($_POST['description']);
$amount       = floatval($_POST['amount']);
$start        = trim($_POST['start_date']);
$is_recurring = trim($_POST['is_recurring']);
$created_by   = trim($_POST['created_by']);
$status       = 0; 

if ($is_recurring == 1) {
    $current_month = date('Y-m');

    $sql = "
        SELECT id 
        FROM fee_type 
        WHERE is_recurring = 1 
          AND DATE_FORMAT(effectivity_date, '%Y-%m') = ?
          AND status = 1
        LIMIT 1
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $current_month);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo json_encode([
            'success' => false,
            'message' => 'There is already an active recurring fee for this month.'
        ]);
        exit;
    }

    $stmt->close();
}

try {

    $stmt = $conn->prepare("
        INSERT INTO fee_type 
        (fee_name, description, amount, status, effectivity_date, is_recurring, created_by, date_created)
        VALUES (?, ?, ?, ?, ?, ?, ?, NOW())
    ");

    $stmt->bind_param(
        "ssdisii", 
        $due_name,
        $description,
        $amount,
        $status,
        $start,
        $is_recurring,
        $created_by
    );

    $stmt->execute();
    $new_id = $stmt->insert_id;
    $stmt->close();

    echo json_encode([
        'success' => true,
        'message' => 'Due created successfully!',
        'data' => ['id' => $new_id]
    ]);

} catch (Exception $e) {

    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage()
    ]);
}
?>
