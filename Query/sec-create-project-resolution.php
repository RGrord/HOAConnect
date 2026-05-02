<?php
session_start();
include('../connection/connection.php'); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Get user ID from session
$user_id = $_SESSION['user_id'] ?? '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Collect form data safely
    $project_resolution_title = mysqli_real_escape_string($conn, $_POST['project_resolution_title']);
    $resolution_summary = mysqli_real_escape_string($conn, $_POST['resolution_summary']);
    $estimated_budget = mysqli_real_escape_string($conn, $_POST['estimated_budget']);
    $target_start_date = mysqli_real_escape_string($conn, $_POST['target_start_date']);
    $target_end_date = mysqli_real_escape_string($conn, $_POST['target_end_date']);
    $proposed_by = mysqli_real_escape_string($conn, $_POST['proposed_by']);

    // Upload directory (must exist and be writable)
    $upload_dir = __DIR__ . '/../uploads/project_resolution/';
 
    $allowed_types = ['application/pdf'];

    $upload_dir = __DIR__ . '/../uploads/project_resolution/';

    if (!is_dir($upload_dir)) {
        die("Folder does not exist: $upload_dir");
    }
    if (!is_writable($upload_dir)) {
        die("Folder exists but is not writable: $upload_dir");
    }
    echo "Upload folder is ready!";


    

    // Function to handle PDF upload
    function upload_pdf($file_input_name, $upload_dir, $allowed_types) {
        if (!isset($_FILES[$file_input_name]) || $_FILES[$file_input_name]['error'] != 0) {
            return '';
        }

        $file_tmp = $_FILES[$file_input_name]['tmp_name'];
        $file_name = time() . '_' . basename($_FILES[$file_input_name]['name']);
        $file_type = mime_content_type($file_tmp);

        if (!in_array($file_type, $allowed_types)) {
            die(ucwords(str_replace('_', ' ', $file_input_name)) . " must be a PDF file.");
        }

        if (!move_uploaded_file($file_tmp, $upload_dir . $file_name)) {
            die("Failed to move file: $file_name. Check folder permissions.");
        }

        return $file_name;
    }

    // Upload files
    $project_proposal_document = upload_pdf('project_proposal_document', $upload_dir, $allowed_types);
    $upload_signed_resolution = upload_pdf('upload_signed_resolution', $upload_dir, $allowed_types);

    // Insert into database
    $sql = "INSERT INTO resolution 
            (project_resolution_title, resolution_summary, estimated_budget, target_start_date, target_end_date, proposed_by, project_proposal_document, upload_signed_resolution, created_by) 
            VALUES 
            ('$project_resolution_title', '$resolution_summary', '$estimated_budget', '$target_start_date', '$target_end_date', '$proposed_by', '$project_proposal_document', '$upload_signed_resolution', '$user_id')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>window.location.href='../Users/secretary/sec-projectproposal.php'</script>";
    } else {
        die("Database error: " . mysqli_error($conn));
        
    }
}
?>