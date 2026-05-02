<?php
header('Content-Type: application/json');
include_once($_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

$created_by = $_POST['created_by'] ?? null;
$post_title = trim($_POST['post_title'] ?? '');
$description = trim($_POST['description'] ?? '');

if (!$created_by || !$post_title || !$description) {
    echo json_encode(['success' => false, 'message' => 'All required fields must be filled.']);
    exit;
}

$post_image_path = null;
$project_file_path = null;

$uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/uploads/newsfeed/';

if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if (isset($_FILES['post_images']) && $_FILES['post_images']['error'] === UPLOAD_ERR_OK) {
    $fileTmp = $_FILES['post_images']['tmp_name'];
    $fileName = time() . '_' . basename($_FILES['post_images']['name']);
    $targetPath = $uploadDir . $fileName;

    if (move_uploaded_file($fileTmp, $targetPath)) {
        $post_image_path = '/hoa_system/uploads/newsfeed/' . $fileName;
    }
}

if (isset($_FILES['project_file']) && $_FILES['project_file']['error'] === UPLOAD_ERR_OK) {
    $fileTmp = $_FILES['project_file']['tmp_name'];
    $fileName = time() . '_' . basename($_FILES['project_file']['name']);
    $targetPath = $uploadDir . $fileName;

    if (move_uploaded_file($fileTmp, $targetPath)) {
        $project_file_path = '/hoa_system/uploads/newsfeed/' . $fileName;
    }
}

$sql = "INSERT INTO news_feed (created_by, post_title, description, post_images, project_file, date_created, date_updated)
        VALUES (?, ?, ?, ?, ?, NOW(), NOW())";
        
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "issss", $created_by, $post_title, $description, $post_image_path, $project_file_path);

if (mysqli_stmt_execute($stmt)) {
    echo json_encode(['success' => true, 'message' => 'Newsfeed post created successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . mysqli_error($conn)]);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
