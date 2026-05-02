<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_error("Invalid request method", 405);
}

$user_id      = isset($_POST['user_id']) ? intval($_POST['user_id']) : 0;
$first_name   = trim($_POST['first_name'] ?? '');
$middle_name  = trim($_POST['middle_name'] ?? '');
$last_name    = trim($_POST['last_name'] ?? '');
$suffix       = trim($_POST['suffix'] ?? '');
$phone        = trim($_POST['phone'] ?? '');
$dob          = trim($_POST['date_of_birth'] ?? '');
$citizenship  = trim($_POST['citizenship'] ?? '');
$civil_status = trim($_POST['civil_status'] ?? '');

if (!$user_id || !$first_name || !$last_name) {
    json_error("User ID, first name, and last name are required.");
}

$sql = "UPDATE users SET 
    first_name = ?, 
    middle_name = ?, 
    last_name = ?, 
    suffix = ?, 
    phone_number = ?, 
    date_of_birth = ?, 
    citizenship = ?, 
    civil_status = ? 
    WHERE user_id = ?";

$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    json_error("Failed to prepare statement: " . mysqli_error($conn));
}

mysqli_stmt_bind_param(
    $stmt,
    "ssssssssi",
    $first_name,
    $middle_name,
    $last_name,
    $suffix,
    $phone,
    $dob,
    $citizenship,
    $civil_status,
    $user_id
);

if (mysqli_stmt_execute($stmt)) {
    json_success(['user_id' => $user_id], "Personal information updated successfully.");
} else {
    json_error("Error updating personal information: " . mysqli_stmt_error($stmt));
}

mysqli_stmt_close($stmt);
