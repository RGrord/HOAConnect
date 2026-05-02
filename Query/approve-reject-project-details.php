<?php
include('../connection/connection.php');
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_POST['approve_project_resolution'])){
    $approve = "1";
    $id = $_POST['resolution_id'];


    $sql_approve = "UPDATE resolution SET status = '$approve' WHERE id = '$id'";
    $run_approve = mysqli_query($conn,$sql_approve);

    if($run_approve) {
        echo "<script>alert('Approved'); window.location.href='../Users/president/president-projectproposal.php';</script>";
    }else{
        echo "error approved";
    }
}

if(isset($_POST['reject_project_resolution'])){
    $id = $_POST['resolution_id'];
    $reject = "2";
    $sql_reject = "UPDATE resolution SET status =  '$reject' WHERE id = '$id'";
    $run_reject = mysqli_query($conn,$sql_reject);

    if($run_reject){
        echo "rejected";
    }else{
        echo "error reject";
    }
}
?>