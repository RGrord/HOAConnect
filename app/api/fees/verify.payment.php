<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
    exit;
}

$id = (int)($_GET['id'] ?? 0);
$action = $_GET['action'] ?? '';

if (!$id || !in_array($action, ['approve','reject'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid parameters']);
    exit;
}

mysqli_begin_transaction($conn);

try {
    $stmt = $conn->prepare("SELECT * FROM payment_verification WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $pv = $stmt->get_result()->fetch_assoc();
    if (!$pv) throw new Exception('Payment record not found');

    if ($action === 'approve') {
        $stmt = $conn->prepare("UPDATE payment_verification SET status = 1, date_updated = NOW() WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $stmt = $conn->prepare("UPDATE fee_assignments SET status = 1 WHERE user_id = ? AND status = 0");
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $stmt = $conn->prepare("UPDATE homeowner_fees SET status = 1 WHERE user_id = ? AND status = 0");
        $stmt->bind_param('i', $id);
        $stmt->execute();

    } else {
        $stmt = $conn->prepare("UPDATE payment_verification SET status = 2, date_updated = NOW() WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();

          $stmt = $conn->prepare("UPDATE fee_assignments SET status = 0 WHERE user_id = ? AND status = 0");
        $stmt->bind_param('i', $pv['user_id']);
        $stmt->execute();

    }

    mysqli_commit($conn);

    echo json_encode(['success' => true, 'message' => ucfirst($action) . 'd successfully']);
} catch (Exception $e) {
    mysqli_rollback($conn);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
