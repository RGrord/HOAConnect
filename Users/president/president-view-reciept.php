<?php
include('../../connection/connection.php'); 

if (!isset($_GET['id'])) die("No transaction ID provided.");

$id = intval($_GET['id']);
$sql = "SELECT acknowledgement_receipt FROM transactions WHERE id = $id LIMIT 1";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) == 0) die("Receipt not found.");

$row = mysqli_fetch_assoc($result);
$filename = $row['acknowledgement_receipt'];

$filepath = '../../uploads/acknowledgement_receipt/' . $filename;

if (!file_exists($filepath)) die("File not found.");

header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="' . basename($filename) . '"');
header('Content-Length: ' . filesize($filepath));

readfile($filepath);
exit;
?>
