<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';
header('Content-Type: application/json');

if (!isset($_POST['user_id'], $_POST['fee_ids']) || !is_array($_POST['fee_ids'])) {
    echo json_encode(['success' => false, 'message' => 'Missing required fields']);
    exit;
}

$user_id = (int)$_POST['user_id'];
$fee_ids = $_POST['fee_ids'];
$remarks = trim($_POST['remarks'] ?? '');
$date_created = date('Y-m-d H:i:s');
$due_date = date('Y-m-01', strtotime('+1 month'));

$conn->begin_transaction();

try {
    $stmt = $conn->prepare("
        INSERT INTO fee_assignments 
        (user_id, fee_type_id, amount, due_date, status, date_created)
        VALUES (?, ?, ?, ?, 0, ?)
    ");

    foreach ($fee_ids as $fee_id) {
        $fee_id = (int)$fee_id;

        $sqlFee = "SELECT amount FROM fee_type WHERE id = ?";
        $stmtFee = $conn->prepare($sqlFee);
        $stmtFee->bind_param("i", $fee_id);
        $stmtFee->execute();
        $amount = (float)$stmtFee->get_result()->fetch_assoc()['amount'];
        $stmtFee->close();

        $stmt->bind_param("iidss", $user_id, $fee_id, $amount, $due_date, $date_created);
        $stmt->execute();
    }

    $stmt->close();
    $conn->commit();

    echo json_encode([
        'success' => true,
        'message' => 'Fees assigned successfully'
    ]);

} catch (Exception $e) {
    $conn->rollback();
    echo json_encode([
        'success' => false,
        'message' => 'Failed to assign fees: ' . $e->getMessage()
    ]);
}

$conn->close();
?>
