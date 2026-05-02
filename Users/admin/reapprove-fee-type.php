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

        $sql_fetch_fee_type = "SELECT * FROM fee_type WHERE fee_type_id = '$fee_type_id'";
        $run_sql_fetch_fee_type = mysqli_query($conn, $sql_fetch_fee_type);

        if(mysqli_num_rows($run_sql_fetch_fee_type) > 0){
           foreach($run_sql_fetch_fee_type as $row_fee_type){
            ?>

                <form action="../../Query/reapprove-fee-type.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="fee_type_id" value="<?php echo $row_fee_type['fee_type_id']; ?>">
                <label for="">Fee Name:</label>
                <input type="text" name="fee_name" value="<?php echo $row_fee_type['fee_name']; ?>">
                <label for="">Description:</label>
                <textarea name="description"><?php echo $row_fee_type['description']; ?></textarea>
                <label for="">Amount:</label>
                <input type="number" name="amount" value="<?php echo $row_fee_type['amount']; ?>">
                
                <div>
                    <label for="fee-cadence">Cadence</label>
                    <input type="text" name="cadence" value="<?php 
                        if($row_fee_type['cadence'] == 1){
                            echo 'Monthly';
                        }elseif($row_fee_type['cadence'] == 2){
                            echo 'One-Time';
                        }
                    ?>" readonly>
                    <select name="cadence" id="fee-cadence">
                        <option value="">Select cadence</option>
                        <option value="1">Monthly</option>
                        <option value="2">One-Time</option>
                    </select>
                </div>

                <div>
                    <label for="fee-start-date">Start Date</label>
                    <input type="date" id="fee-start-date" value="<?php echo $row_fee_type['start_date'];?>" name="start_date" required>
                </div>

                 <div>
                    <label for="">Active</label>
                    <select name="active" id="">
                    <option value="">Select</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                    </select>
                </div>


                <button type="submit" name="update_fee_type">Update Fee Type</button>
                </form>

            <?php
           }
        }
    }


    ?>


<script>
     document.getElementById('fee-start-date').addEventListener('change', function() {
      const cadence = document.getElementById('fee-cadence').value;
      const selectedDate = new Date(this.value);

      if (cadence === '1' && selectedDate.getDate() !== 1) {
        alert('Please select the first day of the month only.');
        this.value = '';
      }
    });
</script>

</body>
</html>