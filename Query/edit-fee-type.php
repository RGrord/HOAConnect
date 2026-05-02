<?php
include('../connection/connection.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if(isset($_POST['fee_type_id'])){

    $fee_type_id = $_POST['fee_type_id'];
    $fee_name = $_POST['fee_name'];
    $description = $_POST['description'];
    $amount = $_POST['amount'];
    $cadence = $_POST['cadence'];
    $start_date = $_POST['start_date'];
    $active = $_POST['active'];

    $sql_update_fee_type = "UPDATE fee_type SET fee_name='$fee_name', description='$description', amount='$amount', cadence='$cadence', start_date='$start_date', is_active='$active', datetime_updated=NOW() WHERE fee_type_id='$fee_type_id'";
    $run_sql_update_fee_type = mysqli_query($conn, $sql_update_fee_type);

      if(!$run_sql_update_fee_type){
        die("Query failed: " . mysqli_error($conn));
      } 

    if($run_sql_update_fee_type){
      echo "<script>alert('Fee type updated successfully!');</script>";
      echo"<script>window.location.href='../Users/admin/fee-types.php';</script> ";
    }else{
      echo "<script>alert('Error updating fee type: " . mysqli_error($conn) . "');</script>";
    }
}
    



?>