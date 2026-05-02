<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/';
require_once $root . 'config.php';
require_once $root . 'app/core/init.php';

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


// Delete post from DB
$deleteSql = "DELETE FROM news_feed WHERE id = $post_id";
if (mysqli_query($conn, $deleteSql)) {
    echo "<script>
      alert('Deleted')
      window.location.href = list.php
    </script>";
} else {
    die("Error deleting post: " . mysqli_error($conn));
    
} 
    echo "<script>
      window.location.href = list.php
    </script>";

?>