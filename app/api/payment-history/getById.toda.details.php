<?php
ob_clean();
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';
header('Content-Type: application/json');

if (!isset($_GET['id'])) {
    echo json_encode(['success' => false, 'message' => 'ID required']);
    exit;
}
$id = (int)$_GET['id'];

$sql = "SELECT 
    t.*,
    COALESCE(SUM(tf.amount_paid), 0) AS total_paid
FROM toda t
LEFT JOIN toda_fees tf ON t.id = tf.toda_id AND tf.status = 1
WHERE t.id = ?
GROUP BY t.id";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'TODA not found']);
    $stmt->close();
    exit;
}

$toda = $result->fetch_assoc();
$stmt->close();

$balance = (float)$toda['fee_amount'] - (float)$toda['total_paid'];

$toda['balance'] = $balance;
$toda['balance_formatted'] = number_format($balance, 2);
$toda['total_paid_formatted'] = number_format($toda['total_paid'], 2);
$toda['fee_formatted'] = number_format($toda['fee_amount'], 2);
$toda['is_fully_paid'] = $balance <= 0;

$payments = [];
$pay_result = $conn->query("SELECT amount_paid, due_date, date_created FROM toda_fees WHERE toda_id = $id AND status = 1 ORDER BY date_created DESC");
while ($p = $pay_result->fetch_assoc()) {
    $p['amount_formatted'] = number_format($p['amount_paid'], 2);
    $p['due_formatted'] = date('M j, Y', strtotime($p['due_date']));
    $payments[] = $p;
}
$toda['payment_history'] = $payments;

echo json_encode(['success' => true, 'data' => $toda], JSON_PRETTY_PRINT);
exit;
?>