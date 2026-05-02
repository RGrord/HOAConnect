<?php
ob_clean();

require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';

if (!isset($_GET['id']) || empty(trim($_GET['id']))) {
    json_error('User ID required', 400);
}

$user_id = trim($_GET['id']);

$sql = "SELECT 
    u.user_id, 
    u.email_address,
    u.status,
    COALESCE(i.first_name, '') as first_name,
    COALESCE(i.middle_name, '') as middle_name,
    COALESCE(i.last_name, '') as last_name,
    COALESCE(i.suffix, '') as suffix,
    COALESCE(i.phone_number, '') as phone_number,
    COALESCE(i.date_of_birth, '') as date_of_birth,
    COALESCE(i.citizenship, '') as citizenship,
    COALESCE(i.civil_status, '') as civil_status,
    CONCAT(
        TRIM(COALESCE(i.first_name, '')), ' ',
        IF(TRIM(COALESCE(i.middle_name, '')) = '', '', CONCAT(TRIM(i.middle_name), ' ')),
        TRIM(COALESCE(i.last_name, '')),
        IF(COALESCE(i.suffix, '') = '', '', CONCAT(' ', i.suffix))
    ) AS fullName,
    COALESCE(h.hoa_number, '') as hoa_number,
    COALESCE(h.home_address, '') as home_address,
    COALESCE(h.lot, '') as lot,
    COALESCE(h.block, '') as block,
    COALESCE(h.phase, '') as phase,
    COALESCE(h.village, '') as village,
    COALESCE(r.name, 'Resident') AS role
FROM users u
LEFT JOIN user_info i ON u.user_id = i.user_id
LEFT JOIN hoa_info h ON u.user_id = h.user_id
LEFT JOIN roles r ON u.role_id = r.id
WHERE u.user_id = ?
LIMIT 1";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    json_error('Database error', 500);
}

$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row) {
    $fullName = trim(preg_replace('/\s+/', ' ', $row['fullName']));
    if ($fullName === '') $fullName = 'No Name';

    json_success([
        'data' => [
            'user_id'       => $row['user_id'],
            'email'         => $row['email_address'],
            'fullName'      => $fullName,
            'first_name'    => $row['first_name'],
            'middle_name'   => $row['middle_name'],
            'last_name'     => $row['last_name'],
            'suffix'        => $row['suffix'],
            'phone'         => $row['phone_number'],
            'birthdate'     => $row['date_of_birth'],
            'citizenship'   => $row['citizenship'],
            'civil_status'  => $row['civil_status'],
            'hoa_number'    => $row['hoa_number'],
            'home_address'  => $row['home_address'],
            'lot_number'    => $row['lot'],
            'block_number'  => $row['block'],
            'phase_number'  => $row['phase'],
            'village_name'  => $row['village'],
            'role'          => $row['role'],
            'status'        => (int)$row['status']
        ]
    ]);
} else {
    json_error('User not found', 404);
}
?>