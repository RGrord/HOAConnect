<?php
header('Content-Type: application/json');
include_once($_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

$id = $_POST['id'] ?? null;
$post_title = trim($_POST['post_title'] ?? '');
$description = trim($_POST['description'] ?? '');

if (!$id || !$post_title || !$description) {
    echo json_encode(['success' => false, 'message' => 'All required fields must be filled.']);
    exit;
}

$sqlFetch = "SELECT post_images, project_file FROM news_feed WHERE id = ?";
$stmtFetch = mysqli_prepare($conn, $sqlFetch);
mysqli_stmt_bind_param($stmtFetch, "i", $id);
mysqli_stmt_execute($stmtFetch);
$resultFetch = mysqli_stmt_get_result($stmtFetch);
$existing = mysqli_fetch_assoc($resultFetch);

if (!$existing) {
    echo json_encode(['success' => false, 'message' => 'Post not found.']);
    exit;
}

$uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/uploads/newsfeed/';

if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$post_image_path = $existing['post_images'];
if (isset($_FILES['post_images']) && $_FILES['post_images']['error'] === UPLOAD_ERR_OK) {
    $fileTmp = $_FILES['post_images']['tmp_name'];
    $fileName = time() . '_' . basename($_FILES['post_images']['name']);
    $targetPath = $uploadDir . $fileName;

    if (move_uploaded_file($fileTmp, $targetPath)) {
        $post_image_path = '/hoa_system/uploads/newsfeed/' . $fileName;
        if ($existing['post_images'] && file_exists($_SERVER['DOCUMENT_ROOT'] . $existing['post_images'])) {
            unlink($_SERVER['DOCUMENT_ROOT'] . $existing['post_images']);
        }
    }
}

$project_file_path = $existing['project_file'];
if (isset($_FILES['project_file']) && $_FILES['project_file']['error'] === UPLOAD_ERR_OK) {
    $fileTmp = $_FILES['project_file']['tmp_name'];
    $fileName = time() . '_' . basename($_FILES['project_file']['name']);
    $targetPath = $uploadDir . $fileName;

    if (move_uploaded_file($fileTmp, $targetPath)) {
        $project_file_path = '/hoa_system/uploads/newsfeed/' . $fileName;
        if ($existing['project_file'] && file_exists($_SERVER['DOCUMENT_ROOT'] . $existing['project_file'])) {
            unlink($_SERVER['DOCUMENT_ROOT'] . $existing['project_file']);
        }
    }
}

$sql = "UPDATE news_feed 
        SET post_title = ?, description = ?, post_images = ?, project_file = ?, date_updated = NOW()
        WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ssssi", $post_title, $description, $post_image_path, $project_file_path, $id);

if (mysqli_stmt_execute($stmt)) {
    echo json_encode(['success' => true, 'message' => 'Newsfeed post updated successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . mysqli_error($conn)]);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
