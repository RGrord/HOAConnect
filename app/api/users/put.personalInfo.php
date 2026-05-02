<?php
// app/api/users/put.personalInfo.php
// 100% PROCEDURAL — PINOY STYLE — NOV 17, 2025

require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';

header('Content-Type: application/json');

// Only accept POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
    exit;
}

$user_id = $_POST['user_id'] ?? null;
if (!$user_id || !is_numeric($user_id)) {
    echo json_encode(['success' => false, 'message' => 'Invalid user ID']);
    exit;
}

$allowed = ['first_name', 'middle_name', 'last_name', 'suffix', 'phone_number', 'date_of_birth', 'citizenship', 'civil_status'];
$data = [];
$values = [];
$types = '';

foreach ($allowed as $field) {
    if (isset($_POST[$field])) {
        $value = trim($_POST[$field]);
        $data[$field] = $value;
        
        $values[] = $value;
        $types .= 's';
    }
}

if (empty($data)) {
    echo json_encode(['success' => false, 'message' => 'No data to update']);
    exit;
}

$setParts = [];
foreach ($data as $key => $val) {
    $setParts[] = "$key = ?";
}
$setClause = implode(', ', $setParts);

$sql = "UPDATE user_info SET $setClause WHERE user_id = ?";

$values[] = $user_id;
$types .= 'i';

$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'Database error']);
    exit;
}

// Bind parameters dynamically
$stmt->bind_param($types, ...$values);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0 || count($data) > 0) {
        echo json_encode([
            'success' => true,
            'message' => 'Personal information updated!',
            'data' => $data
        ]);
    } else {
        echo json_encode([
            'success' => true,
            'message' => 'No changes made (already up to date)',
            'data' => $data
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Failed to save. Please try again.'
    ]);
}

$stmt->close();
$conn->close();
exit;
?>