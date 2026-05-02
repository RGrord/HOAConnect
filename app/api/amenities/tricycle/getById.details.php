<?php
ob_clean();
header('Content-Type: application/json');

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid or missing ID']);
    exit;
}

$id = (int)$_GET['id'];

if (!@include_once($_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php')) {
    echo json_encode(['success' => false, 'message' => 'System error']);
    exit;
}

$sql = "SELECT 
    t.*,
    CASE WHEN t.status = 1 THEN 'Active' ELSE 'Inactive' END AS status_label
FROM toda t 
WHERE t.id = ?";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'Database prepare error']);
    exit;
}

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

$paid_sql = "SELECT COALESCE(SUM(amount_paid), 0) AS total_paid FROM toda_fees WHERE toda_id = ?";
$paid_stmt = $conn->prepare($paid_sql);
$paid_stmt->bind_param("i", $id);
$paid_stmt->execute();
$paid_result = $paid_stmt->get_result();
$paid = $paid_result->fetch_assoc()['total_paid'] ?? 0;
$paid_stmt->close();

$fee_amount = (float)($toda['fee_amount'] ?? 0);
$balance = $fee_amount - (float)$paid;

$toda['total_paid'] = number_format($paid, 2, '.', '');
$toda['balance']    = $balance;
$toda['balance_formatted'] = number_format($balance, 2, '.', '');
$toda['is_fully_paid'] = $balance <= 0;
$toda['contract_period'] = date('F Y', strtotime($toda['start_date'])) . 
                           ' to ' . date('F Y', strtotime($toda['end_date']));

$payments = [];
$hist_result = $conn->query("SELECT amount_paid, status, due_date, date_created FROM toda_fees WHERE toda_id = $id ORDER BY date_created DESC");
if ($hist_result) {
    while ($p = $hist_result->fetch_assoc()) {
        $p['amount_formatted'] = number_format($p['amount_paid'], 2);
        $p['due_formatted'] = date('M j, Y', strtotime($p['due_date']));
        $payments[] = $p;
    }
}
$toda['payment_history'] = $payments;

echo json_encode([
    'success' => true,
    'data' => $toda
], JSON_PRETTY_PRINT);

exit;
?>