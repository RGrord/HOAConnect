<?php
session_start();
include('../../connection/connection.php'); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$user_id = $_SESSION['user_id'];

// Check if post ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Post ID is required.");
}

$post_id = intval($_GET['id']);

// Fetch the post
$sql = "SELECT * FROM news_feed WHERE id = $post_id";
$result = mysqli_query($conn, $sql);
if (!$result || mysqli_num_rows($result) === 0) {
    die("Post not found.");
}

$post = mysqli_fetch_assoc($result);


// Handle form submission
if (isset($_POST['update_post'])) {

    $title = mysqli_real_escape_string($conn, $_POST['post_title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // Handle images
    $existingImages = explode(",", $post['post_images']);
    $uploadedImages = [];

    if (!empty($_FILES['post_images']['name'][0])) {
        foreach ($_FILES['post_images']['name'] as $key => $name) {
            $tmp_name = $_FILES['post_images']['tmp_name'][$key];
            $ext = pathinfo($name, PATHINFO_EXTENSION);
            $filename = time() . "_$key." . $ext;
            $destination = "../../uploads/images/" . $filename;

            if (move_uploaded_file($tmp_name, $destination)) {
                $uploadedImages[] = $filename;
            }
        }
        $finalImages = implode(",", $uploadedImages);
    } else {
        // Keep existing images if no new upload
        $finalImages = implode(",", $existingImages);
    }

    // Handle PDF
    if (!empty($_FILES['project_file']['name'])) {
        $pdfName = time() . "_" . basename($_FILES['project_file']['name']);
        $pdfPath = "../../uploads/files/" . $pdfName;
        if (move_uploaded_file($_FILES['project_file']['tmp_name'], $pdfPath)) {
            $finalPdf = $pdfName;
        } else {
            $finalPdf = $post['project_file'];
        }
    } else {
        $finalPdf = $post['project_file'];
    }

    // Update DB
    $updateSql = "UPDATE news_feed SET 
                    post_title='$title',
                    description='$description',
                    post_images='$finalImages',
                    project_file='$finalPdf'
                  WHERE id=$post_id";

    if (mysqli_query($conn, $updateSql)) {
        $success = "Post updated successfully!" . "<script>window.location.href='sec-newsfeed.php' </script>";
        // Refresh post data
        $sql = "SELECT * FROM news_feed WHERE id = $post_id";
        $result = mysqli_query($conn, $sql);
        $post = mysqli_fetch_assoc($result);
    } else {
        $error = "Error updating post: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit News Feed</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body class="bg-gray-50 py-10">

<div class="max-w-3xl mx-auto bg-white shadow rounded-lg p-6">
    <h2 class="text-2xl font-bold mb-4">Edit Post</h2>

    <?php if (!empty($success)): ?>
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4"><?= $success ?></div>
    <?php endif; ?>
    <?php if (!empty($error)): ?>
        <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4"><?= $error ?></div>
    <?php endif; ?>

    <form action="" method="POST" enctype="multipart/form-data" class="space-y-6">
        <div>
            <label class="block text-sm font-medium text-gray-700">Post Title</label>
            <input type="text" name="post_title" value="<?= htmlspecialchars($post['post_title']) ?>" required
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" rows="4" required
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm"><?= htmlspecialchars($post['description']) ?></textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Current Images</label>
            <div class="flex flex-wrap gap-2 mt-2">
                <?php 
                $images = explode(",", $post['post_images']);
                foreach($images as $img):
                    if(!empty($img)):
                ?>
                    <img src="../../uploads/images/<?= htmlspecialchars($img) ?>" class="w-24 h-24 object-cover rounded-lg border">
                <?php 
                    endif;
                endforeach;
                ?>
            </div>
            <label class="block text-sm font-medium text-gray-700 mt-2">Upload New Images (optional)</label>
            <input type="file" name="post_images[]" multiple accept="image/*"
                class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Project PDF</label>
            <?php if(!empty($post['project_file'])): ?>
                <p class="mb-2"><a href="../../uploads/file/<?= htmlspecialchars($post['project_file']) ?>" target="_blank" class="text-teal-600 hover:underline"><i class="fas fa-file-pdf mr-1"></i> <?= htmlspecialchars($post['project_file']) ?></a></p>
            <?php endif; ?>
            <input type="file" name="project_file" accept="application/pdf"
                class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
        </div>

        <div class="flex justify-end space-x-2">
            <a href="sec-newsfeed.php" class="py-2 px-4 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">Cancel</a>
            <button type="submit" name="update_post" class="py-2 px-4 bg-teal-600 hover:bg-teal-700 text-white rounded-md">Update Post</button>
        </div>
    </form>
</div>

</body>
</html>
