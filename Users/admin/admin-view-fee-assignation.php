<?php
include('../../connection/connection.php'); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check user_id
if(!isset($_GET['user_id'])) {
    echo "<p>No user selected.</p>";
    exit;
}
$user_id = $_GET['user_id'];

// Fetch unpaid fees total
$sql_total = "SELECT total_balance FROM unpaid_fees WHERE user_id = '$user_id'";
$res_total = mysqli_query($conn, $sql_total);
$total_balance = 0;
if($res_total && mysqli_num_rows($res_total) > 0) {
    $row_total = mysqli_fetch_assoc($res_total);
    $total_balance = $row_total['total_balance'];
}

// Fetch unpaid fees, latest due first
$sql_fees = "SELECT fa.id, fa.fee_type_id, fa.next_due, fa.is_paid, ft.fee_name, ft.amount, ft.cadence
             FROM fee_assignation fa
             JOIN fee_type ft ON fa.fee_type_id = ft.fee_type_id
             WHERE fa.user_id = '$user_id' AND fa.is_paid = 0
             ORDER BY fa.next_due DESC";
$res_fees = mysqli_query($conn, $sql_fees);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Fee Assignation</title>
<style>
    input[readonly] { background-color: #f0f0f0; border: 1px solid #ccc; }
    label { display: inline-block; width: 120px; }
    .fee-row { margin-bottom: 10px; }
</style>

</head>
<body>

<h2>Fee Assignation</h2>

<?php if(mysqli_num_rows($res_fees) == 0) {
    echo "<p>No unpaid fees found for this user.</p>";
} else { ?>

<form action="../../Query/pay-balance.php" method="POST">
    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

    <?php while($row = mysqli_fetch_assoc($res_fees)): ?>
        <div class="fee-row">
            <input type="checkbox" name="selected_fees[]" value="<?php echo $row['id']; ?>" 
                   data-amount="<?php echo $row['amount']; ?>" onchange="updateTotal()">
            <label>Fee Name:</label>
            <input type="text" value="<?php echo $row['fee_name']; ?>" readonly>

            <label>Due Date:</label>
            <input type="text" value="<?php echo date('M d, Y', strtotime($row['next_due'])); ?>" readonly>

            <label>Amount:</label>
            <input type="text" value="<?php echo number_format($row['amount'],2); ?>" readonly>

            <label>Cadence:</label>
            <input type="text" value="<?php echo $row['cadence'] == 1 ? 'Monthly' : 'One-Time'; ?>" readonly>
        </div>
    <?php endwhile; ?>

    <hr>
    <label>Payment Method:</label>
    <select name="payment_method" required>
        <option value="">Select Payment Method</option>
        <option value="Cash">Cash</option>
        <option value="Bank Transfer">Bank Transfer</option>
        <option value="Check">Check</option>
    </select><br><br>

    <label>Payment Receipt Name:</label>
    <input type="text" name="payment_receipt_name" required><br><br>

    <label>Remarks:</label>
    <input type="text" name="remarks"><br><br>

    <label>Total Selected Fees:</label>
    <input type="text" id="selected_total" value="0.00" readonly><br><br>

    <button type="submit" name="mark_as_paid">Mark Selected as Paid</button>
</form>

<?php } ?>


<script>
function updateTotal() {
    let checkboxes = document.querySelectorAll('input[name="selected_fees[]"]');
    let total = 0;
    checkboxes.forEach(cb => {
        if(cb.checked) {
            total += parseFloat(cb.dataset.amount);
        }
    });
    document.getElementById('selected_total').value = total.toFixed(2);
}
</script>

</body>
</html>
