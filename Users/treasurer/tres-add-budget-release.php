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
    <title>Release Budget</title>
</head>
<body>

<h1>Release Budget</h1>

<?php
// DISPLAY FORM
if(isset($_GET['id'])){
    $id = $_GET['id'];

    $query_project = "SELECT * FROM resolution WHERE id = '$id'";
    $run_project = mysqli_query($conn, $query_project);

    if(mysqli_num_rows($run_project) > 0){
        foreach($run_project as $row_project){
?>

<!-- FORM -->
<form action="" method="POST" enctype="multipart/form-data">

    <label>Project Resolution Title:</label>
    <input type="text" name="project_resolution_title" value="<?php echo $row_project['project_resolution_title']; ?>" readonly>

    <label>Amount Requested:</label>
    <input type="text" name="estimated_budget" value="<?php echo $row_project['estimated_budget']; ?>" readonly>

    <label>Recipient:</label>
    <input type="text" name="recipient" required>

    <label>Release Date:</label>
    <input type="date" name="release_date" required>

    <label>Payment Method:</label>
    <select name="payment_method" required>
        <option value="">-Select-</option>
        <option value="Cash">Cash</option>
        <option value="Bank Transfer">Bank Transfer</option>
        <option value="Check">Check</option>
    </select>

    <label>Reference Number:</label>
    <input type="text" name="reference_number">

    <label>Acknowledgement Receipt:</label>
    <input type="file" name="acknowledgement_receipt">

    <label>Purpose:</label>
    <input type="text" name="purpose" required>

    <label>Approval Notes:</label>
    <input type="text" name="approval_notes">

    <input type="hidden" name="project_id" value="<?php echo $row_project['id']; ?>">

    <input type="submit" value="Submit Budget Release" name="budget_release">

</form>

<?php
        }
    }
}
?>

<?php
// PROCESS FORM SUBMISSION
if(isset($_POST['budget_release'])) {

    $project_id       = $_POST['project_id'];
    $recipient        = $_POST['recipient'];
    $release_date     = $_POST['release_date'];
    $payment_method   = $_POST['payment_method'];
    $reference_number = $_POST['reference_number'];
    $purpose          = $_POST['purpose'];
    $approval_notes   = $_POST['approval_notes'];

    // FILE UPLOAD HANDLING
    $uploaded_file = "";

    if (!empty($_FILES['acknowledgement_receipt']['name'])) {

        $targetDir = $_SERVER['DOCUMENT_ROOT'] . "/hoa_system/uploads/budget_release/";
        $originalFile = $_FILES['acknowledgement_receipt']['name'];
        $tempPath = $_FILES['acknowledgement_receipt']['tmp_name'];
        $newFilename = time() . "_" . basename($originalFile);

        $finalPath = $targetDir . $newFilename;

        if (move_uploaded_file($tempPath, $finalPath)) {
            $uploaded_file = $newFilename;
        } else {
            echo "<p style='color:red'>File upload failed.</p>";
        }
    }

    // INSERT INTO TABLE
    $save_query = "INSERT INTO budget (project_id, recipient, release_date, payment_method, reference_number, 
            acknowledgement_receipt, purpose, approval_notes, created_by, has_release) VALUES ('$project_id', '$recipient', '$release_date', '$payment_method', '$reference_number','$uploaded_file', '$purpose', '$approval_notes', '$user_id', 1)";

    $run_save = mysqli_query($conn, $save_query);

    if($run_save){
        // UPDATE RESOLUTION TABLE
        $update_res = "UPDATE resolution SET is_budget_released = 1 WHERE id = '$project_id'";
        mysqli_query($conn, $update_res);

        echo "<script>alert('Budget Released Successfully!'); window.location.href='tres-project.php';</script>";
    } else {
        echo "<p style='color:red'>Error saving budget release: " . mysqli_error($conn) . "</p>";
    }
}
?>

</body>
</html>
