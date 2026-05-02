<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';

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

GROUP BY 
    l.id, l.project_resolution_id, l.status, l.total_expenses, l.date_created,
    r.project_resolution_title, r.estimated_budget, r.proposed_by,
    br.release_date, br.recipient, br.reference_number, br.acknowledgement_receipt

ORDER BY l.date_created DESC";

$result = mysqli_query($conn, $sql);

if (!$result) {
    header('Content-Type: application/json');
    echo json_encode([
        'success' => false,
        'message' => 'Query failed: ' . mysqli_error($conn)
    ]);
    exit;
}

$liquidations = [];
while ($row = mysqli_fetch_assoc($result)) {
    $liquidation_id = $row['id'];

    $details_sql = "SELECT 
        id,
        particular,
        amount,
        quantity,
        receipt,
        total_expenses,
        expense_date,
        audit_result,
        date_created
    FROM liquidation_expenses_details 
    WHERE liquidation_id = ?
    ORDER BY expense_date ASC";

    $stmt = $conn->prepare($details_sql);
    $stmt->bind_param("i", $liquidation_id);
    $stmt->execute();
    $details_result = $stmt->get_result();

    $details = [];
    while ($d = mysqli_fetch_assoc($details_result)) {
        $details[] = $d;
    }
    $stmt->close();

    $approved_budget   = (float)$row['approved_budget'];
    $actual_spent      = (float)$row['actual_total_spent'];
    $remaining_budget  = $approved_budget - $actual_spent;
    $over_budget       = $remaining_budget < 0 ? abs($remaining_budget) : 0;
    $variance          = (float)$row['reported_total'] - $actual_spent;

    $row['expenses_details']   = $details;
    $row['total_items']        = count($details);
    $row['actual_total_spent'] = number_format($actual_spent, 2, '.', '');
    $row['remaining_budget']   = $remaining_budget >= 0 ? number_format($remaining_budget, 2, '.', '') : '0.00';
    $row['over_budget_amount'] = number_format($over_budget, 2, '.', '');
    $row['is_over_budget']     = $over_budget > 0;
    $row['variance']           = number_format($variance, 2, '.', '');
    $row['variance_type']      = $variance > 0 ? 'Under' : ($variance < 0 ? 'Over' : 'Exact');

    if ($row['budget_release_date']) {
        $row['budget_release_date'] = date('M d, Y', strtotime($row['budget_release_date']));
    }

    $liquidations[] = $row;
}

header('Content-Type: application/json');
echo json_encode([
    'success' => true,
    'message' => 'Liquidations retrieved successfully',
    'data' => $liquidations
], JSON_PRETTY_PRINT);
exit;
?>  