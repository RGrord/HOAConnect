<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';

header('Content-Type: application/json');

$sql = "SELECT 
    c.id,
    c.renter_name,
    c.contact_no,
    c.purpose,
    c.amount,
    c.start_date,
    c.end_date,
    c.no_of_participants,
    c.status,
    CASE 
        WHEN c.status = 1 THEN 'Paid'
        WHEN c.status = 0 THEN 'Pending'
        ELSE 'Cancelled'
    END AS status_label,
    c.date_created,
    
    COALESCE(SUM(cf.amount_paid), 0) AS total_paid,

    (c.amount - COALESCE(SUM(cf.amount_paid), 0)) AS balance

FROM court c
LEFT JOIN court_fees cf ON c.id = cf.court_id
GROUP BY c.id
ORDER BY c.date_created DESC";

$result = mysqli_query($conn, $sql);

if (!$result) {
    echo json_encode([
        'success' => false,
        'message' => 'Query failed: ' . mysqli_error($conn)
    ]);
    exit;
}

$rentals = [];
while ($row = mysqli_fetch_assoc($result)) {
    
    // Clean numbers
    $row['amount']      = number_format((float)$row['amount'], 2, '.', '');
    $row['total_paid']  = number_format((float)$row['total_paid'], 2, '.', '');
    $row['balance']     = (float)$row['balance'];
    $row['balance_formatted'] = number_format($row['balance'], 2, '.', '');

    // Boolean flags para sa buttons
    $row['is_fully_paid'] = $row['balance'] <= 0;
    $row['has_balance']   = $row['balance'] > 0;

    // Format dates
    $row['start_date_formatted'] = date('M d, Y', strtotime($row['start_date']));
    $row['end_date_formatted']   = $row['end_date'] ? date('M d, Y', strtotime($row['end_date'])) : 'Same day';
    $row['date_created_formatted'] = date('M d, Y g:i A', strtotime($row['date_created']));

    $rentals[] = $row;
}

echo json_encode([
    'success' => true,
    'message' => 'Court rentals retrieved successfully',
    'data'    => $rentals,
    'total'   => count($rentals)
], JSON_PRETTY_PRINT);

exit;
?>