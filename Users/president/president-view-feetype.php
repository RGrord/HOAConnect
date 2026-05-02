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

    if(isset($_GET['fee_type_id'])){
        $fee_type_id = $_GET['fee_type_id'];

        $query_fee_type = "SELECT users.user_id, users.first_name, users.last_name, fee_type.fee_type_id, fee_type.user_id, fee_type.fee_name, fee_type.description, fee_type.amount, fee_type.cadence, fee_type.start_date, fee_type.is_active , fee_type.remarks, fee_type.approved, fee_type.datetime_created, fee_type.datetime_updated
        FROM users
        LEFT JOIN fee_type
        ON users.user_id = fee_type.user_id 
        WHERE fee_type.fee_type_id = '$fee_type_id'";
        $run_fee_type = mysqli_query($conn, $query_fee_type);
        
        if(mysqli_num_rows($run_fee_type) > 0){
            foreach($run_fee_type as $row_fee_type){
                ?>

                <form action="../../Query/approve-reject-fee-type.php" method="post" enctype="multipart/form-data">
                <h1>Fee Type Details</h1>
                
                <label for="">Fee Name:</label>
                <input type="text" name="fee_name" value="<?php echo $row_fee_type['fee_name']; ?>" readonly><br>

                <label for="">Description:</label>
                <input type="text" name="description" value="<?php echo $row_fee_type['description']; ?>" readonly><br>

                <label for="">Amount:</label>
                <input type="text" name="amount" value="<?php echo $row_fee_type['amount']; ?>" readonly><br>

                <label for="">Start Date: </label>
                <input type="text" name="start_date" value="<?php echo $row_fee_type['start_date']; ?>" readonly><br>
                <label for="">Created By: </label>
                <input type="text" name="created_by" value="<?php echo $row_fee_type['first_name'] . ' ' . $row_fee_type['last_name']; ?>" readonly><br>

                <label for="">Date & Time</label>
                <input type="text" name="datetime_created" value="<?php echo $row_fee_type['datetime_created']; ?>" readonly><br>

                <label for="">Notes: </label>

                <textarea name="notes"></textarea>

                <?php

                    if($row_fee_type['approved'] == 3){
                        ?>
                            <input type="submit" name="approve_fee_type" value="Approve">
                            <input type="submit" name="reject_fee_type" value="Reject">
                        <?php
                    }

                ?>
                <input type="hidden" name="fee_type_id" value="<?php echo $row_fee_type['fee_type_id']; ?>">
                </form>
                <?php
            }
        }
    }

    ?>

</body>
</html>