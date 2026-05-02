<?php

include('../connection/connection.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_POST['approve_fee_type'])){

    $fee_type_id = $_POST['fee_type_id'];

    $sql_approve_fee_type = "UPDATE fee_type SET approved=1, datetime_updated=NOW() WHERE fee_type_id='$fee_type_id'";
    $run_sql_approve_fee_type = mysqli_query($conn, $sql_approve_fee_type);

    if(!$run_sql_approve_fee_type){
      die("Query failed: " . mysqli_error($conn));
    } 

    if($run_sql_approve_fee_type){
      echo "<script>alert('Fee type approved successfully!');</script>";
      echo"<script>window.location.href='../Users/president/president-feetype.php';</script> ";
    }else{
    echo "<script>alert('Error approving fee type: " . mysqli_error($conn) . "');</script>";
    }
}

  
if(isset($_POST['reject_fee_type'])){

      $fee_type_id = $_POST['fee_type_id'];
      $notes = $_POST['notes'];

      $sql_reject_fee_type = "UPDATE fee_type SET approved=2, remarks='$notes', datetime_updated=NOW() WHERE fee_type_id='$fee_type_id'";
      $run_sql_reject_fee_type = mysqli_query($conn, $sql_reject_fee_type);

        if(!$run_sql_reject_fee_type){
          die("Query failed: " . mysqli_error($conn));
        } 

      if($run_sql_reject_fee_type){
          echo "<script>alert('Fee type rejected successfully!');</script>";
          echo"<script>window.location.href='../Users/president/president-feetype.php';</script> ";
      }else{
        echo "<script>alert('Error rejecting fee type: " . mysqli_error($conn) . "');</script>";
      }
}

?>