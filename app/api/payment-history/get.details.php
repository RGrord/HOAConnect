<?php
ob_clean();
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';
header('Content-Type: application/json');

$sql = "(
    SELECT 
        hf.id,
        hf.user_id AS source_id,
        CONCAT(ui.first_name,' ',ui.last_name) AS payer_name,
        'Homeowner Dues' AS payment_for,
        hf.amount_paid,
        hf.payment_method,
        hf.ref_no,
        hf.attachment,
        hf.status,
        hf.remarks,
        hf.date_created
    FROM homeowner_fees hf
    LEFT JOIN users u ON hf.user_id = u.user_id
    LEFT JOIN user_info ui ON u.user_id = ui.user_id
    WHERE hf.status = 1
)
UNION ALL
(
    SELECT 
        sf.id,
        sr.stall_id AS source_id,
        sr.renter_name AS payer_name,
        CONCAT('Stall Rental - ', s.stall_no) AS payment_for,
        sf.amount_paid,
        'N/A' AS payment_method,
        NULL AS ref_no,
        sf.attachment,
        sf.status,
        sf.remarks,
        sf.date_created
    FROM stall_renter_fees sf
    JOIN stall_renter sr ON sf.stall_renter_id = sr.id
    JOIN stalls s ON sr.stall_id = s.id
    WHERE sf.status = 1
)
UNION ALL
(
    SELECT 
        tf.id,
        tf.toda_id AS source_id,
        t.toda_name AS payer_name,
        'TODA Franchise Fee' AS payment_for,
        tf.amount_paid,
        'N/A' AS payment_method,
        NULL AS ref_no,
        NULL AS attachment,
        tf.status,
        NULL AS remarks,
        tf.date_created
    FROM toda_fees tf
    JOIN toda t ON tf.toda_id = t.id
    WHERE tf.status = 1
)
UNION ALL
(
    SELECT 
        cf.id,
        cf.court_id AS source_id,
        c.renter_name AS payer_name,
        'Court Rental Fee' AS payment_for,
        cf.amount_paid,
        'N/A' AS payment_method,
        NULL AS ref_no,
        NULL AS attachment,
        cf.status,
        NULL AS remarks,
        cf.date_created
    FROM court_fees cf
    JOIN court c ON cf.court_id = c.id
    WHERE cf.status = 1
)
ORDER BY date_created DESC";

$result = mysqli_query($conn, $sql);
if (!$result) {
    echo json_encode(['success' => false, 'message' => 'Query failed']);
    exit;
}

$data = [];
$total_amount = 0;

while ($row = mysqli_fetch_assoc($result)) {
    $amount = (float)$row['amount_paid'];
    $total_amount += $amount;

    $row['amount_formatted'] = number_format($amount, 2);
    $row['date_formatted']   = date('M j, Y g:i A', strtotime($row['date_created']));
    $row['status_label']     = $row['status'] == 1 ? 'Verified' : 'Pending';

    $data[] = $row;
}

echo json_encode([
    'success' => true,
    'data'    => $data,
    'total_payments' => count($data),
    'total_amount'   => number_format($total_amount, 2),
    'generated_at'   => date('Y-m-d H:i:s')
], JSON_PRETTY_PRINT);
exit;
?>