<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';

header('Content-Type: application/json');

if (!isset($_GET['id'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Payment ID is required'
    ]);
    exit;
}

$paymentId = (int) $_GET['id'];

try {
    // Fetch payment verification and associated fees in one query
    $sql = "
        SELECT 
            pv.id AS payment_id,
            pv.created_by,
            pv.payment_method,
            pv.reference_number,
            pv.is_walk_in,
            pv.attachment,
            pv.date_created AS payment_date,
            CONCAT(u.first_name, ' ', COALESCE(u.middle_name,''), ' ', u.last_name) AS full_name,
            f.id AS fee_id,
            f.fee_name,
            f.amount AS fee_amount,
            f.status AS status_code,
            CASE f.status
                WHEN 0 THEN 'Pending'
                WHEN 1 THEN 'Paid'
                WHEN 2 THEN 'Overdue'
                WHEN 3 THEN 'Waived'
                WHEN 4 THEN 'Cancelled'
                ELSE 'Unknown'
            END AS status_text,
            DATE_FORMAT(f.next_due_date, '%b %d, %Y') AS next_due_date_formatted,
            DATE_FORMAT(f.date_created, '%b %d, %Y') AS date_created_formatted,
            CONCAT('₱', FORMAT(f.amount, 2)) AS amount_formatted
        FROM payment_verification pv
        LEFT JOIN user_info u ON pv.created_by = u.user_id
        LEFT JOIN fees f ON f.user_id = pv.created_by
        WHERE pv.id = ?
        ORDER BY f.id DESC
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $paymentId);
    $stmt->execute();
    $result = $stmt->get_result();

    $payment = null;
    $fees = [];

    while ($row = $result->fetch_assoc()) {
        if (!$payment) {
            $payment = [
                'id' => $row['payment_id'],
                'created_by' => $row['created_by'],
                'payment_method' => $row['payment_method'],
                'reference_number' => $row['reference_number'],
                'is_walk_in' => (bool)$row['is_walk_in'],
                'attachment' => $row['attachment'],
                'date_created' => $row['payment_date'],
                'full_name' => $row['full_name'],
                'fees' => []
            ];
        }

        if ($row['fee_id']) {
            $fees[] = [
                'id' => $row['fee_id'],
                'fee_name' => $row['fee_name'],
                'amount' => $row['fee_amount'],
                'status_code' => $row['status_code'],
                'status_text' => $row['status_text'],
                'next_due_date_formatted' => $row['next_due_date_formatted'],
                'date_created_formatted' => $row['date_created_formatted'],
                'amount_formatted' => $row['amount_formatted']
            ];
        }
    }

    if (!$payment) {
        echo json_encode([
            'success' => false,
            'message' => 'Payment not found'
        ]);
        exit;
    }

    $payment['fees'] = $fees;

    echo json_encode([
        'success' => true,
        'data' => [$payment]
    ]);

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage()
    ]);
}
?>
