<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';
header('Content-Type: application/json');

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo json_encode(['success' => false, 'message' => 'ID required']);
    exit;
}

$id = (int)$_GET['id'];

$sql = "SELECT 
    c.*,
    CASE WHEN c.status = 1 THEN 'Paid' ELSE 'Pending' END AS status_label
FROM court c
WHERE c.id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'Not found']);
    $stmt->close();
    exit;
}

$court = $result->fetch_assoc();
$stmt->close();

// Get total paid
$paid_sql = "SELECT COALESCE(SUM(amount_paid), 0) AS total_paid FROM court_fees WHERE court_id = ?";
$paid_stmt = $conn->prepare($paid_sql);
$paid_stmt->bind_param("i", $id);
$paid_stmt->execute();
$paid_result = $paid_stmt->get_result();
$paid = $paid_result->fetch_assoc()['total_paid'];
$paid_stmt->close();

$amount  = (float)$court['amount'];
$balance = $amount - (float)$paid;

$court['total_paid']          = number_format($paid, 2, '.', '');
$court['balance']             = $balance;
$court['balance_formatted']   = number_format($balance, 2, '.', '');
$court['is_fully_paid']       = $balance <= 0;
$court['amount_formatted']    = number_format($amount, 2, '.', '');

// Format dates
$court['start_date_full'] = date('F j, Y', strtotime($court['start_date']));
$court['end_date_full']   = $court['end_date'] ? date('F j, Y', strtotime($court['end_date'])) : 'Same day';
$court['created_at_full'] = date('F j, Y g:i A', strtotime($court['date_created']));

// Payment history
$hist_sql = "SELECT amount_paid, status, date_created 
             FROM court_fees 
             WHERE court_id = ? 
             ORDER BY date_created DESC";

$hist_stmt = $conn->prepare($hist_sql);
$hist_stmt->bind_param("i", $id);
$hist_stmt->execute();
$hist_result = $hist_stmt->get_result();

$payments = [];
while ($p = $hist_result->fetch_assoc()) {
    $p['amount_formatted'] = number_format($p['amount_paid'], 2);
    $p['date_paid']        = date('M j, Y g:i A', strtotime($p['date_created']));
    $payments[] = $p;
}
$hist_stmt->close();

$court['payment_history'] = $payments;

echo json_encode([
    'success' => true,
    'data'    => $court
], JSON_PRETTY_PRINT);
exit;
?>