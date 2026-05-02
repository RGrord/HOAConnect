<?php
include('../connection/connection.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if(isset($_POST['update_account'])){

  $user_id = $_POST['user_id'];
  $first_name = $_POST['first_name'];
  $middle_name = $_POST['middle_name'];   
  $last_name = $_POST['last_name'];
  $name_suffix = $_POST['name_suffix'];
  $role = $_POST['role'];
  $email = $_POST['email'];
  $age = $_POST['age'];
  $phone_number = '+639' . $_POST['phone_number'];
  $date_of_birth = $_POST['date_of_birth'];
  $citizenship = $_POST['citizenship'];
  $civil_status = $_POST['civil_status'];
  $home_address = $_POST['home_address'];
  $lot_number = $_POST['lot_number'];
  $block_number = $_POST['block_number'];
  $phase_number = $_POST['phase_number'];
  $village_name = $_POST['village_name'];
  $hoa_number = $_POST['hoa_number'];
  $account_status = $_POST['account_status'];
  

  if($role == 'Secretary'){
    $new_role = '2';
  }elseif($role == 'Admin'){
    $new_role = '3'; 
  }elseif($role == 'Treasurer'){
    $new_role = '4';
  }elseif($role == 'Audit'){
    $new_role = '5';
  }else{
    $new_role = '6';
  }

  $sql_update_account = "UPDATE users SET role_id='$new_role', first_name='$first_name', middle_name='$middle_name', last_name='$last_name', suffix='$name_suffix', email_address='$email',hoa_number='$hoa_number', phone_number='$phone_number', age='$age', date_of_birth='$date_of_birth', citizenship='$citizenship', civil_status='$civil_status', account_status='$account_status' , home_address='$home_address', lot_number='$lot_number', block_number='$block_number', phase_number='$phase_number', village_name='$village_name', date_updated=NOW() WHERE user_id='$user_id'";
  $run_sql_update_account = mysqli_query($conn, $sql_update_account);

    if(!$sql_update_account){
      die("Query failed: " . mysqli_error($conn));
    }

  if($sql_update_account){
    echo "<script>alert('Account updated successfully!');</script>";
    echo"<script>window.location.href='../Users/president/president-accounts.php';</script> ";
  }else{
    echo "<script>alert('Error updating account: " . mysqli_error($conn) . "');</script>";
  }


}

if(isset($_POST['update_account_admin'])){

  $user_id = $_POST['user_id'];
  $first_name = $_POST['first_name'];
  $middle_name = $_POST['middle_name'];   
  $last_name = $_POST['last_name'];
  $name_suffix = $_POST['name_suffix'];
  $role = '6';
  $email = $_POST['email'];
  $age = $_POST['age'];
  $phone_number = '+639' . $_POST['phone_number'];
  $date_of_birth = $_POST['date_of_birth'];
  $citizenship = $_POST['citizenship'];
  $civil_status = $_POST['civil_status'];
  $home_address = $_POST['home_address'];
  $lot_number = $_POST['lot_number'];
  $block_number = $_POST['block_number'];
  $phase_number = $_POST['phase_number'];
  $village_name = $_POST['village_name'];
  $hoa_number = $_POST['hoa_number'];
  $account_status = $_POST['account_status'];
  

  if($role == 'Secretary'){
    $new_role = '2';
  }elseif($role == 'Admin'){
    $new_role = '3'; 
  }elseif($role == 'Treasurer'){
    $new_role = '4';
  }elseif($role == 'Audit'){
    $new_role = '5';
  }else{
    $new_role = '6';
  }

  $sql_update_account = "UPDATE users SET role_id='$new_role', first_name='$first_name', middle_name='$middle_name', last_name='$last_name', suffix='$name_suffix', email_address='$email',hoa_number='$hoa_number', phone_number='$phone_number', age='$age', date_of_birth='$date_of_birth', citizenship='$citizenship', civil_status='$civil_status', account_status='$account_status' , home_address='$home_address', lot_number='$lot_number', block_number='$block_number', phase_number='$phase_number', village_name='$village_name', date_updated=NOW() WHERE user_id='$user_id'";
  $run_sql_update_account = mysqli_query($conn, $sql_update_account);

    if(!$sql_update_account){
      die("Query failed: " . mysqli_error($conn));
    }

  if($sql_update_account){
    echo "<script>alert('Account updated successfully!');</script>";
    echo"<script>window.location.href='../Users/admin/admin-accounts.php';</script> ";
  }else{
    echo "<script>alert('Error updating account: " . mysqli_error($conn) . "');</script>";
  }


}

?>