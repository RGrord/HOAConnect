<?php
include('../../connection/connection.php'); 

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

                    <form action="../../Query/edit-account.php" method="POST" enctype="multipart/form-data">
                    <label for="">First Name:</label>
                    <input type="text" name="first_name" value="<?php echo $row_user['first_name']; ?>">
                    <label for="">Middle Name:</label>
                    <input type="text" name="middle_name" value="<?php echo $row_user['middle_name']; ?>">
                    <label for="">Last Name:</label>
                    <input type="text" name="last_name" value="<?php echo $row_user['last_name']; ?>">
                    <label for="">Suffix:</label>
                    <input type="text" name="name_suffix" value="<?php echo $row_user['suffix']; ?>">
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

                    <select name="role" id=""
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" required>
                        <option value="" disabled selected>Select Role</option>
                        <option value="Secretary">Secretary</option>
                        <option value="Admin">Admin</option>
                        <option value="Treasurer">Treasurer</option>
                        <option value="Audit">Audit</option>
                        <option value="Member">Member</option>
                    </select>
                    <label for="">Email Address:</label>
                    <input type="email" name="email" value="<?php echo $row_user['email_address']; ?>">
                    <label for="">HOA Number:</label>
                    <input type="text" name="hoa_number" value="<?php echo $row_user['hoa_number']; ?>">
                    
                    <label for="">Age:</label>
                    <input type="number" name="age" value="<?php echo $row_user['age']; ?>">
                    <label for="">Phone Number:</label>
                    <input type="text" name="phone_number" value="<?php echo ltrim($row_user['phone_number'], '+639'); ?>">
                    <label for="">Date of Birth:</label>
                    <input type="date" name="date_of_birth" value="<?php echo $row_user['date_of_birth']; ?>">
                    <label for="">Citizenship:</label>
                    <input type="text" name="citizenship" value="<?php echo $row_user['citizenship']; ?>">
                    <label for="">Civil Status:</label>
                    <input type="text" name="civil_status" value="<?php echo $row_user['civil_status']; ?>" readonly>
                    <select name="civil_status" id="sec-relationship-status"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" required>
                        <option value="" disabled selected>Select Status</option>
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                        <option value="Divorced">Divorced</option>
                        <option value="Widowed">Widowed</option>
                        <option value="Annulled">Annulled</option>
                    </select>
                    <div>
                    <label for="" class="block text-sm font-medium text-gray-700">Account Status</label>
                    <select name="account_status" id=""
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm" required>
                        <option value="" disabled>Select status</option>
                        <option value="1">Active</option>
                        <option value="2">Inactive</option>
                    </select>
                    </div>
                    <label for="">Home Address:</label>
                    <input type="text" name="home_address" value="<?php echo $row_user['home_address']; ?>">
                    <label for="">Lot Number:</label>
                    <input type="text" name="lot_number" value="<?php echo $row_user['lot_number']; ?>">
                    <label for="">Block Number:</label>
                    <input type="text" name="block_number" value="<?php echo $row_user  ['block_number']; ?>">
                    <label for="">Phase Number:</label>
                    <input type="text" name="phase_number" value="<?php echo $row_user  ['phase_number']; ?>">
                    <label for="">Village Name:</label>
                    <input type="text" name="village_name" value="<?php echo $row_user  ['village_name']; ?>">
                    <br>
                    <input type="hidden" name="user_id" value="<?php echo $row_user['user_id']; ?>">
                    <button type="submit" name="update_account">Update Account</button>
                    </form>

                <?php
               }
            }
        }


    ?>


</body>
</html>