<?php

include('../connection/connection.php');
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if (isset($_POST['create_post'])) {
    
    //created_by
    $created_by = NULL;
    

    $post_title = mysqli_real_escape_string($conn, $_POST['post_title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // UPLOAD FOLDERS
    $image_folder = "../uploads/images/";
    $file_folder  = "../uploads/files/";

    if (!file_exists($image_folder)) { mkdir($image_folder, 0777, true); }
    if (!file_exists($file_folder)) { mkdir($file_folder, 0777, true); }

    // IMAGE UPLOAD
    $post_image = "";
    foreach ($_FILES['post_images']['name'] as $key => $img) {
    $image_name = time() . "_" . $img;
    move_uploaded_file($_FILES['post_images']['tmp_name'][$key], $image_folder . $image_name);
    $all_images[] = $image_name;
}

$post_image = implode(",", $all_images); // save as comma-separated list

    // FILE UPLOAD (PDF, DOCX, ETC.)
    $project_file = "";
    if (!empty($_FILES['project_details']['name'])) {
        $file_name = time() . "_" . basename($_FILES['project_details']['name']);
        $file_path = $file_folder . $file_name;

        if (move_uploaded_file($_FILES['project_details']['tmp_name'], $file_path)) {
            $project_file = $file_name;
        }
    }

    // INSERT QUERY
    $query = "INSERT INTO news_feed (post_title, description, post_images, project_file,date_created,date_updated)
              VALUES ('$post_title', '$description', '$post_image', '$project_file', NOW() , NOW())";

    if (mysqli_query($conn, $query)) {
        echo "<script>
        alert('Posted')
        window.location.href = '../pages/news/feed.php';
        </script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}



?>