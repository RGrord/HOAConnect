<?php
ob_clean();
header('Content-Type: application/json');

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid ID']);
    exit;
}

$id = (int)$_GET['id'];

// Safe include
if (!@include_once($_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php')) {
    echo json_encode(['success' => false, 'message' => 'System error']);
    exit;
}

// Query with proper JOIN
$sql = "SELECT 
    s.id AS stall_id,
    s.stall_no,
    s.status AS stall_status,
    s.remarks AS stall_remarks,
    s.date_created AS stall_created,
    
    r.id AS renter_id,
    r.renter_name,
    r.contact_no,
    r.rental_duration,
    r.start_date,
    r.end_date,
    r.amount,
    r.status,
    r.remarks AS renter_remarks,
    r.date_created AS renter_created,
    
    COALESCE(SUM(rf.amount_paid), 0) AS total_paid

FROM stalls s
LEFT JOIN stall_renter r ON s.id = r.stall_id AND r.status = 1
LEFT JOIN stall_renter_fees rf ON r.id = rf.stall_renter_id
WHERE r.id = ?
GROUP BY s.id, r.id";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'Database error']);
    exit;
}

$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'Stall not found']);
    $stmt->close();
    exit;
}

$stall = $result->fetch_assoc();
$stmt->close();

$amount  = (float)($stall['amount'] ?? 0);
$paid    = (float)$stall['total_paid'];
$balance = $amount - $paid;

$stall['amount_formatted']     = number_format($amount, 2);
$stall['total_paid_formatted'] = number_format($paid, 2);
$stall['balance']              = $balance;
$stall['balance_formatted']    = number_format($balance, 2);
$stall['is_fully_paid']        = $balance <= 0;
$stall['is_occupied']          = !empty($stall['renter_name']);

if ($stall['start_date']) {
    $stall['rental_period'] = date('M j, Y', strtotime($stall['start_date'])) . 
                              ' - ' . date('M j, Y', strtotime($stall['end_date']));
} else {
    $stall['rental_period'] = 'No active contract';
}

$payments = [];
if ($stall['renter_id']) {
    $pay_result = $conn->query("SELECT amount_paid, attachment, remarks, date_created 
                                FROM stall_renter_fees 
                                WHERE stall_renter_id = " . (int)$stall['renter_id'] . " 
                                ORDER BY date_created DESC");
    while ($p = $pay_result->fetch_assoc()) {
        $p['amount_formatted'] = number_format($p['amount_paid'], 2);
        $p['date_paid'] = date('M j, Y', strtotime($p['date_created']));
        $payments[] = $p;
    }
}
$stall['payment_history'] = $payments;

echo json_encode([
    'success' => true,
    'data'    => $stall
], JSON_PRETTY_PRINT);

exit;
?>