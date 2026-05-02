<?php

include('../../connection/connection.php'); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
$user_id = $_SESSION['user_id'];


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

        if(isset($_GET['user_id']) && isset($_GET['id'])){
            $user_id = $_GET['user_id'];
            $id = $_GET['id'];
            $sql_view_payment = "SELECT 
                            u.user_id,
                            u.first_name,
                            u.last_name,
                            fa.id AS fee_assignation_id,
                            ft.fee_name,
                            ft.amount,
                            fa.is_paid,
                            fa.is_approved,
                            fa.next_due,
                            fa.payment_method,
                            pv.reference_number,
                            pv.proof_of_payment,
                            fa.payment_receipt_name,
                            fa.remarks
                        FROM users u
                        LEFT JOIN fee_assignation fa ON u.user_id = fa.user_id
                        LEFT JOIN fee_type ft ON fa.fee_type_id = ft.fee_type_id
                        LEFT JOIN payment_verification pv ON fa.id = pv.fee_assignation_id
                        WHERE u.role_id = '6' AND u.user_id = '$user_id'
                          AND fa.id = '$id'
                        ORDER BY u.first_name, u.last_name	";
                    $run_view_payment = mysqli_query($conn,$sql_view_payment);

                    if(mysqli_num_rows($run_view_payment) > 0){
                        foreach($run_view_payment as $row_view_payment){
                            ?>


                                <form action="../../Query/approve-online-payment.php" method="POST">
                                    <label for="">Name:</label>
                                    <input type="text" name="name" value="<?php echo $row_view_payment['first_name'] . " " . $row_view_payment['last_name']?>" readonly>
                                    <br>
                                    <label for="">Payment For:</label>
                                    <input type="text" name="fee_name" value="<?php echo $row_view_payment['fee_name']?>"readonly>
                                    <br>
                                    <label for="">Amount:</label>
                                    <input type="text" name="amount" value="<?php echo $row_view_payment['amount']?>"readonly>
                                    <br>
                                    <label for="">Date:</label>
                                    <input type="text" name="next_due" value="<?php echo $row_view_payment['next_due']?>"readonly>
                                    <br>
                                    <label for="">Payment Method:</label>
                                    <input type="text" name="payment_method" value="<?php echo $row_view_payment['payment_method']?>"readonly>
                                    <br>
                                    <label for="">Reference Number:</label>
                                    <input type="text" name="reference_number" value="<?php echo $row_view_payment['reference_number']?>"readonly>
                                    <br>
                                    <label for="">Image:</label>
                                    <br>
                                    <img src="../../uploads/<?php echo $row_view_payment['proof_of_payment']?>" alt="Payment" height="300px" width="300px">
                                    <br>
                                    <input type="hidden" name="proof_of_payment" value="<?php echo $row_view_payment['proof_of_payment']?>">

                                    <input type="hidden" name="fee_assignation_id" value="<?php echo $row_view_payment['fee_assignation_id']?>">
                                    <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
                                    <input type="hidden" name="payment_receipt_name" value="<?php echo $row_view_payment['payment_receipt_name']?>">
                                    <input type="hidden" name="remarks" value="<?php echo $row_view_payment['remarks']?>">

                                    <?php
                                        $is_paid = (int)$row_view_payment['is_paid'];
                                        $is_approved = (int)$row_view_payment['is_approved'];

                                        // Show buttons for pending / resubmitted / starting point
                                        if (($is_paid === 0 && ($is_approved === 0 || $is_approved === 2)) || ($is_paid === 1 && $is_approved === 2)) {
                                            echo '<input type="submit" name="approve" value="Approve">';
                                            echo '<input type="submit" name="reject" value="Reject">';
                                        }
                                        // Rejected
                                        elseif ($is_paid === 1 && $is_approved === 0) {
                                            echo '<p>Status: <strong>Rejected</strong></p>';
                                        }
                                        // Approved
                                        elseif ($is_paid === 1 && $is_approved === 1) {
                                            echo '<p>Status: <strong>Approved</strong></p>';
                                        }
                                        ?>
                                </form>
                            <?php 
                        }
                    }


        }

        

    ?>


</body>
</html>