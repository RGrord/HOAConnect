<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';

header('Content-Type: application/json');

$action = 1;
$id = $_GET['id'] ?? null;
if (!$id || !is_numeric($id)) {
    echo json_encode(['success' => false, 'message' => 'Invalid ID']);
    exit;
}

$sql = "UPDATE fee_type SET `status` = ? WHERE id = ?";
$params = [$action, $id];
$types = "ii";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'Database error']);
    exit;
}

$stmt->bind_param($types, ...$params);

if ($stmt->execute()) {
    echo json_encode([
        'success' => true,
        'message' => 'Fee type activated successfully!',
        'data' => ['action' => $action]
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Failed to update fee type'
    ]);
}

$stmt->close();
$conn->close();
exit;
?>