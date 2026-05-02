<?php
ob_clean();
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';
header('Content-Type: application/json');

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo json_encode(['success' => false, 'message' => 'User ID required']);
    exit;
}
$user_id = (int)$_GET['id'];

$sql = "SELECT 
    'Homeowner Dues' AS payment_for,
    hf.amount_paid,
    hf.payment_method,
    hf.ref_no,
    hf.attachment,
    hf.remarks,
    hf.date_created
FROM homeowner_fees hf
WHERE hf.user_id = ? AND hf.status = 1
ORDER BY hf.date_created DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$data = [];
$total = 0;
while ($row = $result->fetch_assoc()) {
    $amount = (float)$row['amount_paid'];
    $total += $amount;
    $row['amount_formatted'] = number_format($amount, 2);
    $row['date_formatted']   = date('M j, Y g:i A', strtotime($row['date_created']));
    $data[] = $row;
}

echo json_encode([
    'success' => true,
    'user_id' => $user_id,
    'data'    => $data,
    'total_payments' => count($data),
    'total_amount'   => number_format($total, 2)
], JSON_PRETTY_PRINT);
exit;
?>