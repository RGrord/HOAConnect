<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/hoa_system/app/core/init.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success'=>false,'message'=>'Invalid request']);
    exit;
}

$payment_id = intval($_POST['payment_id']);
$approved_by = intval($_POST['approved_by']); 
try {
    // Fetch payment and fees
    $stmt = $conn->prepare("SELECT fee_id, created_by FROM payment_verification WHERE id=?");
    $stmt->bind_param("i", $payment_id);
    $stmt->execute();
    $payment = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if(!$payment) throw new Exception("Payment not found");

    $fee_ids = explode(',', $payment['fee_id']);

    // Update payment verification
    $stmt = $conn->prepare("UPDATE payment_verification SET is_approve=1 WHERE id=?");
    $stmt->bind_param("i", $payment_id);
    $stmt->execute();
    $stmt->close();

    // Update fees and insert into payment_history
    $stmtFee = $conn->prepare("UPDATE fees SET status=1 WHERE id=?");
    $stmtHist = $conn->prepare("INSERT INTO payment_history (fee_id, created_by, particulars, amount, date_created) VALUES (?,?,?,?,NOW())");

    foreach($fee_ids as $fee_id){
        $fee_id = intval($fee_id);
        $stmtFee->bind_param("i", $fee_id);
        $stmtFee->execute();

        // Fetch amount and fee name
        $row = $conn->query("SELECT fee_name, amount FROM fees WHERE id=$fee_id")->fetch_assoc();
        $particulars = $row['fee_name'];
        $amount = $row['amount'];

        $stmtHist->bind_param("iisd", $fee_id, $approved_by, $particulars, $amount);
        $stmtHist->execute();
    }

    $stmtFee->close();
    $stmtHist->close();

    echo json_encode(['success'=>true,'message'=>'Payment approved']);

}catch(Exception $e){
    echo json_encode(['success'=>false,'message'=>'Database error: '.$e->getMessage()]);
}
