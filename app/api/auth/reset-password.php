<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/includes/functions/mailer.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/includes/functions/update-reset-token.php');
header('Content-Type: application/json');

$token = $_POST['reset_token'] ?? '';

if (empty($token)) {
    echo json_encode(['success' => false, 'message' => 'Please enter your email.']);
    exit;
}

$sql = "SELECT user_id, email_address, reset_token FROM users WHERE reset_token = ? LIMIT 1";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $token);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($user = mysqli_fetch_assoc($result)) {
  $token = null;
  $expiry = null;

  if (!updateResetToken($conn, $user['user_id'], $token)) {
      echo json_encode(['success' => false, 'message' => 'System error. Try again later.']);
      exit;
  }

  $title = 'Password has been reset';
  $message = "Dear User,<br><br>
    This is a confirmation that your password in HOA Connect has been changed.
    <br><br>
    If you didn't request this, please immediately contact our support.<br><br>
    HOAConnect Team";

  if (sendEmail($message, $title, $user['email_address'])) {
    echo json_encode([
      'success' => true,
      'message' => 'Password has been reset. '
    ]);
  } else {
    echo json_encode(['success' => false, 'message' => $user['email_address']]);
  }
} else {
  echo json_encode([
    'success' => true,
    'message' => 'If your email is registered, you will receive a reset link.'
  ]);
}

mysqli_close($conn);
?>