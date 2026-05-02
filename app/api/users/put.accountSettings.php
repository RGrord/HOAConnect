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

$email = trim($_POST['email_address'] ?? '');
if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Valid email required']);
    exit;
}

$sql = "UPDATE users SET email_address = ?";
$params = [$email];
$types = "s";

$password = $_POST['password'] ?? '';
if (!empty($password)) {
    if (strlen($password) < 6) {
        echo json_encode(['success' => false, 'message' => 'Password too short']);
        exit;
    }
    $hashed = password_hash($password, PASSWORD_DEFAULT);
    $sql .= ", password = ?";
    $params[] = $hashed;
    $types .= "s";
}

$sql .= " WHERE user_id = ?";
$params[] = $user_id;
$types .= "s";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'Database error']);
    exit;
}

$stmt->bind_param($types, ...$params);

if ($stmt->execute()) {
    echo json_encode([
        'success' => true,
        'message' => 'Account settings updated successfully!',
        'data' => ['email_address' => $email]
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Failed to update account'
    ]);
}

$stmt->close();
$conn->close();
exit;
?>