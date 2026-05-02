<?php
include('../connection/connection.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//president create account

if(isset($_POST['create_account'])){

  $user_id = "2025".rand('1','10') . substr(str_shuffle(str_repeat("0123456789", 5)), 0, 3);
  $first_name = $_POST['first_name'];
  $middle_name = $_POST['middle_name'];   
  $last_name = $_POST['last_name'];
  $name_suffix = $_POST['name_suffix'];
  $role = $_POST['role'];
  $email = $_POST['email'];
  $age = $_POST['age'];
  $phone = '+639' . $_POST['phone'];
  $date_of_birth = $_POST['date_of_birth'];
  $citizenship = $_POST['citizenship'];
  $civil_status = $_POST['civil_status'];
  $home_address = $_POST['home_address'];
  $lot_number = $_POST['lot_number'];
  $block_number = $_POST['block_number'];
  $phase_number = $_POST['phase_number'];
  $village_name = $_POST['village_name'];
  $hoa_number = NULL;
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

  $sql_create_account = "INSERT INTO users (role_id,user_id,first_name, middle_name, last_name, suffix, email_address,hoa_number, phone_number, age , date_of_birth, citizenship, civil_status,account_status, home_address, lot_number, block_number, phase_number, village_name, date_created,date_updated) VALUES ('$new_role', '$user_id', '$first_name', '$middle_name', '$last_name', '$name_suffix', '$email', '$hoa_number','$phone', '$age','$date_of_birth', '$citizenship', '$civil_status', '$account_status', '$home_address', '$lot_number', '$block_number', '$phase_number', '$village_name', NOW(), NOW())";
  $run_sql_create_account = mysqli_query($conn, $sql_create_account);

    if(!$run_sql_create_account){
      die("Query failed: " . mysqli_error($conn));
    }

  if($run_sql_create_account){
    echo "<script>alert('Account created successfully!');</script>";
    echo"<script>window.location.href='../Users/president/president-accounts.php';</script> ";
  }else{
    echo "<script>alert('Error creating admin account: " . mysqli_error($conn) . "');</script>";
  }


}
//admin account
if(isset($_POST['create_account_admin'])){

  $user_id = "2025".rand('1','10') . substr(str_shuffle(str_repeat("0123456789", 5)), 0, 3);
  $first_name = $_POST['first_name'];
  $middle_name = $_POST['middle_name'];   
  $last_name = $_POST['last_name'];
  $name_suffix = $_POST['name_suffix'];
  $role = '6';
  $email = $_POST['email'];
  $age = $_POST['age'];
  $phone = '+639' . $_POST['phone'];
  $date_of_birth = $_POST['date_of_birth'];
  $citizenship = $_POST['citizenship'];
  $civil_status = $_POST['civil_status'];
  $lot_number = $_POST['lot_number'];
  $block_number = $_POST['block_number'];
  $phase_number = $_POST['phase_number'];
  $village_name = $_POST['village_name'];
  $hoa_number = $_POST['hoa_number'];
  $account_status = $_POST['account_status'];
  

  $sql_create_account = "INSERT INTO users (role_id,user_id,first_name, middle_name, last_name, suffix, email_address,hoa_number, phone_number, age , date_of_birth, citizenship, civil_status,account_status, home_address, lot_number, block_number, phase_number, village_name, date_created,date_updated) VALUES ('$role', '$user_id', '$first_name', '$middle_name', '$last_name', '$name_suffix', '$email', '$hoa_number','$phone', '$age','$date_of_birth', '$citizenship', '$civil_status', '$account_status',NULL, '$lot_number', '$block_number', '$phase_number', '$village_name', NOW(), NOW())";
  $run_sql_create_account = mysqli_query($conn, $sql_create_account);

    if(!$run_sql_create_account){
      die("Query failed: " . mysqli_error($conn));
    }

  if($run_sql_create_account){
    echo "<script>alert(' Account created successfully!');</script>";
    echo"<script>window.location.href='../Users/admin/admin-accounts.php';</script> ";
  }else{
    echo "<script>alert('Error creating admin account: " . mysqli_error($conn) . "');</script>";
  }


}


?>
