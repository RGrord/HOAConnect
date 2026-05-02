<?php

include('../connection/connection.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if(isset($_POST['approve'])){
    $fee_assignation_id = $_POST['fee_assignation_id'];
    $user_id = $_POST['user_id'];
    $amount = $_POST['amount'];
    $payment_method = $_POST['payment_method'];
    $payment_receipt_name = $_POST['payment_receipt_name'];
    $remarks = $_POST['remarks'];
    $reference_number = $_POST['reference_number'];
    $is_walk_in = 0;
    $proof_of_payment = $_POST['proof_of_payment'];
    $fee_name = $_POST['fee_name'];
    //$payment_history_id = 20 . str_pad(rand(0, 999999), 5, '0', STR_PAD_LEFT);

    


    // ✅ Insert to payment_history
    $sql_insert_history = "INSERT INTO payment_history (
        user_id,fee_type_id,fee_name, amount, payment_method, payment_receipt_name, remarks, reference_number, is_walk_in, proof_of_payment, date_created, date_updated
    ) VALUES (
        '$user_id','$fee_assignation_id', '$fee_name','$amount', '$payment_method', '$payment_receipt_name', '$remarks', '$reference_number', '$is_walk_in', '$proof_of_payment', NOW(), NOW()
    )";

    $run_insert_history = mysqli_query($conn, $sql_insert_history);

    if($run_insert_history){

        // ✅ Fetch current next_due date
        $get_due = mysqli_query($conn, "SELECT next_due FROM fee_assignation WHERE id = '$fee_assignation_id' AND user_id = '$user_id'");
        $due_row = mysqli_fetch_assoc($get_due);

        if ($due_row && !empty($due_row['next_due'])) {
            $current_due = $due_row['next_due'];
            // Add 1 month to the current next_due
            $next_due = date('Y-m-d', strtotime($current_due . ' +1 month'));
        } else {
            // If there’s no due date yet, set it to 1 month from today
            $next_due = date('Y-m-d', strtotime('+1 month'));
        }

        // ✅ Update fee_assignation: mark as paid, approved, and set next_due
        $sql_update_fee_assignation = "UPDATE fee_assignation 
            SET is_paid = '1', is_approved = '1', next_due = '$next_due', date_updated = NOW()
            WHERE id = '$fee_assignation_id' AND user_id = '$user_id'";
        $run_update_fee_assignation = mysqli_query($conn, $sql_update_fee_assignation);

        if($run_update_fee_assignation){
            // ✅ Delete payment verification record
            $delete_payment_verification = "DELETE FROM payment_verification 
                WHERE fee_assignation_id = '$fee_assignation_id' AND user_id = '$user_id'";
            $run_delete_payment_verification = mysqli_query($conn, $delete_payment_verification);

            if($run_delete_payment_verification){
                echo "Payment approved and next due set to $next_due";
            } else {
                echo "Error deleting verification";
            }
        } else {
            echo "Error updating assignation";
        }
    } else {
        echo "Error inserting payment history";
    }
}


if(isset($_POST['reject'])){

    
    $fee_assignation_id = $_POST['fee_assignation_id'];
    $user_id = $_POST['user_id'];
    $is_paid = 1;
    $is_approved = 0;

    $sql_reject_fee_assignation = "UPDATE fee_assignation SET is_paid = '$is_paid' , is_approved = '$is_approved' WHERE id = '$fee_assignation_id' AND $user_id = '$user_id'";
    $run_reject_fee_assignation = mysqli_query($conn,$sql_reject_fee_assignation);

    if($run_reject_fee_assignation){
        echo "Rejected";
    }else{
        echo "Error Reject";
    }


    
}

?>
