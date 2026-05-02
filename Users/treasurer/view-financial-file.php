<?php
include('../../connection/connection.php');

if (!isset($_GET['id'])) {
    die("No file ID provided.");
}

$file_id = intval($_GET['id']);
if ($file_id <= 0) die("Invalid file ID.");

$sql = "SELECT file FROM financial_summary WHERE id = $file_id LIMIT 1";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    die("File not found.");
}

$row = mysqli_fetch_assoc($result);
$file_data = $row['file'];

// Default to PDF (or adjust based on your use case)
header("Content-Type: application/pdf");
header("Content-Disposition: inline; filename='receipt_$file_id.pdf'");
echo $file_data;
exit;
?>
