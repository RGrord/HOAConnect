<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';
header('Content-Type: application/json');

$refNo = $_GET['ref_no'] ?? null;

if (!$refNo) {
    echo json_encode(['success' => false, 'message' => 'Missing reference number.']);
    exit;
}

$sql = "
    SELECT 
        hf.id,
        hf.user_id,
        CONCAT(ui.first_name, ' ', ui.middle_name, ' ', ui.last_name) AS payer_name,
        hf.amount_paid,
        hf.payment_method,
        hf.ref_no,
        hf.remarks,
        hf.attachment,
        hf.status,
        hf.date_created,
        CASE 
            WHEN hf.attachment IS NOT NULL AND hf.attachment != '' 
            THEN CONCAT('/', hf.attachment)
            ELSE NULL
        END AS proof_url
    FROM homeowner_fees hf
    LEFT JOIN user_info ui ON ui.user_id = hf.user_id
    WHERE hf.ref_no = ?
    LIMIT 1
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $refNo);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'Payment record not found.']);
    exit;
}

$data = $result->fetch_assoc();

$feeSql = "
    SELECT fa.id, fa.amount, ft.fee_name AS fee_name
    FROM fee_assignments fa
    LEFT JOIN fee_type ft ON fa.fee_type_id = ft.id
    WHERE fa.user_id = ? AND fa.status = 4
";
$stmt2 = $conn->prepare($feeSql);
$stmt2->bind_param("i", $data['user_id']);
$stmt2->execute();
$feesResult = $stmt2->get_result();

$fees = [];
while ($f = $feesResult->fetch_assoc()) {
    $fees[] = [
        'id' => $f['id'],
        'fee_name' => $f['fee_name'],
        'amount' => (float)$f['amount']
    ];
}

$data['fees'] = $fees;

echo json_encode([
    'success' => true,
    'data' => $data
]);
exit;
?>
