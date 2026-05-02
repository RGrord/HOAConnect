<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/includes/functions/mailer.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/includes/functions/fees.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/includes/functions/password-generate.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

$required = ['first_name', 'last_name', 'phone', 'hoa_number', 'home_address', 'lot', 'block', 'email_address'];
foreach ($required as $field) {
    if (empty(trim($_POST[$field] ?? ''))) {
        echo json_encode(['success' => false, 'message' => ucfirst(str_replace('_', ' ', $field)) . ' is required']);
        exit;
    }
}

$first_name     = trim($_POST['first_name']);
$middle_name    = trim($_POST['middle_name'] ?? '');
$last_name      = trim($_POST['last_name']);
$suffix         = trim($_POST['suffix'] ?? '');
$phone          = trim($_POST['phone']);
$birthdate      = !empty($_POST['birthdate']) ? $_POST['birthdate'] : null;
$citizenship    = 'Filipino';
$civil_status   = 'Single';

$hoa_number     = trim($_POST['hoa_number']);
$home_address   = trim($_POST['home_address']);
$lot            = trim($_POST['lot']);
$block          = trim($_POST['block']);
$phase          = trim($_POST['phase'] ?? '');
$village        = trim($_POST['village'] ?? 'Your Village Name');

$email          = trim($_POST['email_address']);
$role_id        = (int)($_POST['role_id'] ?? 6);

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Invalid email address']);
    exit;
}

$errors = [];

$check = $conn->prepare("SELECT user_id FROM users WHERE email_address = ?");
$check->bind_param("s", $email);
$check->execute();
$check->store_result();
if ($check->num_rows > 0) {
    $errors[] = 'Email address already exists';
}
$check->close();

$check = $conn->prepare("SELECT user_id FROM hoa_info WHERE hoa_number = ?");
$check->bind_param("s", $hoa_number);
$check->execute();
$check->store_result();
if ($check->num_rows > 0) {
    $errors[] = 'HOA Number already exists';
}
$check->close();

$check = $conn->prepare("
    SELECT user_id FROM hoa_info 
    WHERE lot = ? AND block = ? AND phase = ?
");
$check->bind_param("sss", $lot, $block, $phase);
$check->execute();
$check->store_result();
if ($check->num_rows > 0) {
    $errors[] = 'Lot ' . $lot . ', Block ' . $block . (empty($phase) ? '' : ', Phase ' . $phase) . ' is already registered';
}
$check->close();

if (!empty($errors)) {
    echo json_encode([
        'success' => false,
        'message' => 'The following records already exist: ' . implode(', ', $errors)
    ]);
    exit;
}

$password = generatePassword(16);
$hashed   = password_hash($password, PASSWORD_DEFAULT);
$user_id  = "2025" . rand(1, 99) . substr(str_shuffle(str_repeat("0123456789", 5)), 0, 4);

try {
    $conn->autocommit(false);
    $conn->begin_transaction();

    $stmt1 = $conn->prepare("
        INSERT INTO users (user_id, email_address, password, status, role_id, is_first_time, date_created)
        VALUES (?, ?, ?, 1, ?, 1, NOW())
    ");
    $stmt1->bind_param("sssi", $user_id, $email, $hashed, $role_id);
    $stmt1->execute();
    $stmt1->close();

    $stmt2 = $conn->prepare("
        INSERT INTO user_info 
        (user_id, first_name, middle_name, last_name, suffix, phone_number, date_of_birth, citizenship, civil_status)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt2->bind_param("sssssssss", $user_id, $first_name, $middle_name, $last_name, $suffix, $phone, $birthdate, $citizenship, $civil_status);
    $stmt2->execute();
    $stmt2->close();

    $stmt3 = $conn->prepare("
        INSERT INTO hoa_info 
        (user_id, hoa_number, home_address, lot, block, phase, village)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt3->bind_param("sssssss", $user_id, $hoa_number, $home_address, $lot, $block, $phase, $village);
    $stmt3->execute();
    $stmt3->close();

    assignMonthlyFeesToUser($conn, $user_id);

    $title   = 'Account Created';
    $message = "Dear {$first_name} {$last_name},<br><br>
        Welcome aboard! Your account has been successfully created.<br><br>
        <strong>Username (Email):</strong> {$email}<br>
        <strong>Temporary Password:</strong> {$password}<br><br>
        Please change your password upon first login.<br><br>
        HOAConnect Team";

    if (!sendEmail($message, $title, $email)) {
        throw new Exception("Failed to send welcome email");
    }

    $conn->commit();

    echo json_encode([
        'success' => true,
        'message' => 'Homeowner created successfully!',
        'data'    => ['user_id' => $user_id]
    ]);

} catch (Exception $e) {
    $conn->rollback();
    echo json_encode([
        'success' => false,
        'message' => 'System error: ' . $e->getMessage()
    ]);
} finally {
    $conn->autocommit(true);
}
?>