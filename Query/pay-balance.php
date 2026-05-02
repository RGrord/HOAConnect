<?php
include('../connection/connection.php'); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_POST['mark_as_paid'])) {
    $user_id = $_POST['user_id'] ?? '';
    $selected_fees = $_POST['selected_fees'] ?? [];
    $payment_method = $_POST['payment_method'] ?? '';
    $payment_receipt_name = $_POST['payment_receipt_name'] ?? '';
    $remarks = $_POST['remarks'] ?? '';
    $is_walk_in = 1;

    if(empty($user_id)) {
        echo "<script>alert('Missing user ID.'); window.history.back();</script>";
        exit;
    }

    if(empty($selected_fees)) {
        echo "<script>alert('Please select at least one fee to pay.'); window.history.back();</script>";
        exit;
    }

    foreach($selected_fees as $fee_id) {
        // Get fee info
        $fee_sql = "SELECT fa.id, fa.fee_type_id, fa.next_due, fa.is_paid, ft.amount, ft.cadence 
                    FROM fee_assignation fa
                    JOIN fee_type ft ON fa.fee_type_id = ft.fee_type_id
                    WHERE fa.id='$fee_id' AND fa.user_id='$user_id' LIMIT 1";
        $fee_res = mysqli_query($conn, $fee_sql);
        if(mysqli_num_rows($fee_res) == 0) continue;
        $fee = mysqli_fetch_assoc($fee_res);

        // 1️⃣ Mark as paid
        $update_sql = "UPDATE fee_assignation 
                       SET is_paid = 1, payment_method = '$payment_method', payment_receipt_name = '$payment_receipt_name', remarks = '$remarks', date_updated = NOW() 
                       WHERE id = '{$fee['id']}'";
        mysqli_query($conn, $update_sql);

        // 2️⃣ Generate reference number
        // Get last ID in payment_history to generate next sequence
        $last_ref = mysqli_query($conn, "SELECT id FROM payment_history ORDER BY id DESC LIMIT 1");
        $last_id = 0;
        if(mysqli_num_rows($last_ref) > 0) {
            $last_row = mysqli_fetch_assoc($last_ref);
            $last_id = $last_row['id'];
        }
        $next_ref_num = $last_id + 1;
        $year = date('Y');
        $ref_number = sprintf("REF-%s-%04d", $year, $next_ref_num);

        // 3️⃣ Add to payment history
        $insert_history = "INSERT INTO payment_history 
                           (user_id, amount, payment_method, payment_receipt_name, remarks,is_walk_in,proof_of_payment, date_created, date_updated, reference_number)
                           VALUES ('{$user_id}', '{$fee['amount']}', '$payment_method', '$payment_receipt_name', '$remarks', '$is_walk_in', NULL, NOW(), NOW(), '$ref_number')";
        mysqli_query($conn, $insert_history);

        // 4️⃣ Generate next month for monthly cadence fees
        if($fee['cadence'] == 1) {
            $current_due = new DateTime($fee['next_due']);
            $today = new DateTime();

            // Calculate next due month: always the 1st of the next month after the current next_due
            do {
                $current_due->modify('first day of next month');
                $next_due_str = $current_due->format('Y-m-d');

                // Check if next month already exists
                $check_next = mysqli_query($conn, "SELECT 1 FROM fee_assignation 
                                                  WHERE user_id='$user_id' AND fee_type_id='{$fee['fee_type_id']}' AND next_due='$next_due_str'");
                if(mysqli_num_rows($check_next) == 0) {
                    // Insert next month
                    $insert_next = "INSERT INTO fee_assignation 
                                    (user_id, fee_type_id, next_due, is_paid, date_created, date_updated)
                                    VALUES ('$user_id', '{$fee['fee_type_id']}', '$next_due_str', 0, NOW(), NOW())";
                    mysqli_query($conn, $insert_next);
                }
            } while($current_due <= $today); // Repeat if user pays multiple months in advance
        }
    }

    // 5️⃣ Recalculate unpaid balance
    $sum_sql = "SELECT SUM(ft.amount) AS total_balance
                FROM fee_assignation fa
                JOIN fee_type ft ON fa.fee_type_id = ft.fee_type_id
                WHERE fa.user_id='$user_id' AND fa.is_paid=0";
    $sum_res = mysqli_query($conn, $sum_sql);
    $sum_row = mysqli_fetch_assoc($sum_res);
    $total_balance = $sum_row['total_balance'] ?? 0;

    // 6️⃣ Update or remove unpaid_fees
    if($total_balance > 0) {
        $check_unpaid = mysqli_query($conn, "SELECT 1 FROM unpaid_fees WHERE user_id='$user_id'");
        if(mysqli_num_rows($check_unpaid) > 0) {
            mysqli_query($conn, "UPDATE unpaid_fees SET total_balance='$total_balance', date_updated=NOW() WHERE user_id='$user_id'");
        } else {
            mysqli_query($conn, "INSERT INTO unpaid_fees (user_id, total_balance, date_created, date_updated) 
                                VALUES ('$user_id', '$total_balance', NOW(), NOW())");
        }
    } else {
        // Remove unpaid_fees row if nothing left
        mysqli_query($conn, "DELETE FROM unpaid_fees WHERE user_id='$user_id'");
    }

    echo "<script>alert('Selected fees marked as paid successfully!'); window.location.href='../Users/admin/fee-assignation.php?user_id=$user_id';</script>";
    exit;
}
?>
