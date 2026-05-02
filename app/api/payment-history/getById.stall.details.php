<?php
ob_clean();
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';
header('Content-Type: application/json');

if (!isset($_GET['id'])) {
    echo json_encode(['success' => false, 'message' => 'Stall Renter ID required']);
    exit;
}
$renter_id = (int)$_GET['id'];

$sql = "SELECT 
    sf.*,
    s.stall_no,
    sr.renter_name,
    sr.contact_no,
    sr.amount AS monthly_rental,
    sr.start_date,
    sr.end_date
FROM stall_renter_fees sf
JOIN stall_renter sr ON sf.stall_renter_id = sr.id
JOIN stalls s ON sr.stall_id = s.id
WHERE sf.stall_renter_id = ? AND sf.status = 1
ORDER BY sf.date_created DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $renter_id);
$stmt->execute();
$result = $stmt->get_result();

$data = [];
$total = 0;
while ($row = $result->fetch_assoc()) {
    $amount = (float)$row['amount_paid'];
    $total += $amount;
    $row['amount_formatted'] = number_format($amount, 2);
    $row['monthly_formatted'] = number_format($row['monthly_rental'], 2);
    $row['date_paid'] = date('M j, Y', strtotime($row['date_created']));
    $data[] = $row;
}

echo json_encode([
    'success' => true,
    'data'    => $data,
    'total_payments' => count($data),
    'total_amount'   => number_format($total, 2),
    'renter_name'    => $data[0]['renter_name'] ?? 'Unknown',
    'stall_no'       => $data[0]['stall_no'] ?? 'N/A'
], JSON_PRETTY_PRINT);
exit;
?>