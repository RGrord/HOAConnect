<?php
// event-create.php
session_start();
include('../connection/connection.php');
ini_set('display_errors',1); 
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../Users/admin/admin-calendar.php'); exit;
}

$title = isset($_POST['title']) ? trim($_POST['title']) : '';
$description = isset($_POST['description']) ? trim($_POST['description']) : '';
$start_date = isset($_POST['start_date']) ? trim($_POST['start_date']) : '';
$end_date = isset($_POST['end_date']) ? trim($_POST['end_date']) : '';

if ($title === '' || $start_date === '') {
    // Required fields missing
    header('Location: ../Users/admin/admin-calendar.php'); exit;
}

$created_by = isset($_SESSION['user_id']) ? (int)$_SESSION['user_id'] : 0;

// Use conditional SQL so nullable end_date can use NULL literal
if ($end_date === '') {
    $sql = "INSERT INTO events (title, description, start_date, end_date, created_by, date_created, date_updated) VALUES (?, ?, ?, NULL, ?, CURDATE(), NOW())";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'sssi', $title, $description, $start_date, $created_by);
} else {
    $sql = "INSERT INTO events (title, description, start_date, end_date, created_by, date_created, date_updated) VALUES (?, ?, ?, ?, ?, CURDATE(), NOW())";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'ssssi', $title, $description, $start_date, $end_date, $created_by);
}

$ok = mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

// Redirect back
header('Location: ../Users/admin/admin-calendar.php');
exit;
