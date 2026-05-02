<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

$response = ['success' => false, 'message' => 'Something went wrong'];
$in_transaction = false;

try {
    if (!isset($_POST['project_id'])) {
        throw new Exception("Missing project ID");
    }

    $project_id   = intval($_POST['project_id']);
    $remarks      = trim($_POST['remarks'] ?? '');
    $particulars  = $_POST['expense_particular'] ?? [];
    $amounts      = $_POST['expense_amount'] ?? [];
    $quantities   = $_POST['quantity'] ?? [];
    $dates        = $_POST['date'] ?? [];

    if (empty($particulars)) {
        throw new Exception("Please add at least one expense");
    }

    $total_expenses = 0;
    foreach ($amounts as $amt) {
        $total_expenses += floatval($amt);
    }

    // Fetch project budget
    $stmt = $conn->prepare("SELECT estimated_budget FROM resolution WHERE id = ? AND is_budget_released = 1");
    $stmt->bind_param("i", $project_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        throw new Exception("Project not found or budget not released");
    }
    $project = $result->fetch_assoc();
    $released_budget = $project['estimated_budget'];
    $remaining_budget = $released_budget - $total_expenses;

    if ($total_expenses > $released_budget) {
        $audit_result = 'Overspent';
    } elseif ($total_expenses < $released_budget) {
        $audit_result = 'Underspent';
    } else {
        $audit_result = 'Balanced';
    }

    $conn->autocommit(FALSE);
    $in_transaction = true;

    // Insert liquidation record
    $stmt = $conn->prepare("
        INSERT INTO liquidation_of_expenses 
        (project_resolution_id, status, total_expenses, date_created) 
        VALUES (?, 0, ?, NOW())
    ");
    $stmt->bind_param("id", $project_id, $total_expenses);
    if (!$stmt->execute()) {
        throw new Exception("Failed to create liquidation record");
    }
    $liquidation_id = $conn->insert_id;

    // Insert expense details
    $stmt_detail = $conn->prepare("
        INSERT INTO liquidation_expenses_details 
        (liquidation_id, particular, amount, quantity, expense_date, total_expenses, remaning_budget, audit_result, remarks, date_created)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())
    ");

    for ($i = 0; $i < count($particulars); $i++) {
        $particular = trim($particulars[$i]);
        $amount     = floatval($amounts[$i]);
        $quantity   = intval($quantities[$i] ?? 1);
        $date       = $dates[$i] ?? date('Y-m-d');

        $stmt_detail->bind_param(
            "isdissdss",
            $liquidation_id,
            $particular,
            $amount,
            $quantity,
            $date,
            $total_expenses,
            $remaining_budget,
            $audit_result,
            $remarks
        );

        if (!$stmt_detail->execute()) {
            throw new Exception("Failed to save expense item");
        }
    }

    $conn->commit();
    $in_transaction = false;
    $conn->autocommit(TRUE);

    $response = [
        'success' => true,
        'message' => 'Liquidation submitted successfully! Waiting for approval.'
    ];

} catch (Exception $e) {
    if ($in_transaction) {
        $conn->rollback();
        $conn->autocommit(TRUE);
    }
    $response['message'] = $e->getMessage();
} catch (Throwable $e) {
    if ($in_transaction) {
        $conn->rollback();
        $conn->autocommit(TRUE);
    }
    $response['message'] = 'System error.';
}

echo json_encode($response);
exit;
?>
