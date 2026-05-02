<?php
// event-delete.php
session_start();
include('../connection/connection.php');
ini_set('display_errors',1); error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../Users/admin/admin-calendar.php'); exit;
}

$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
if ($id <= 0) {
    header('Location: ../Users/admin/admin-calendar.php'); exit;
}

$sql = "DELETE FROM events WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

header('Location: ../Users/admin/admin-calendar.php');
exit;
