<?php
include('../../connection/connection.php'); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(!isset($_GET['user_id'])){
    die("No user selected.");
}
$user_id = $_GET['user_id'];

$sql_fees_monthly = "SELECT fee_type_id, fee_name, amount, start_date
             FROM fee_type 
             WHERE cadence = 1 AND is_active = 1
             ORDER BY fee_name ASC";
$run_fees_monthly = mysqli_query($conn, $sql_fees_monthly);


$sql_fees_one_time = "SELECT fee_type_id, fee_name, amount, start_date
             FROM fee_type 
             WHERE cadence = 2 AND is_active = 1
             ORDER BY fee_name ASC";
$run_fees_one_time = mysqli_query($conn, $sql_fees_one_time);



$sql_assigned = "SELECT fee_type_id FROM fee_assignation WHERE user_id='$user_id'";
$res_assigned = mysqli_query($conn, $sql_assigned);
$assigned_fees = [];
while($row = mysqli_fetch_assoc($res_assigned)){
    $assigned_fees[] = $row['fee_type_id'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Assign Fees</title>
</head>
<body>
<h1>Assign Fees</h1>

<h2>Monthly Fees</h2>

<form action="../../Query/create-fee-assignation.php" method="POST">
    <?php
    if(mysqli_num_rows($run_fees_monthly) > 0){
        while($row = mysqli_fetch_assoc($run_fees_monthly)){
            $checked = in_array($row['fee_type_id'], $assigned_fees) ? 'checked' : '';
            ?>
            <label>
                <input type="checkbox" name="fee_ids_monthly[]" value="<?php echo $row['fee_type_id']; ?>" <?php echo $checked; ?>>
                <?php echo $row['fee_name']; ?> (₱<?php echo number_format($row['amount'],2); ?>)
            </label><br>
            <input type="text" name="start_date" value="<?php echo $row['start_date']; ?>"><br>
            <?php
        }
    } else {
        echo "No fees available.";
    }
    ?>

<h2>One-Time Fees</h2>
    <?php
    if(mysqli_num_rows($run_fees_one_time) > 0){
        while($row = mysqli_fetch_assoc($run_fees_one_time)){
            $checked = in_array($row['fee_type_id'], $assigned_fees) ? 'checked' : '';
            ?>
            <label>
                <input type="checkbox" name="fee_ids_one_time[]" value="<?php echo $row['fee_type_id']; ?>" <?php echo $checked; ?>>
                <?php echo $row['fee_name']; ?> (₱<?php echo number_format($row['amount'],2); ?>)
            </label><br>
            <input type="text" name="start_date" value="<?php echo $row['start_date']; ?>"><br>
            <?php
        }
    } else {
        echo "No fees available.";
    }
    ?>

    
    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
    <input type="submit" name="assign_fee" value="Assign Fees">
</form>

</body>
</html>
