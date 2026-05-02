<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/hoa_system/app/core/init.php';
if ($_POST['id']) {
    $id = (int)$_POST['id'];
    mysqli_query($conn, "UPDATE payment_verification SET is_approve = 2 WHERE id = $id");
    json_success(['message' => 'Rejected']);
}