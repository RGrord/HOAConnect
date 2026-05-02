<?php
include('../connection/connection.php');
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if post ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Post ID is required.");
}

$post_id = intval($_GET['id']);

// Fetch the post to delete files
$sql = "SELECT * FROM news_feed WHERE id = $post_id";
$result = mysqli_query($conn, $sql);
if (!$result || mysqli_num_rows($result) === 0) {
    die("Post not found.");
}

$post = mysqli_fetch_assoc($result);


// Delete images
$images = explode(",", $post['post_image']);
foreach ($images as $img) {
    $imgPath = "../../uploads/images/" . $img;
    if (file_exists($imgPath)) {
        unlink($imgPath);
    }
}

// Delete PDF
$pdfPath = "../../uploads/files/" . $post['project_details'];
if (!empty($post['project_details']) && file_exists($pdfPath)) {
    unlink($pdfPath);
}

// Delete post from DB
$deleteSql = "DELETE FROM news_feed WHERE id = $post_id";
if (mysqli_query($conn, $deleteSql)) {
    header("Location: ../Users/admin/admin-newsfeed.php");
    exit;
} else {
    die("Error deleting post: " . mysqli_error($conn));
}


?>