<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/hoa_system/app/core/init.php';

if (!isset($_SESSION['user_id'])) {
    json_error('Unauthorized');
}

$pv_id  = (int)($_POST['id'] ?? 0);
$fee_id = (int)($_POST['fee_id'] ?? 0);

if (!$pv_id || !$fee_id) {
    json_error('Invalid request');
}

$sql = "SELECT pv.*, f.fee_name, f.amount, f.user_id,
        CONCAT(TRIM(CONCAT(ui.first_name, ' ', COALESCE(ui.middle_name,''), ' ', ui.last_name))) AS full_name
        FROM payment_verification pv
        JOIN fees f ON pv.fee_id = f.id
        LEFT JOIN user_info ui ON f.user_id = ui.user_id
        WHERE pv.id = ? AND pv.is_approve = 0";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'i', $pv_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$payment = mysqli_fetch_assoc($result);

if (!$payment) {
    json_error('Payment not found or already processed');
}

mysqli_begin_transaction($conn);

try {
    mysqli_query($conn, "UPDATE payment_verification SET is_approve = 1 WHERE id = $pv_id");

    mysqli_query($conn, "UPDATE fees SET status = 1 WHERE id = $fee_id"); 

    $particulars = $payment['fee_name'] . " - " . $payment['full_name'];
    if ($payment['is_walk_in']) {
        $particulars .= " (Walk-in)";
    } else {
        $particulars .= " (" . strtoupper($payment['payment_method']) . ")";
    }

    $insert_sql = "INSERT INTO payment_history 
                   (created_by, particulars, amount, date_created)
                   VALUES (?, ?, ?, NOW())";

    $stmt2 = mysqli_prepare($conn, $insert_sql);
    mysqli_stmt_bind_param($stmt2, 'isd', 
        $_SESSION['user_id'], 
        $particulars, 
        $payment['amount']
    );
    mysqli_stmt_execute($stmt2);

    mysqli_commit($conn);

    json_success(['message' => 'Payment approved and recorded in history!']);

} catch (Exception $e) {
    mysqli_rollback($conn);
    json_error('Error: ' . $e->getMessage());
}