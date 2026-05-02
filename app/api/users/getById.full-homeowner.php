<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Content-Type: application/json');
    echo json_encode([
        'success' => false,
        'message' => 'Missing user ID',
        'data' => []
    ]);
    exit;
}

$id = (int)$_GET['id'];

$sql = "SELECT 
    u.id,
    u.user_id,
    u.role_id,
    u.email_address,
    CASE WHEN u.status = 1 THEN 'Active' ELSE 'Inactive' END AS status,
    
    i.id AS info_id,
    i.user_id AS info_user_id,
    i.first_name,
    i.middle_name,
    i.last_name,
    i.suffix,
    i.phone_number,
    i.date_of_birth,
    i.citizenship,
    i.civil_status,
    
    r.name AS role_name,
    CONCAT(i.first_name, ' ', i.middle_name, ' ', i.last_name, ' ', COALESCE(i.suffix, '')) AS fullName
FROM users u
LEFT JOIN user_info i ON u.user_id = i.user_id
LEFT JOIN roles r ON u.role_id = r.id
WHERE u.user_id = ?
LIMIT 1";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

header('Content-Type: application/json');
if ($user) {
    echo json_encode([
        'success' => true,
        'message' => 'Success',
        'data' => [$user]
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'User not found',
        'data' => []
    ]);
}
exit;
