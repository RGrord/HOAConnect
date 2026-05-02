<?php
// event-update.php
session_start();
include('../connection/connection.php');
ini_set('display_errors',1); error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../Users/admin/admin-calendar.php'); exit;
}

$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
$title = isset($_POST['title']) ? trim($_POST['title']) : '';
$description = isset($_POST['description']) ? trim($_POST['description']) : '';
$start_date = isset($_POST['start_date']) ? trim($_POST['start_date']) : '';
$end_date = isset($_POST['end_date']) ? trim($_POST['end_date']) : '';

if ($id <= 0 || $title === '' || $start_date === '') {
    header('Location: ../Users/admin/admin-calendar.php'); exit;
}

// Set date_updated to current date
$date_updated = date('Y-m-d');

if ($end_date === '') {
    $sql = "UPDATE events SET title = ?, description = ?, start_date = ?, end_date = NULL, date_updated = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'ssssi', $title, $description, $start_date, $date_updated, $id);
} else {
    $sql = "UPDATE events SET title = ?, description = ?, start_date = ?, end_date = ?, date_updated = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'sssssi', $title, $description, $start_date, $end_date, $date_updated, $id);
}

mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

header('Location: ../Users/admin/admin-calendar.php');
exit;
