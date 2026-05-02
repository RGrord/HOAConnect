<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';
include_once($_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/includes/functions/create-log.php');

header('Content-Type: application/json');

$ref_no = $_POST['ref_no'] ?? null;

if (!$ref_no) {
    echo json_encode(['success' => false, 'message' => 'Missing reference number.']);
    exit;
}

$conn->begin_transaction();

try {
    $hfSql = "SELECT id, user_id FROM homeowner_fees WHERE ref_no = ? LIMIT 1";
    $hfStmt = $conn->prepare($hfSql);
    $hfStmt->bind_param("s", $ref_no);
    $hfStmt->execute();
    $hf = $hfStmt->get_result()->fetch_assoc();
    $hfStmt->close();

    if (!$hf) {
        throw new Exception("Payment not found.");
    }

    $homeowner_id = $hf['id'];
    $user_id = $hf['user_id'];

    $feeSql = "
        SELECT fa.id
        FROM fee_assignments fa
        INNER JOIN homeowner_fees hf_rel ON hf_rel.user_id = fa.user_id
        WHERE hf_rel.id = ? AND fa.status = 4
    ";
    $feeStmt = $conn->prepare($feeSql);
    $feeStmt->bind_param("i", $homeowner_id);
    $feeStmt->execute();
    $feeResult = $feeStmt->get_result();

    $fee_ids = [];
    while ($f = $feeResult->fetch_assoc()) {
        $fee_ids[] = $f['id'];
    }
    $feeStmt->close();

    $updateHfSql = "UPDATE homeowner_fees SET status = 1 WHERE ref_no = ?";
    $updateHfStmt = $conn->prepare($updateHfSql);
    $updateHfStmt->bind_param("s", $ref_no);
    $updateHfStmt->execute();
    $updateHfStmt->close();

    $updatePvSql = "UPDATE payment_verification SET status = 1 WHERE ref_no = ?";
    $updatePvStmt = $conn->prepare($updatePvSql);
    $updatePvStmt->bind_param("s", $ref_no);
    $updatePvStmt->execute();
    $updatePvStmt->close();

    if (!empty($fee_ids)) {
        $placeholders = implode(',', array_fill(0, count($fee_ids), '?'));
        $types = str_repeat('i', count($fee_ids));
        $updateFeeSql = "UPDATE fee_assignments SET status = 1 WHERE id IN ($placeholders)";
        $updateFeeStmt = $conn->prepare($updateFeeSql);
        $updateFeeStmt->bind_param($types, ...$fee_ids);
        $updateFeeStmt->execute();
        $updateFeeStmt->close();
    }

    $conn->commit();

    echo json_encode(['success' => true, 'message' => 'Payment approved successfully.']);
    log_activity($conn, $_SESSION['user_id'], "Approve Payment", "Approved payment with ref_no: $ref_no for user_id: $user_id");
    
} catch (Exception $e) {
    $conn->rollback();
    echo json_encode(['success' => false, 'message' => 'Approval failed: ' . $e->getMessage()]);
}

$conn->close();
