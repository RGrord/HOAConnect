<?php
ob_clean();
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';
header('Content-Type: application/json');

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo json_encode(['success' => false, 'message' => 'User ID required']);
    exit;
}

$user_id = (int)$_GET['id'];

$sql = "SELECT 
    u.user_id,
    u.email_address,
    CONCAT(ui.first_name, ' ', COALESCE(ui.middle_name,''), ' ', ui.last_name, ' ', COALESCE(ui.suffix,'')) AS full_name,
    ui.first_name,
    ui.middle_name,
    ui.last_name,
    ui.suffix,
    ui.phone_number,
    hi.hoa_number,
    hi.home_address,
    hi.lot,
    hi.block,
    hi.phase
FROM users u
LEFT JOIN user_info ui ON u.user_id = ui.user_id
LEFT JOIN hoa_info hi ON u.user_id = hi.user_id
WHERE u.user_id = ? AND u.role_id = 6
LIMIT 1";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'Database error']);
    exit;
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'Homeowner not found']);
    $stmt->close();
    exit;
}

$user = $result->fetch_assoc();
$stmt->close();

echo json_encode([
    'success' => true,
    'data' => $user
], JSON_PRETTY_PRINT);

exit;
?>