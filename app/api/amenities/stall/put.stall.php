<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/';
require_once $root . 'config.php';
require_once $root . 'app/core/init.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

$rental_id = isset($_POST['rental_id']) ? intval($_POST['rental_id']) : 0;
$stall_no  = trim($_POST['stall_no'] ?? '');
$remarks   = trim($_POST['remarks'] ?? '');
$status    = isset($_POST['status']) ? intval($_POST['status']) : null; 

if ($rental_id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid rental ID.']);
    exit;
}

if ($stall_no === '' || !in_array($status, [0,1], true)) {
    echo json_encode(['success' => false, 'message' => 'Required fields missing or invalid.']);
    exit;
}

$check = $conn->prepare("SELECT * FROM stalls WHERE id = ?");
$check->bind_param("i", $rental_id);
$check->execute();
$res_check = $check->get_result();
if ($res_check->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => "No record found with id=$rental_id"]);
    exit;
}

$sql = "UPDATE stalls SET stall_no = ?, remarks = ?, `status` = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssii", $stall_no, $remarks, $status, $rental_id);

$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'No changes made or database update failed.']);
}

$stmt->close();
$conn->close();
?>
