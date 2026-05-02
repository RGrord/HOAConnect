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

        if(isset($_GET['user_id'])){
            $user_id = $_GET['user_id'];

            $sql_fetch_user = "SELECT * FROM users WHERE user_id = '$user_id'";
            $run_sql_fetch_user = mysqli_query($conn, $sql_fetch_user);

            if(mysqli_num_rows($run_sql_fetch_user) > 0){
               foreach($run_sql_fetch_user as $row_user){
                ?>

                    <label for="">First Name:</label>
                    <input type="text" name="first_name" value="<?php echo $row_user['first_name']; ?>" readonly>
                    <label for="">Middle Name:</label>
                    <input type="text" name="middle_name" value="<?php echo $row_user['middle_name']; ?>" readonly>
                    <label for="">Last Name:</label>
                    <input type="text" name="last_name" value="<?php echo $row_user['last_name']; ?>" readonly>
                    <label for="">Suffix:</label>
                    <input type="text" name="name_suffix" value="<?php echo $row_user['suffix']; ?>" readonly>
                    <label for="">Role:</label>
                    <input type="text" name="role" value="<?php 
                        if($row_user['role_id'] == 2){
                            echo 'Secretary';
                        }elseif($row_user['role_id'] == 3){
                            echo 'Admin';
                        }elseif($row_user['role_id'] == 4){
                            echo 'Treasurer';
                        }elseif($row_user['role_id'] == 5){
                            echo 'Audit';
                        }else{
                            echo 'Member';
                        }
                    ?>" readonly>
                    
                    <label for="">Email Address:</label>
                    <input type="email" name="email" value="<?php echo $row_user['email_address']; ?>" readonly>
                    <label for="">HOA Number:</label>
                    <input type="text" name="hoa_number" value="<?php echo $row_user['hoa_number']; ?>" readonly>

                    <label for="">Age:</label>
                    <input type="number" name="age" value="<?php echo $row_user['age']; ?>" readonly>
                    <label for="">Phone Number:</label>
                    <input type="text" name="phone_number" value="<?php echo ltrim($row_user['phone_number'], '+639'); ?>" readonly>
                    <label for="">Date of Birth:</label>
                    <input type="date" name="date_of_birth" value="<?php echo $row_user['date_of_birth']; ?>" readonly>
                    <label for="">Citizenship:</label>
                    <input type="text" name="citizenship" value="<?php echo $row_user['citizenship']; ?>" readonly>
                    <label for="">Civil Status:</label>
                    <input type="text" name="civil_status" value="<?php echo $row_user['civil_status']; ?>" readonly>
                    <label for="">Home Address:</label>
                    <input type="text" name="home_address" value="<?php echo $row_user['home_address']; ?>" readonly>
                    <label for="">Lot Number:</label>
                    <input type="text" name="lot_number" value="<?php echo $row_user['lot_number']; ?>" readonly>
                    <label for="">Block Number:</label>
                    <input type="text" name="block_number" value="<?php echo $row_user  ['block_number']; ?>" readonly>
                    <label for="">Phase Number:</label>
                    <input type="text" name="phase_number" value="<?php echo $row_user  ['phase_number']; ?>" readonly>
                    <label for="">Village Name:</label>
                    <input type="text" name="village_name" value="<?php echo $row_user  ['village_name']; ?>" readonly>
                    <br>

                <?php
               }
            }else{
                echo "<p>No user found with the given ID.</p>";
            }
        }else{
            echo "<p>User ID not provided.</p>";
        }

    ?>


</body>
</html>