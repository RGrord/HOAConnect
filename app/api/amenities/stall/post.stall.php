<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

$required = ['stall_no', 'status'];
foreach ($required as $field) {
    if (empty(trim($_POST[$field] ?? ''))) {
        echo json_encode([
            'success' => false,
            'message' => ucfirst(str_replace('_', ' ', $field)) . ' is required'
        ]);
        exit;
    }
}

$stall_no = trim($_POST['stall_no']);
$status   = trim($_POST['status']);
$remarks  = trim($_POST['remarks'] ?? '');

try {
    $conn->begin_transaction();

    $stmt = $conn->prepare("
        INSERT INTO stalls (stall_no, status, remarks, date_created)
        VALUES (?, ?, ?, NOW())
    ");

    $stmt->bind_param("sss", $stall_no, $status, $remarks);
    $stmt->execute();

    $new_id = $stmt->insert_id;
    $stmt->close();

    $conn->commit();

    echo json_encode([
        'success' => true,
        'message' => 'Stall created successfully!',
        'data' => ['id' => $new_id]
    ]);

} catch (Exception $e) {

    $conn->rollback();

    echo json_encode([
        'success' => false,
        'message' => 'DB Error: ' . $e->getMessage()
    ]);
}
?>
