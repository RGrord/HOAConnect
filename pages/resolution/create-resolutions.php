<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';

header('Content-Type: application/json');
$user_id = $_SESSION['user_id'];
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request method.'
    ]);
    exit;
}

$required = ['project_resolution_title', 'resolution_summary', 'proposed_by'];
foreach ($required as $field) {
    if (empty($_POST[$field])) {
        echo json_encode([
            'success' => false,
            'message' => ucfirst(str_replace('_', ' ', $field)) . ' is required.'
        ]);
        exit;
    }
}

$project_resolution_title   = trim($_POST['project_resolution_title']);
$resolution_summary         = trim($_POST['resolution_summary']);
$estimated_budget           = !empty($_POST['estimated_budget']) ? floatval($_POST['estimated_budget']) : null;
$target_start_date          = !empty($_POST['target_start_date']) ? $_POST['target_start_date'] : null;
$target_end_date            = !empty($_POST['target_end_date']) ? $_POST['target_end_date'] : null;
$proposed_by                = $user_id;
$status                     = !empty($_POST['status']) ? trim($_POST['status']) : 'pending';
$created_by                 = !empty($_POST['created_by']) ? intval($_POST['created_by']) : null;

$uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/uploads/resolutions/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$project_proposal_document = null;
if (!empty($_FILES['project_proposal_document']['name'])) {
    $file = $_FILES['project_proposal_document'];
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = uniqid('proposal_') . '.' . $ext;
    if (move_uploaded_file($file['tmp_name'], $uploadDir . $filename)) {
        $project_proposal_document = $filename;
    }
}

$upload_signed_resolution = null;
if (!empty($_FILES['upload_signed_resolution']['name'])) {
    $file = $_FILES['upload_signed_resolution'];
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = uniqid('signed_') . '.' . $ext;
    if (move_uploaded_file($file['tmp_name'], $uploadDir . $filename)) {
        $upload_signed_resolution = $filename;
    }
}

try {
    $sql = "
        INSERT INTO resolution (
            project_resolution_title, resolution_summary, estimated_budget,
            target_start_date, target_end_date, proposed_by, 
            project_proposal_document, upload_signed_resolution,
            status, created_by
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 0, ?)
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "ssdsssssi",
        $project_resolution_title,
        $resolution_summary,
        $estimated_budget,
        $target_start_date,
        $target_end_date,
        $proposed_by,
        $project_proposal_document,
        $upload_signed_resolution,
        $user_id
    );

    $result = $stmt->execute();

    if ($result) {
        echo json_encode([
            'success' => true,
            'message' => 'Board resolution created successfully!'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Failed to create board resolution.'
        ]);
    }

    $stmt->close();

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage()
    ]);
}
?>
