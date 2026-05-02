<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

$user_id = (int)($_GET['user_id'] ?? 0);
if ($user_id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Missing user ID']);
    exit;
}

$sqlAssigned = "SELECT fee_type_id FROM fee_assignments WHERE user_id = ?";
$stmtAssigned = $conn->prepare($sqlAssigned);
$stmtAssigned->bind_param("i", $user_id);
$stmtAssigned->execute();
$resultAssigned = $stmtAssigned->get_result();

$assignedIds = [];
while ($row = $resultAssigned->fetch_assoc()) {
    $assignedIds[] = $row['fee_type_id'];
}
$stmtAssigned->close();

if (count($assignedIds) > 0) {
    $placeholders = implode(',', array_fill(0, count($assignedIds), '?'));
    $types = str_repeat('i', count($assignedIds));

    $sqlUnassigned = "SELECT id, fee_name, amount, description
                      FROM fee_type
                      WHERE id NOT IN ($placeholders) AND status = 1 
                      ORDER BY fee_name DESC";

    $stmt = $conn->prepare($sqlUnassigned);
    $refs = [];
    foreach ($assignedIds as $k => $id) $refs[$k] = &$assignedIds[$k];
    call_user_func_array([$stmt, 'bind_param'], array_merge([$types], $refs));
} else {
    $sqlUnassigned = "SELECT id, fee_name, amount, description
                      FROM fee_type 
                      WHERE status = 1
                      ORDER BY fee_name DESC";
    $stmt = $conn->prepare($sqlUnassigned);
}

$stmt->execute();
$result = $stmt->get_result();

$fees = [];
while ($row = $result->fetch_assoc()) {
    $fees[] = $row;
}

echo json_encode([
    'success' => true,
    'data' => $fees,
    'assigned_debug' => $assignedIds
]);

$stmt->close();
$conn->close();

