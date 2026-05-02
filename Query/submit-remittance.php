<?php
include('../connection/connection.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_POST['submit_remittance'])){
    // Gather data from form
    $secretary_name = mysqli_real_escape_string($conn, $_POST['secretary_name']);
    $transaction_type = "Credit";

    // Checked payment IDs (passed as array)
    $selected_payments = $_POST['selected_payments'] ?? [];

    if(empty($selected_payments)){
        echo "<script>alert('No payments selected.'); window.history.back();</script>";
        exit;
    }

    // Calculate total amount from database (safer than trusting client)
    $ids = implode(",", array_map('intval', $selected_payments));
    $sql_total = "SELECT SUM(amount) AS total_amount FROM payment_history WHERE id IN ($ids)";
    $result_total = mysqli_query($conn, $sql_total);
    $row_total = mysqli_fetch_assoc($result_total);
    $total_amount = $row_total['total_amount'] ?? 0;

    // Insert new remittance
    $sql_insert = "INSERT INTO remittance (particular, amount, date, transaction_type, secretary_name, date_created, date_updated)
                   VALUES ('Remittance Collection', ?, NOW(), ?, ?, NOW(), NOW())";
    $stmt = mysqli_prepare($conn, $sql_insert);
    mysqli_stmt_bind_param($stmt, "dss", $total_amount, $transaction_type, $secretary_name);
    $run_insert = mysqli_stmt_execute($stmt);

    if($run_insert){
        // Optionally update payment history (mark as remitted)
        $sql_update = "UPDATE payment_history SET is_submitted ='1' , date_updated = NOW() WHERE id IN ($ids)";
        mysqli_query($conn, $sql_update);

        echo "<script>alert('Remittance submitted successfully!'); window.location.href='../Users/admin/admin-remittance.php';</script>";
       
    } else {
        echo "<script>alert('Error submitting remittance.'); window.history.back();</script>";
    }
}
?>
