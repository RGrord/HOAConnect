<?php
ob_clean();
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';
header('Content-Type: application/json');

$sql = "SELECT 
    id,
    fee_name,
    description,
    amount,
    effectivity_date,
    status,
    is_recurring,
    created_by,
    date_created
FROM fee_type
ORDER BY effectivity_date DESC, fee_name ASC";

$result = mysqli_query($conn, $sql);
if (!$result) {
    echo json_encode(['success' => false, 'message' => 'Query failed']);
    exit;
}

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $row['amount_formatted'] = number_format($row['amount'], 2);
    $row['effectivity_formatted'] = date('M j, Y', strtotime($row['effectivity_date']));
    $row['status_label'] = $row['status'] == 1 ? 'Active' : 'Inactive';
    $row['recurring_label'] = $row['is_recurring'] == 1 ? 'Yes' : 'No';
    $row['created_formatted'] = date('M j, Y g:i A', strtotime($row['date_created']));

    $data[] = $row;
}

echo json_encode([
    'success' => true,
    'data'    => $data,
    'total'   => count($data)
], JSON_PRETTY_PRINT);
exit;
?>