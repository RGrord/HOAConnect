<?php

include('../connection/connection.php');
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_POST['create_fee_type'])){

    $fee_type_id = "2020".rand('1','10') . substr(str_shuffle(str_repeat("0123456789", 5)), 0, 3);
    $fee_name = $_POST['fee_name'];
    $description = $_POST['description'];
    $amount = $_POST['amount'];
    $cadence = $_POST['cadence'];
    $start_date = $_POST['start_date'];
    $user_id = '202540617'; //session user id
    $remarks =  NULL;
    $approved = 3; //pending
    $active = $_POST['active'];


    $sql_add_fee_type = "INSERT INTO fee_type (fee_type_id,user_id,fee_name, description, amount,cadence, start_date,is_active, remarks, approved, datetime_created, datetime_updated) VALUES ('$fee_type_id', '$user_id', '$fee_name', '$description', '$amount', '$cadence', '$start_date', '$active', '$remarks', '$approved', NOW(), NOW())";
    $run_sql_add_fee_type = mysqli_query($conn, $sql_add_fee_type);

    if(!$run_sql_add_fee_type){
        die("Query failed: " . mysqli_error($conn));
      }
    
    if($run_sql_add_fee_type){
      echo "<script>alert('Fee type added successfully!');</script>";
      echo"<script>window.location.href='../Users/admin/fee-types.php';</script> ";
    }else{
      echo "<script>alert('Error adding fee type: " . mysqli_error($conn) . "');</script>";
    }
    
    
    }


?>