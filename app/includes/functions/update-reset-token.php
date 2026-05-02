<?php 
function updateResetToken($conn, $userId, $token) {
  $date = date('Y-m-d H:i:s a', strtotime('+15 minutes') );
  $sql = "UPDATE users SET reset_token = ?, reset_token_expire = ? WHERE user_id = ?";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "ssi", $token, $date, $userId);
  return mysqli_stmt_execute($stmt);
}
?>