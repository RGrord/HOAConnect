<?php
include('../connection/connection.php'); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_POST['mark_as_paid'])) {

    // Get form data
    $fee_name = $_POST['fee_name'];
    $next_due = $_POST['next_due'];
    $amount = $_POST['amount'];
    $payment_method = $_POST['payment_method'];
    $remarks = $_POST['remarks'] ?? '';
    $status = 0; // default pending
    $selected_fee_id = $_POST['selected_fees'];
    $payment_receipt_name = $_POST['payment_receipt_name'];
    $user_id = $_POST['user_id'];

    // Generate reference number
    $year = date('Y');
    $next_ref_num = 10; // you can calculate the next number dynamically
    $ref_number = $_POST['reference_number'];

    // Handle file upload
    $proof_file_name = '';
    if(isset($_FILES['proof_of_payment']) && $_FILES['proof_of_payment']['error'] == 0) {
        $upload_dir = '../uploads/';
        $tmp_name = $_FILES['proof_of_payment']['tmp_name'];
        $original_name = basename($_FILES['proof_of_payment']['name']);
        $proof_file_name = time() . '_' . preg_replace("/[^a-zA-Z0-9_\.-]/", "_", $original_name);
        $destination = $upload_dir . $proof_file_name;
        if(!move_uploaded_file($tmp_name, $destination)) {
            die("Error uploading the file.");
        }
    } else {
        die("No file uploaded or upload error.");
    }

    $date_now = date('Y-m-d');

    // Check if a payment verification already exists for this fee_assignation
    $check_sql = "SELECT id FROM payment_verification WHERE fee_assignation_id = '$selected_fee_id'";
    $check_res = mysqli_query($conn, $check_sql);

    if(mysqli_num_rows($check_res) > 0){
        // Update existing row
        $update_sql = "UPDATE payment_verification 
                       SET user_id='$user_id',
                           amount='$amount',
                           payment_method='$payment_method',
                           remarks='$remarks',
                           reference_number='$ref_number',
                           proof_of_payment='$proof_file_name',
                           status='$status',
                           date_updated='$date_now'
                       WHERE fee_assignation_id='$selected_fee_id'";
        $run = mysqli_query($conn, $update_sql);
    } else {
        // Insert new row
        $insert_sql = "INSERT INTO payment_verification 
                       (user_id, fee_assignation_id, amount, payment_method, remarks, reference_number, proof_of_payment, status, date_created, date_updated)
                       VALUES 
                       ('$user_id', '$selected_fee_id', '$amount', '$payment_method', '$remarks', '$ref_number', '$proof_file_name', '$status', '$date_now', '$date_now')";
        $run = mysqli_query($conn, $insert_sql);
    }

    if($run){
        // Update fee_assignation
        $update_fee_sql = "UPDATE fee_assignation 
                           SET is_approved='2', 
                               payment_receipt_name='$payment_receipt_name',
                               payment_method='$payment_method'
                           WHERE id='$selected_fee_id' AND user_id='$user_id'";
        mysqli_query($conn, $update_fee_sql);

        echo "<script>alert('Payment processed successfully!'); window.location.href='../Users/home-owner/homeowner-payment.php?user_id=$user_id';</script>";
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
