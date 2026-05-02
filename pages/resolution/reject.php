<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_GET['id'])){
    $action = "2";
    $id = $_GET['id'];


    $sql_approve = "UPDATE resolution SET status = '$action' WHERE id = '$id'";
    $run_approve = mysqli_query($conn,$sql_approve);

    if($run_approve) {
        echo "<script>alert('Rejected'); window.location.href='list.php';</script>";
    }else{
        echo "error approved";
    }
}