<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';
include_once($_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/includes/functions/create-log.php');

$remittance_id = (int)($_POST['id'] ?? 0);
$status        = (int)($_POST['status'] ?? 0);

if (!$remittance_id || !in_array($status, [1,2])) {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
    exit;
}

$res = $conn->query("SELECT * FROM remittance WHERE id = $remittance_id");
$remittance = $res->fetch_assoc();

if (!$remittance) {
    echo json_encode(['success' => false, 'message' => 'Remittance not found']);
    exit;
}

$conn->begin_transaction();

try {
    $stmt = $conn->prepare("UPDATE remittance SET status = ?, date_updated = NOW() WHERE id = ?");
    $stmt->bind_param("ii", $status, $remittance_id);
    $stmt->execute();
    $stmt->close();

    if ($status === 1) {
        $today = date('Y-m-d');
        $tables = ['homeowner_fees','toda_fees','stall_renter_fees','court_fees'];
        foreach ($tables as $table) {
            $conn->query("UPDATE $table SET is_remitted = 1 WHERE status = 1 AND date_created >= DATE_FORMAT(CURDATE(), '%Y-%m-01 00:00:00')
AND date_created <= NOW()");
        }
        
    }

    $conn->commit();
    echo json_encode(['success' => true, 'message' => 'Remittance updated successfully', 'status' => $status]);
    log_activity($conn, $_SESSION['user_id'], "Update Remittance Status", "Updated remittance ID $remittance_id to status $status");

} catch (Exception $e) {
    $conn->rollback();
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
