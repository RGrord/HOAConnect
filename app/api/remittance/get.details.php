<?php
ob_clean();
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';
header('Content-Type: application/json');

$sql = "SELECT 
    r.id,
    r.user_id,
    r.particular,
    r.amount,
    r.date,
    r.transaction_type,
    r.status,
    CASE 
        WHEN r.status = 1 THEN 'Posted'
        WHEN r.status = 0 THEN 'Pending'
        ELSE 'Cancelled'
    END AS status_label,
    r.date_created,
    CONCAT(ui.first_name, ' ', ui.last_name) AS full_name
FROM remittance r
LEFT JOIN users u ON r.user_id = u.user_id
LEFT JOIN user_info ui ON u.user_id = ui.user_id
ORDER BY r.date DESC, r.date_created DESC";

$result = mysqli_query($conn, $sql);
if (!$result) {
    echo json_encode(['success' => false, 'message' => 'Query failed']);
    exit;
}

$data = [];
$total_amount = 0;

while ($row = mysqli_fetch_assoc($result)) {
    $amount = (float)$row['amount'];
    $total_amount += $amount;

    $row['amount_formatted'] = number_format($amount, 2);
    $row['date_formatted']   = date('M j, Y', strtotime($row['date']));
    $row['created_formatted'] = date('M j, Y g:i A', strtotime($row['date_created']));
    $row['type_label'] = $row['transaction_type'] == 'credit' ? 'Collection' : 'Disbursement';

    $data[] = $row;
}

echo json_encode([
    'success' => true,
    'data'    => $data,
    'total_records' => count($data),
    'total_amount'  => number_format($total_amount, 2),
    'generated_at'  => date('Y-m-d H:i:s')
], JSON_PRETTY_PRINT);
exit;
?>