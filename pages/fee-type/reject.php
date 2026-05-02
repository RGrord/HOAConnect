<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/';
require_once $root . 'config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';

if (isset($_GET['id'])) {
    $feeId = intval($_GET['id']);
  
    $sql = "UPDATE fee_type SET `status` = 3 WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $feeId);
    mysqli_stmt_execute($stmt);
    echo "<script>alert('Fee type rejected')</script>";
    echo "<script>window.location.href='list.php'</script>";
    exit;
}
?>
