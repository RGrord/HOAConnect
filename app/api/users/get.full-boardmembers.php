<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';

$sql = "SELECT 
    u.id,
    u.user_id,
    u.role_id,
    u.email_address,
    CASE WHEN u.status = 1 THEN 'Active' ELSE 'Inactive' END AS status,
    CONCAT(i.first_name, ' ', i.middle_name, ' ', i.last_name, ' ', COALESCE(i.suffix, '')) AS fullName,
    r.name AS role_name,
    i.first_name,
    i.middle_name,
    i.last_name,
    i.suffix,
    i.phone_number,
    i.date_of_birth,
    i.citizenship,
    i.civil_status
FROM users u
LEFT JOIN user_info i ON u.user_id = i.user_id
LEFT JOIN roles r ON u.role_id = r.id
WHERE u.role_id != 6
ORDER BY u.id DESC";

$result = mysqli_query($conn, $sql);

$users = [];
while($row = mysqli_fetch_assoc($result)) {
    $users[] = $row;
}

header('Content-Type: application/json');
echo json_encode([
    'success' => true,
    'message' => 'Success',
    'data' => $users
]);
exit;
