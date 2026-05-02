<?php
ob_clean();
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';
header('Content-Type: application/json');

if (!isset($_GET['id'])) {
    echo json_encode(['success' => false, 'message' => 'Court ID required']);
    exit;
}
$court_id = (int)$_GET['id'];

$sql = "SELECT 
    cf.*,
    c.renter_name,
    c.contact_no,
    c.purpose,
    c.start_date,
    c.end_date,
    c.no_of_participants,
    c.amount AS rental_fee
FROM court_fees cf
JOIN court c ON cf.court_id = c.id
WHERE cf.court_id = ? AND cf.status = 1
ORDER BY cf.date_created DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $court_id);
$stmt->execute();
$result = $stmt->get_result();

$data = [];
$total = 0;
while ($row = $result->fetch_assoc()) {
    $amount = (float)$row['amount_paid'];
    $total += $amount;
    $row['amount_formatted'] = number_format($amount, 2);
    $row['fee_formatted']    = number_format($row['rental_fee'], 2);
    $row['date_paid']        = date('M j, Y', strtotime($row['date_created']));
    $data[] = $row;
}

echo json_encode([
    'success' => true,
    'data'    => $data,
    'total_payments' => count($data),
    'total_amount'   => number_format($total, 2),
    'renter_name'    => $data[0]['renter_name'] ?? 'Unknown',
    'purpose'        => $data[0]['purpose'] ?? 'N/A'
], JSON_PRETTY_PRINT);
exit;
?>