<?php
include('../connection/connection.php');

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// ---- Function to assign a fee ----
function assignFee($conn, $user_id, $fee_type_id, $next_due)
{
    // Insert into fee_assignation
    $insert_sql = "INSERT INTO fee_assignation 
                   (user_id, fee_type_id, next_due, is_paid, date_created, date_updated)
                   VALUES ('$user_id', '$fee_type_id', '$next_due', 0, NOW(), NOW())";
    mysqli_query($conn, $insert_sql);

    // If insertion succeeded, link with payment_verification
    if (mysqli_affected_rows($conn) > 0) {
        $fee_assignation_id = mysqli_insert_id($conn);
    

        $insert_verification = "INSERT INTO payment_verification 
                                (fee_assignation_id, user_id, reference_number, status, date_created, date_updated)
                                VALUES ('$fee_assignation_id', '$user_id', '', 0, NOW(), NOW())";
        mysqli_query($conn, $insert_verification);
    }
}

// ---- MAIN PROCESS ----
if (isset($_POST['assign_fee'])) {

    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $fee_ids_monthly = $_POST['fee_ids_monthly'] ?? [];
    $fee_ids_one_time = $_POST['fee_ids_one_time'] ?? [];
    $start_date_input = $_POST['start_date'] ?? null;

    // Validate selection
    if (empty($fee_ids_monthly) && empty($fee_ids_one_time)) {
        echo "<script>alert('Please select at least one fee.'); window.history.back();</script>";
        exit;
    }

    // Merge all selected fees
    $all_selected_fees = array_merge($fee_ids_monthly, $fee_ids_one_time);
    if (!empty($all_selected_fees)) {
        $all_selected_fees = array_map('intval', $all_selected_fees);
        $fee_ids_csv = implode(',', $all_selected_fees);

        // Delete unselected fees
        $delete_sql = "DELETE FROM fee_assignation 
                       WHERE user_id='$user_id' 
                       AND fee_type_id NOT IN ($fee_ids_csv)";
        mysqli_query($conn, $delete_sql);
    } else {
        // Delete all fees if none are selected
        $delete_sql = "DELETE FROM fee_assignation WHERE user_id='$user_id'";
        mysqli_query($conn, $delete_sql);
    }

    // ---- PROCESS MONTHLY FEES ----
    foreach ($fee_ids_monthly as $fee_type_id) {

        // Get fee details
        $fee_sql = "SELECT amount, start_date FROM fee_type WHERE fee_type_id='$fee_type_id'";
        $fee_res = mysqli_query($conn, $fee_sql);
        $fee_row = mysqli_fetch_assoc($fee_res);
        $fee_start_date = $fee_row['start_date'] ?? date('Y-m-01');

        // Get last due
        $last_due_res = mysqli_query($conn, "SELECT MAX(next_due) AS last_due 
                                            FROM fee_assignation 
                                            WHERE user_id='$user_id' AND fee_type_id='$fee_type_id'");
        $last_due_row = mysqli_fetch_assoc($last_due_res);
        $last_due = $last_due_row['last_due'] ?? $fee_start_date;

        $last_due_date = new DateTime($last_due);
        $today = new DateTime();

        // Loop monthly dues until current month
        while ($last_due_date <= $today) {
            $next_due_str = $last_due_date->format('Y-m-01');

            $check_exist = "SELECT 1 FROM fee_assignation 
                            WHERE user_id='$user_id' AND fee_type_id='$fee_type_id' AND next_due='$next_due_str'";
            $exist_res = mysqli_query($conn, $check_exist);

            if (mysqli_num_rows($exist_res) == 0) {
                assignFee($conn, $user_id, $fee_type_id, $next_due_str);
            }

            $last_due_date->modify('first day of next month');
        }
    }

    // ---- PROCESS ONE-TIME FEES ----
    foreach ($fee_ids_one_time as $fee_type_id) {
        $check_sql = "SELECT 1 FROM fee_assignation WHERE user_id='$user_id' AND fee_type_id='$fee_type_id'";
        $check_res = mysqli_query($conn, $check_sql);

        if (mysqli_num_rows($check_res) == 0) {
            $next_due = $start_date_input ? $start_date_input : NULL;
            assignFee($conn, $user_id, $fee_type_id, $next_due);
        }
    }

    // ---- UPDATE TOTAL UNPAID BALANCE ----
    $sum_sql = "SELECT SUM(ft.amount) AS total_balance
                FROM fee_assignation fa
                JOIN fee_type ft ON fa.fee_type_id = ft.fee_type_id
                WHERE fa.user_id='$user_id' AND fa.is_paid=0";
    $sum_res = mysqli_query($conn, $sum_sql);
    $sum_row = mysqli_fetch_assoc($sum_res);
    $total_balance = $sum_row['total_balance'] ?? 0;

    $check_unpaid = "SELECT 1 FROM unpaid_fees WHERE user_id='$user_id'";
    $unpaid_res = mysqli_query($conn, $check_unpaid);

    if (mysqli_num_rows($unpaid_res) > 0) {
        $update_unpaid = "UPDATE unpaid_fees 
                          SET total_balance='$total_balance', date_updated=NOW() 
                          WHERE user_id='$user_id'";
        mysqli_query($conn, $update_unpaid);
    } else {
        $insert_unpaid = "INSERT INTO unpaid_fees 
                          (user_id, total_balance, date_created, date_updated)
                          VALUES ('$user_id', '$total_balance', NOW(), NOW())";
        mysqli_query($conn, $insert_unpaid);
    }

    echo "<script>alert('Fees updated successfully!'); window.location.href='../Users/admin/fee-assignation.php';</script>";
    exit;
}
?>
