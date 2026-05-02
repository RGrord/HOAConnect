<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';

header('Content-Type: application/json');

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo json_encode(['success' => false, 'message' => 'Liquidation ID is required']);
    exit;
}

$liquidation_id = (int)$_GET['id'];

$sql = "SELECT 
    l.id,
    l.project_resolution_id,
    l.status,
    CASE 
        WHEN l.status = 0 THEN 'Pending'
        WHEN l.status = 1 THEN 'Approved'
        WHEN l.status = 2 THEN 'Rejected'
        ELSE 'Unknown'
    END AS status_label,
    l.total_expenses AS reported_total,
    l.date_created AS liquidation_date,

    COALESCE(r.project_resolution_title, 'Untitled Project') AS project_title,
    COALESCE(r.estimated_budget, 0) AS approved_budget,
    COALESCE(r.proposed_by, 'Unknown') AS proposed_by,

    br.release_date AS budget_release_date,
    br.recipient AS budget_recipient,
    br.reference_number AS budget_ref_no,
    br.acknowledgement_receipt AS ack_receipt,

    COALESCE(SUM(d.total_expenses), 0) AS actual_total_spent

FROM liquidation_of_expenses l
LEFT JOIN liquidation_expenses_details d ON l.id = d.liquidation_id
LEFT JOIN resolution r ON l.project_resolution_id = r.id

LEFT JOIN (
    SELECT b1.*
    FROM budget b1
    WHERE b1.has_release = 1
      AND b1.id = (
        SELECT MAX(b2.id)
        FROM budget b2 
        WHERE b2.project_id = b1.project_id AND b2.has_release = 1
      )
) br ON r.id = br.project_id

WHERE l.id = ?

GROUP BY 
    l.id, l.project_resolution_id, l.status, l.total_expenses, l.date_created,
    r.project_resolution_title, r.estimated_budget, r.proposed_by,
    br.release_date, br.recipient, br.reference_number, br.acknowledgement_receipt";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $liquidation_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'Liquidation not found']);
    $stmt->close();
    exit;
}

$row = $result->fetch_assoc();
$stmt->close();

$details_sql = "SELECT 
    id, particular, amount, quantity, receipt, total_expenses,
    expense_date, audit_result, date_created
FROM liquidation_expenses_details 
WHERE liquidation_id = ?
ORDER BY expense_date ASC";

$stmt2 = $conn->prepare($details_sql);
$stmt2->bind_param("i", $liquidation_id);
$stmt2->execute();
$details_result = $stmt2->get_result();

$details = [];
while ($d = $details_result->fetch_assoc()) {
    $details[] = $d;
}
$stmt2->close();

$approved_budget   = (float)$row['approved_budget'];
$actual_spent      = (float)$row['actual_total_spent'];
$remaining_budget  = $approved_budget - $actual_spent;
$over_budget       = $remaining_budget < 0 ? abs($remaining_budget) : 0;
$variance          = (float)$row['reported_total'] - $actual_spent;

$row['expenses_details']     = $details;
$row['total_items']          = count($details);
$row['actual_total_spent']   = number_format($actual_spent, 2, '.', '');
$row['remaining_budget']     = $remaining_budget >= 0 ? number_format($remaining_budget, 2, '.', '') : '0.00';
$row['over_budget_amount']   = number_format($over_budget, 2, '.', '');
$row['is_over_budget']       = $over_budget > 0;
$row['variance']             = number_format($variance, 2, '.', '');
$row['variance_type']        = $variance > 0 ? 'Under' : ($variance < 0 ? 'Over' : 'Exact');

if ($row['budget_release_date']) {
    $row['budget_release_date'] = date('M d, Y', strtotime($row['budget_release_date']));
}

echo json_encode([
    'success' => true,
    'message' => 'Liquidation retrieved successfully',
    'data' => $row
], JSON_PRETTY_PRINT);
exit;
?>