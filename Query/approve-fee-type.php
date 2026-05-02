<?php

include('../connection/connection.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_POST['update_fee_type'])){

    $fee_type_id = $_POST['fee_type_id'];
    $active = $_POST['active'];

    $sql_approve_fee_type = "UPDATE fee_type SET is_active = '$active', datetime_updated=NOW() WHERE fee_type_id='$fee_type_id'";
    $run_sql_approve_fee_type = mysqli_query($conn, $sql_approve_fee_type);

    if(!$run_sql_approve_fee_type){
      die("Query failed: " . mysqli_error($conn));
    } 

    if($run_sql_approve_fee_type){
      echo "<script>alert('Fee type updated successfully!');</script>";
      echo"<script>window.location.href='../Users/admin/fee-types.php';</script> ";
    }else{
    echo "<script>alert('Error updating fee type: " . mysqli_error($conn) . "');</script>";
    }
}


?>