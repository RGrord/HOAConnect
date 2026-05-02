<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/includes/functions/mailer.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/includes/functions/update-reset-token.php');
header('Content-Type: application/json');
$username = $_POST['username'] ?? '';

if (empty($username)) {
    echo json_encode(['success' => false, 'message' => 'Please enter your email.']);
    exit;
}

$sql = "SELECT user_id, email_address FROM users WHERE email_address = ? LIMIT 1";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($user = mysqli_fetch_assoc($result)) {
  $token = bin2hex(random_bytes(32));
  $expiry = date('Y-m-d H:i:s', strtotime('+15 minutes'));

  if (!updateResetToken($conn, $user['user_id'], $token)) {
      echo json_encode(['success' => false, 'message' => 'System error. Try again later.']);
      exit;
  }

  $resetLink = BASE_URL . "public/auth/reset-password.php?token=" . $token;

  $title = 'Password Reset Request';
  $message = "Dear User,<br><br>
      We received a request to reset your password.<br>
      <a href='$resetLink'>Click here to reset your password</a><br><br>
      This link will expire in 15 minutes.<br><br>
      If you didn't request this, ignore this email.<br><br>
      HOAConnect Team";

  if (sendEmail($message, $title, $user['email_address'])) {
      echo json_encode([
          'success' => true,
          'message' => 'Password reset link sent to your email. '
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