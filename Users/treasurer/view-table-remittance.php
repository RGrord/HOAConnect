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

        if(isset($_GET['id'])){
            $remittance_table_id = $_GET['id'];

            $sql_remittance_table = "SELECT * FROM remittance WHERE id = '$remittance_table_id' AND is_approved = '0' ";
            $run_remittance_table = mysqli_query($conn,$sql_remittance_table);

            if(mysqli_num_rows($run_remittance_table) > 0){
                foreach($run_remittance_table as $row_tables){
                    ?>

                        <form action="../../Query/approve-reject-remittance.php" method="POST">
                            <label for="">Particular:</label>
                            <p><?php echo $row_tables['particular']?></p>
                            <label for="">Amount:</label>
                            <p><?php echo $row_tables['amount']?></p>
                            <label for="">Date:</label>
                            <p><?php echo $row_tables['date']?></p>
                            <label for="">Transaction Type:</label>
                            <p><?php echo $row_tables['transaction_type']?></p>
                            <label for="">Secretary Name:</label>
                            <p><?php echo $row_tables['secretary_name']?></p>
                            
                            <p>
                                <?php 
                                    if($row_tables['is_approved'] == 0){
                                        ?>
                                            <input type="submit" name="approve" value="Approve">
                                            <!-- <input type="submit" name="reject" value="Reject"> -->
                                        <?php 
                                    }else{
                                        echo "";
                                    }
                                ?>
                            </p>
                            <input type="hidden" name="id" value="<?php echo $row_tables['id']?>">
                        </form>
                    <?php 
                }
            }
        }

    ?>
    
</body>
</html>