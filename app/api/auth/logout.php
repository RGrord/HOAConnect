<?php
session_start();

include_once($_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/includes/functions/create-log.php');

$user_id = $_SESSION['user_id'] ?? null;

if (!empty($user_id)) {
    log_activity($conn, $user_id, "logout", "User logged out.");
}

session_destroy();
unset($_SESSION['user_id']);

header("Location: /hoa_system/index.php");
exit();
?>
