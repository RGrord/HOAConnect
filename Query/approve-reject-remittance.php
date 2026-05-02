<?php

include('../connection/connection.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if(isset($_POST['approve'])){
    $approve = 1;
    
    $id = $_POST['id'];
    $sql_update_remittance = "UPDATE remittance SET is_approved = '$approve' WHERE id = '$id'";
    $run_update_remittance = mysqli_query($conn,$sql_update_remittance);

    if($run_update_remittance){
        echo "Approved Remittance";
    }else{
        echo "Rejected Remittance";
    }
}

if(isset($_POST['reject'])){
    $reject = 2;
    
    $id = $_POST['id'];
    $sql_update_remittance = "UPDATE remittance SET is_approved = '$approve' WHERE id = '$id'";
    $run_update_remittance = mysqli_query($conn,$sql_update_remittance);

    if($run_update_remittance){
        echo "Approved Remittance";
    }else{
        echo "Rejected Remittance";
    }
}

?>