<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';

if (!isset($_SESSION['user_id'])) {
    json_error('Unauthorized', 401);
}
$user_id = $_SESSION['user_id'];

$sql = "SELECT u.user_id, 
    u.email_address, 
    u.status,
    i.first_name, 
    i.middle_name,
    i.last_name,
    i.suffix,
    i.phone_number,
    i.date_of_birth,
    i.citizenship,
    i.civil_status,
    CONCAT(i.first_name, ' ', i.middle_name, ' ', i.last_name) AS fullName,
    h.hoa_number,
    h.home_address,
    h.lot,
    h.block,
    h.phase,
    h.village,
    r.name AS role
  FROM users u
  LEFT JOIN user_info i ON u.user_id = i.user_id
  LEFT JOIN hoa_info h ON u.user_id = h.user_id
  LEFT JOIN roles r ON u.role_id = r.id
  WHERE u.user_id = ? LIMIT 1";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    json_success([
        'data' => [
          'user_id'     =>  $row['user_id'],
          'email'       =>  $row['email_address'],
          'fullName'    =>  $row['fullName'],
          'first_name'  =>  $row['first_name'],
          'middle_name' =>  $row['middle_name'],
          'last_name'   =>  $row['last_name'],
          'suffix'      =>  $row['suffix'],
          'phone'       =>  $row['phone_number'],
          'birthdate'   =>  $row['date_of_birth'],
          'citizenship' =>  $row['citizenship'],
          'civil_status'=>  $row['civil_status'],
          'hoa_no'      =>  $row['hoa_number'],
          'address'     =>  $row['home_address'],
          'lot'         =>  $row['lot'],
          'block'       =>  $row['block'],
          'phase'       =>  $row['phase'],
          'village'     =>  $row['village'],
          'role'        =>  $row['role'],
          'status'      =>  $row['status'],
        ]
    ]);
} else {
    json_error('User not found', 404);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
