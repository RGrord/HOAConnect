<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
    exit;
}

$user_id = $_POST['user_id'] ?? null;
if (!$user_id || !is_numeric($user_id)) {
    echo json_encode(['success' => false, 'message' => 'Invalid user ID']);
    exit;
}

$allowed = ['hoa_number', 'home_address', 'lot', 'block', 'phase', 'village'];
$data = [];

foreach ($allowed as $field) {
    $value = trim($_POST[$field] ?? '');
    $data[$field] = $value;
}

$check = $conn->prepare("SELECT 1 FROM hoa_info WHERE user_id = ?");
$check->bind_param("s", $user_id);
$check->execute();
$check->store_result();
$exists = $check->num_rows > 0;
$check->close();

if ($exists) {
    $setParts = [];
    foreach ($data as $key => $val) {
        $setParts[] = "$key = ?";
    }
    $sql = "UPDATE hoa_info SET " . implode(', ', $setParts) . " WHERE user_id = ?";
} else {
    $columns = implode(', ', array_keys($data));
    $placeholders = str_repeat('?,', count($data) - 1) . '?';
    $sql = "INSERT INTO hoa_info (user_id, $columns) VALUES (?, $placeholders)";
}

$values = $exists ? array_values($data) : [$user_id, ...array_values($data)];
$values[] = $user_id;
$types = str_repeat('s', count($values) - 1) . 's';

$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'Database error']);
    exit;
}

$stmt->bind_param($types, ...$values);

if ($stmt->execute()) {
    $action = $exists ? 'updated' : 'created';
    echo json_encode([
        'success' => true,
        'message' => "Home details $action successfully!",
        'data' => $data
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Failed to save home details'
    ]);
}

$stmt->close();
$conn->close();
exit;
?>