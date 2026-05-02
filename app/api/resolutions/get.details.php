<?php
ob_clean();
header('Content-Type: application/json');

if (!@include_once($_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php')) {
    echo json_encode(['success' => false, 'message' => 'Cannot connect to database']);
    exit;
}

$sql = "SELECT 
    r.id,
    r.project_resolution_title,
    r.resolution_summary,
    r.estimated_budget,
    r.target_start_date,
    r.target_end_date,
    r.proposed_by,
    r.project_proposal_document,
    r.upload_signed_resolution,
    r.status,
    r.has_financial_summary,
    r.is_budget_released,
    r.created_by,
    r.date_created,
    b.recipient AS budget_recipient,
    b.release_date,
    b.reference_number,
    
    l.status AS liquidation_status,
    l.total_expenses AS liquidated_amount

FROM resolution r
LEFT JOIN budget b ON r.id = b.project_id AND b.has_release = 1
LEFT JOIN liquidation_of_expenses l ON r.id = l.project_resolution_id
ORDER BY r.date_created DESC";

$result = mysqli_query($conn, $sql);

if (!$result) {
    echo json_encode(['success' => false, 'message' => 'Database query failed']);
    exit;
}

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $estimated = (float)($row['estimated_budget'] ?? 0);
    $released  = (float)($row['released_amount'] ?? 0);
    $liquidated = (float)($row['liquidated_amount'] ?? 0);

    $effective_budget = $released > 0 ? $released : $estimated;
    $balance = $effective_budget - $liquidated;

    $row['effective_budget']           = $effective_budget;
    $row['effective_budget_formatted'] = number_format($effective_budget, 2);
    $row['released_formatted']         = number_format($released, 2);
    $row['liquidated_formatted']       = number_format($liquidated, 2);
    $row['balance']                    = $balance;
    $row['balance_formatted']          = number_format($balance, 2);
    $row['is_budget_released']         = $released > 0;

    $row['status_label'] = match((int)($row['status'] ?? 0)) {
        0 => 'Draft',
        1 => 'For Approval',
        2 => 'Approved',
        3 => 'Rejected',
        default => 'Unknown'
    };

    $row['period'] = date('M j, Y', strtotime($row['target_start_date'])) . 
                     ' - ' . date('M j, Y', strtotime($row['target_end_date']));

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