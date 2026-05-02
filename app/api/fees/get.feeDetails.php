<?php
ob_clean();
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    json_error('Invalid or missing homeowner ID', 400);
}

$user_id = (int)$_GET['id'];

$sql = "
    SELECT 
        f.id,
        f.user_id,
        f.due_id,
        f.fee_type_id,
        f.fee_name,
        f.amount,
        f.status,
        f.next_due_date,
        f.date_created,
        
        CONCAT(
            TRIM(CONCAT(ui.first_name, ' ', COALESCE(ui.middle_name, ''), ' ', ui.last_name))
        ) AS full_name,
        u.email_address,
        m.due_name
    FROM fees f
    LEFT JOIN user_info ui ON f.user_id = ui.user_id
    LEFT JOIN users u ON f.user_id = u.user_id
    LEFT JOIN monthly_dues m ON f.due_id = m.id
    WHERE f.user_id = ?
    ORDER BY 
        FIELD(f.status, 2, 0, 3, 4, 1),  -- Overdue → Pending → Waived → Cancelled → Paid
        f.next_due_date DESC
";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'i', $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$fees = [];
while ($row = mysqli_fetch_assoc($result)) {
    $row['status_text'] = match ((int)$row['status']) {
        0 => 'Pending',
        1 => 'Paid',
        2 => 'Overdue',
        3 => 'Waived',
        4 => 'Cancelled',
        default => 'Unknown'
    };

    $row['next_due_date_formatted'] = $row['next_due_date'] ? date('Y-m-d', strtotime($row['next_due_date'])) : null;
    $row['next_due_date_display']   = $row['next_due_date'] ? date('M j, Y', strtotime($row['next_due_date'])) : '—';
    $row['date_created_display']    = $row['date_created'] ? date('M j, Y', strtotime($row['date_created'])) : '—';

    $row['amount_formatted'] = number_format((float)$row['amount'], 2);

    $fees[] = $row;
}

if (empty($fees)) {
    json_error('No fees found for this homeowner.', 404);
}

json_success([
    'homeowner' => [
        'user_id'     => $user_id,
        'full_name'   => $fees[0]['full_name'] ?? 'Unknown Homeowner',
        'email'       => $fees[0]['email_address'] ?? '—'
    ],
    'summary' => [
        'total_due'       => array_sum(array_column($fees, 'amount')),
        'total_fees'      => count($fees),
        'overdue_count'   => count(array_filter($fees, fn($f) => $f['status'] == 2)),
        'pending_count'   => count(array_filter($fees, fn($f) => $f['status'] == 0)),
        'paid_count'      => count(array_filter($fees, fn($f) => $f['status'] == 1)),
        'waived_count'    => count(array_filter($fees, fn($f) => $f['status'] == 3)),
        'cancelled_count' => count(array_filter($fees, fn($f) => $f['status'] == 4))
    ],
    'data' => $fees
]);