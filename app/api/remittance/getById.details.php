<?php
ob_clean();
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';
header('Content-Type: application/json');

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo json_encode(['success' => false, 'message' => 'ID required']);
    exit;
}
$id = (int)$_GET['id'];

$sql = "SELECT 
    r.*,
    CASE WHEN r.status = 1 THEN 'Posted' ELSE 'Pending' END AS status_label,
    CONCAT(ui.first_name, ' ', ui.last_name) AS full_name
FROM remittance r
LEFT JOIN users u ON r.user_id = u.user_id
LEFT JOIN user_info ui ON u.user_id = ui.user_id
WHERE r.id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'Remittance not found']);
    $stmt->close();
    exit;
}

$remit = $result->fetch_assoc();
$stmt->close();

$remit['amount_formatted'] = number_format($remit['amount'], 2);
$remit['date_formatted']   = date('F j, Y', strtotime($remit['date']));
$remit['type_label']       = $remit['transaction_type'] == 'credit' ? 'COLLECTION' : 'DISBURSEMENT';

echo json_encode(['success' => true, 'data' => $remit], JSON_PRETTY_PRINT);
exit;
?>