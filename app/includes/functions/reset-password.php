<?php 
function resetPassword($conn, $userId, $password, $token) {
  $hashed = password_hash($password, PASSWORD_DEFAULT);
  $sql = "UPDATE users SET `password` = ? reset_token = ?, reset_token_expire = NULL WHERE user_id = ?";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "ssi", $hashed, $token, $userId);
  return mysqli_stmt_execute($stmt);
}
?>