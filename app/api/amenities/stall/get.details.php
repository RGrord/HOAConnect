<?php
ob_clean();
header('Content-Type: application/json');

if (!@include_once($_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php')) {
    echo json_encode(['success' => false, 'message' => 'Cannot connect to database']);
    exit;
}

$sql = "SELECT 
    s.id AS stall_id,
    s.stall_no,
    s.status AS stall_status,
    s.remarks AS stall_remarks,
    
    r.id AS renter_id,
    r.renter_name,
    r.contact_no,
    r.rental_duration,
    r.start_date,
    r.end_date,
    r.amount,
    r.status,
    r.remarks AS renter_remarks,
    
    COALESCE(SUM(rf.amount_paid), 0) AS total_paid

FROM stalls s
LEFT JOIN stall_renter r ON s.id = r.stall_id AND r.status = 1
LEFT JOIN stall_renter_fees rf ON r.id = rf.stall_renter_id
GROUP BY s.id
ORDER BY CAST(s.stall_no AS UNSIGNED) ASC, s.stall_no ASC";

$result = mysqli_query($conn, $sql);

if (!$result) {
    echo json_encode(['success' => false, 'message' => 'Database query failed']);
    exit;
}

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $amount  = (float)($row['amount'] ?? 0);
    $paid    = (float)$row['total_paid'];
    $balance = $amount - $paid;

    $row['amount_formatted']     = number_format($amount, 2);
    $row['total_paid_formatted'] = number_format($paid, 2);
    $row['balance']              = $balance;
    $row['balance_formatted']    = number_format($balance, 2);
    $row['is_fully_paid']        = $balance <= 0;
    $row['has_balance']          = $balance > 0;
    $row['is_occupied']          = !empty($row['renter_name']);

    if ($row['start_date'] && $row['end_date']) {
        $row['rental_period'] = date('M j, Y', strtotime($row['start_date'])) . 
                                ' - ' . date('M j, Y', strtotime($row['end_date']));
    } else {
        $row['rental_period'] = 'Vacant';
    }

    $data[] = $row;
}

echo json_encode([
    'success' => true,
    'data'    => $data,
    'total'   => count($data),
    'generated_at' => date('Y-m-d H:i:s')
], JSON_PRETTY_PRINT);

exit;
?>