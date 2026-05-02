<?php
session_start();
include('../connection/connection.php'); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$user_id = $_SESSION['user_id'] ?? '';

if(isset($_GET['id'])){
    $id = intval($_GET['id']);
    $sql_project = "SELECT id, project_resolution_title, estimated_budget FROM resolution WHERE id='$id'";
    $run_project = mysqli_query($conn, $sql_project);
    $project = mysqli_fetch_assoc($run_project);
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $project_id = intval($_POST['project_id']);
    $remarks = mysqli_real_escape_string($conn, $_POST['remarks'] ?? '');
    $total_expenses = floatval($_POST['total_expenses'] ?? 0);
    $remaining_budget = floatval($_POST['remaining_budget'] ?? 0);
    $audit_result = mysqli_real_escape_string($conn, $_POST['audit_result'] ?? '');

    // Upload directory (must exist and writable)
    $upload_dir = __DIR__ . '/../uploads/liquidation_expenses/';
    if(!is_dir($upload_dir)) die("Upload folder does not exist: $upload_dir");
    if(!is_writable($upload_dir)) die("Upload folder is not writable: $upload_dir");

    // Insert into liquidation_of_expenses
    $insert_liq = "INSERT INTO liquidation_of_expenses (project_resolution_id, status, total_expenses, date_created, date_updated) 
                   VALUES ('$project_id', 0, '$total_expenses', NOW(), NOW())";
    if(mysqli_query($conn, $insert_liq)){
        $liq_id = mysqli_insert_id($conn);

        if(isset($_POST['expense_particular'])){
            for($i=0; $i<count($_POST['expense_particular']); $i++){
                $particular = mysqli_real_escape_string($conn, $_POST['expense_particular'][$i]);
                $amount = floatval($_POST['expense_amount'][$i]);

                $receipt_file = '';
                if(isset($_FILES['expense_receipt']['name'][$i]) && $_FILES['expense_receipt']['error'][$i] === 0){
                    $tmp_name = $_FILES['expense_receipt']['tmp_name'][$i];
                    $filename = time().'_'.preg_replace("/[^a-zA-Z0-9_.-]/", "_", $_FILES['expense_receipt']['name'][$i]);
                    $target_file = $upload_dir . $filename;
                    if(!move_uploaded_file($tmp_name, $target_file)){
                        die("Failed to upload file: $filename. Check folder permissions.");
                    }
                    $receipt_file = $filename;
                }

                $insert_exp = "INSERT INTO liquidation_expenses_details
                               (liquidation_id, amount, receipt, total_expenses, remaning_budget, audit_result, remarks, date_created, date_updated)
                               VALUES
                               ('$liq_id', '$amount', '$receipt_file', '$total_expenses', '$remaining_budget', '$audit_result', '$remarks', NOW(), NOW())";
                mysqli_query($conn, $insert_exp);
            }
        }

        echo "<p style='color:green;'>Liquidation saved successfully!</p>";
    } else {
        die("Database error: ".mysqli_error($conn));
    }
}
?>



