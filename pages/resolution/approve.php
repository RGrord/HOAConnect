<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php');

session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_GET['id'])){
    $action = "1";
    $id = $_GET['id'];


    $sql_approve = "UPDATE resolution SET status = '$action' WHERE id = '$id'";
    $run_approve = mysqli_query($conn,$sql_approve);

    if($run_approve) {
        echo "<script>alert('Approved'); window.location.href='list.php';</script>";
    }else{
        echo "error approved";
    }
}