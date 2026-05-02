<?php

session_start();
include('../../connection/connection.php'); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$user_id = $_SESSION['user_id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Create Project Resolution</h1>

    <form action="../../Query/sec-create-project-resolution.php" method="POST" enctype="multipart/form-data">
        <label for="">Project Resolution Title</label>
        <input type="text" name="project_resolution_title">
        <label for="">Resolution Summary</label>
        <input type="text" name="resolution_summary">
        <label for="">Estimated Budget</label>
        <input type="number" name="estimated_budget" id="">
        <label for="">Start Date</label>
        <input type="date" name="target_start_date">
        <label for="">End Date</label>
        <input type="date" name="target_end_date">
        <input type="hidden" name="proposed_by" value="<?php echo $user_id?>">
        <label for="">Project Proposal Document</label>
        <input type="file" name="project_proposal_document" id="">
        <label for="">Upload Signed Resolution</label>
        <input type="file" name="upload_signed_resolution" id="">

    <input type="submit" name="create_project_resolution">
    </form>
    
</body>
</html>