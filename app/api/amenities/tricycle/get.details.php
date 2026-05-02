<?php
ob_clean();
header('Content-Type: application/json');

if (!@include_once($_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php')) {
    echo json_encode(['success' => false, 'message' => 'System error: Cannot load database connection']);
    exit;
}

$sql = "SELECT 
    t.id,
    t.toda_name,
    t.no_of_tricycles,
    t.representative,
    t.contact_no,
    t.fee_amount,
    t.status,
    CASE WHEN t.status = 1 THEN 'Active' ELSE 'Inactive' END AS status_label,
    t.start_date,
    t.end_date,
    t.date_created,
    COALESCE(SUM(tf.amount_paid), 0) AS total_paid,
    (t.fee_amount - COALESCE(SUM(tf.amount_paid), 0)) AS balance
FROM toda t
LEFT JOIN toda_fees tf ON t.id = tf.toda_id
GROUP BY t.id
ORDER BY t.toda_name ASC";

$result = mysqli_query($conn, $sql);

if (!$result) {
    echo json_encode([
        'success' => false,
        'message' => 'Database query failed'
    ]);
    exit;
}

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $fee = (float)($row['fee_amount'] ?? 0);
    $paid = (float)($row['total_paid'] ?? 0);
    $balance = $fee - $paid;

    $row['fee_formatted']      = number_format($fee, 2);
    $row['paid_formatted']     = number_format($paid, 2);
    $row['balance_formatted']  = number_format($balance, 2);
    $row['is_fully_paid']      = $balance <= 0;
    $row['has_balance']        = $balance > 0;
    $row['contract_period']    = date('M Y', strtotime($row['start_date'])) . 
                                 ' - ' . date('M Y', strtotime($row['end_date']));

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