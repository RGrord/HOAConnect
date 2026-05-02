<?php
include('../../connection/connection.php'); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

    $sql_total = "SELECT SUM(payment_history.amount) AS total_collected 
    FROM users 
    INNER JOIN payment_history ON users.user_id = payment_history.user_id 
    WHERE users.role_id = '6'";

    $result_total = mysqli_query($conn, $sql_total);
    $row_total = mysqli_fetch_assoc($result_total);
    $total_collected = $row_total['total_collected'] ?? 0;
    
    ?>
    <form action="../../Query/submit-remittance.php" method="POST">
        <label for="">Particular:</label>
        <input type="text" name="particular">
        <br>
        <label for="">Amount: </label>
        <input type="text" name="amount" value="<?php echo $total_collected?>" readonly>
        <br>
        <label for="">Secretary Name:</label>
        <input type="text" name="secretary_name">

        <input type="submit" name="submit_remittance" value="Submit">
    </form>

    
</body>
</html>