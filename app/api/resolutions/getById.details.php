<?php
ob_clean();
header('Content-Type: application/json');

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid ID']);
    exit;
}

$id = (int)$_GET['id'];

if (!@include_once($_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php')) {
    echo json_encode(['success' => false, 'message' => 'System error']);
    exit;
}

$sql = "SELECT 
    r.*,
    b.recipient, 
    b.release_date, 
    b.reference_number,
    b.payment_method, 
    b.purpose AS budget_purpose, 
    b.approval_notes,
    l.id AS liq_id, 
    l.status AS liq_status, 
    l.total_expenses AS liquidated_amount,
    fs.has_validated AS fs_validated, 
    fs.file AS fs_file
FROM resolution r
LEFT JOIN budget b ON r.id = b.project_id AND b.has_release = 1
LEFT JOIN liquidation_of_expenses l ON r.id = l.project_resolution_id
LEFT JOIN financial_summary fs ON r.id = fs.project_id
WHERE r.id = ?";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'Database error']);
    exit;
}

$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'Resolution not found']);
    $stmt->close();
    exit;
}

$res = $result->fetch_assoc();
$stmt->close();

// === SMART BUDGET LOGIC: Released if available, otherwise Estimated ===
$estimated_budget = (float)($res['estimated_budget'] ?? 0);
$released_amount  = (float)($res['released_amount'] ?? 0);

$effective_budget = $released_amount > 0 ? $released_amount : $estimated_budget;

$liquidated = (float)($res['liquidated_amount'] ?? 0);
$balance    = $effective_budget - $liquidated;

$res['effective_budget']           = $effective_budget;
$res['effective_budget_formatted'] = number_format($effective_budget, 2);
$res['released_amount']            = $released_amount;
$res['released_formatted']         = number_format($released_amount, 2);
$res['liquidated_formatted']       = number_format($liquidated, 2);
$res['balance']                    = $balance;
$res['balance_formatted']          = number_format($balance, 2);
$res['is_budget_released']         = $released_amount > 0;
$res['budget_source']              = $released_amount > 0 ? 'Released' : 'Estimated';

// Liquidation details
$liq_details = [];
if ($res['liq_id']) {
    $det_result = $conn->query("SELECT particular, amount, quantity, total_expenses, expense_date 
                                FROM liquidation_expenses_details 
                                WHERE liquidation_id = " . (int)$res['liq_id'] . " 
                                ORDER BY expense_date ASC");
    while ($d = $det_result->fetch_assoc()) {
        $d['total_formatted'] = number_format($d['total_expenses'], 2);
        $liq_details[] = $d;
    }
}
$res['liquidation_details'] = $liq_details;

// Dates
$res['target_period'] = date('M j, Y', strtotime($res['target_start_date'])) . 
                        ' - ' . date('M j, Y', strtotime($res['target_end_date']));

$res['status_label'] = match((int)($res['status'] ?? 0)) {
    0 => 'Draft',
    1 => 'For Approval',
    2 => 'Approved',
    3 => 'Rejected',
    default => 'Unknown'
};

echo json_encode([
    'success' => true,
    'data'    => $res
], JSON_PRETTY_PRINT);

exit;
?>