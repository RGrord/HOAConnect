<?php
session_start();
include('../../connection/connection.php'); 
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (!isset($_GET['id']) || !isset($_GET['file'])) {
    exit("Invalid request.");
}

$id = intval($_GET['id']);
$fileType = $_GET['file'];

if ($fileType === 'proposal') {
    $column = 'project_proposal_document';
} elseif ($fileType === 'signed') {
    $column = 'upload_signed_resolution';
} else {
    exit("Invalid file type.");
}

$sql = "SELECT $column AS filename FROM resolution WHERE id = $id LIMIT 1";
$res = mysqli_query($conn, $sql);

if (!$res || mysqli_num_rows($res) === 0) {
    exit("Record not found.");
}

$row = mysqli_fetch_assoc($res);
$filename = $row['filename'];

if (empty($filename)) {
    exit("No file uploaded.");
}

$filename = basename($filename);

$folder = __DIR__ . '/../../uploads/project_resolution';
$path = $folder . '/' . $filename;

if (!file_exists($path)) {
    exit("File not found on server. Path checked: $path");
}

header("Content-Type: application/pdf");
header("Content-Disposition: inline; filename=\"$filename\"");
header("Content-Length: " . filesize($path));
header("Accept-Ranges: bytes");

readfile($path);
exit;
