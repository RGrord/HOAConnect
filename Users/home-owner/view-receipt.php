<?php
include('../../connection/connection.php'); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

    if(isset($_GET['id'])&& isset($_GET['user_id'])){
        $id = $_GET['id'];
        $user_id = $_GET['user_id'];

        $sql_view_payment = "SELECT 
            ft.id AS ft_id,
                ft.fee_type_id,
                ft.fee_name,
                ft.amount,
                fa.id AS fee_assignation_id,
                fa.next_due,
                fa.is_paid,
                fa.payment_method,
                fa.is_approved,
                pv.reference_number,
                pv.proof_of_payment
            FROM fee_type ft
            LEFT JOIN fee_assignation fa ON ft.fee_type_id = fa.fee_type_id
            LEFT JOIN payment_verification pv ON fa.id = pv.fee_assignation_id
            WHERE fa.user_id = '$user_id' 
            AND fa.id = '$id';
            ";
        $run_view_payment = mysqli_query($conn,$sql_view_payment);

        if(mysqli_num_rows($run_view_payment) > 0){
            foreach($run_view_payment as $row_view_payment){
                ?>

                    <label for="">Payment Details</label>
                    <label for="">Fee Name:</label>
                    <input type="text" name="fee_name" value="<?php echo $row_view_payment['fee_name']?>"readonly>
                    <label for="">Amount:</label>
                    <input type="text" name="amount" id="" value="<?php echo $row_view_payment['amount']?>" readonly>
                    <label for="">Due Date:</label>
                    <input type="text" name="next_due" value="<?php echo $row_view_payment['next_due']?>">
                    <label for="">Status:</label>
                    <input type="text" name="status" 
                    value="<?php 
                        if($row_view_payment['is_approved'] == 2){
                            echo "Pending";
                        }elseif($row_view_payment['is_approved'] == 1){
                            echo "Paid";
                        }else{
                            echo "Unpaid";
                        }
                    ?>
                    "readonly>
                    <label for="">Reference Number:</label>
                    <input type="text" name="reference_number" value="<?php echo $row_view_payment['reference_number']?>" readonly>
                    <label for="">Proof of Payment:</label>
                    <img src="../../uploads/<?php echo $row_view_payment['proof_of_payment']?>" alt="proof of payment" height="550px" width="560px">
                <?php
            }
        }
    }


    ?>
</body>
</html>