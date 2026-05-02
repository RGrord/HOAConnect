<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/hoa_system/config.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

if (!isset($_POST['setup'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
    exit;
}

$user_id = isset($_POST['user_id']) ? trim($_POST['user_id']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';
$confirm_password = isset($_POST['confirm_password']) ? trim($_POST['confirm_password']) : '';

if (empty($user_id) || empty($password) || empty($confirm_password)) {
    echo json_encode(['success' => false, 'message' => 'All fields are required.']);
    exit;
}

if ($password !== $confirm_password) {
    echo json_encode(['success' => false, 'message' => 'Passwords do not match.']);
    exit;
}

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql = "UPDATE users SET `password` = ?, `is_first_time` = 0 WHERE user_id = ?";

$stmt = mysqli_prepare($conn, $sql);
if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'Failed to prepare statement: ' . mysqli_error($conn)]);
    exit;
}

mysqli_stmt_bind_param($stmt, 'ss', $hashed_password, $user_id);

if (mysqli_stmt_execute($stmt)) {
    $affected = mysqli_stmt_affected_rows($stmt);
    if ($affected > 0) {
        echo json_encode([
            'success' => true,
            'message' => 'Password updated successfully!',
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'No user found.'
        ]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to update password: ' . mysqli_stmt_error($stmt)]);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
