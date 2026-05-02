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



if(isset($_GET['user_id']) && isset($_GET['id'])){
    $user_id = $_GET['user_id'];
    $id = $_GET['id'];

    $sql_fees = "SELECT fa.id, fa.fee_type_id, fa.next_due, fa.is_paid, fa.is_approved,
           ft.fee_name, ft.amount, ft.cadence
    FROM fee_assignation fa
    JOIN fee_type ft ON fa.fee_type_id = ft.fee_type_id
    WHERE fa.user_id = '$user_id' 
      AND (
            (fa.is_paid = 0) 
            OR (fa.is_paid = 1 AND fa.is_approved = 0)
          )
      AND fa.id = '$id'
    ORDER BY fa.next_due DESC";
$res_fees = mysqli_query($conn, $sql_fees);

}

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

<form action="../../Query/pay-balance-single.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

    <?php while($row = mysqli_fetch_assoc($res_fees)): ?>
        <div class="fee-row">
            <input type="hidden" name="selected_fees" value="<?php echo $row['id']; ?>" 
                   data-amount="<?php echo $row['amount']; ?>" onchange="updateTotal()">
            <label>Fee Name:</label>
            <input type="text" name="fee_name" value="<?php echo $row['fee_name']; ?>" readonly>

            <label>Due Date:</label>
            <input type="text" name="next_due" value="<?php echo date('M d, Y', strtotime($row['next_due'])); ?>" readonly>

            <label>Amount:</label>
            <input type="text" name="amount" value="<?php echo number_format($row['amount'],2); ?>" readonly>

            <label>Cadence:</label>
            <input type="text" value="<?php echo $row['cadence'] == 1 ? 'Monthly' : 'One-Time'; ?>" readonly>
        </div>
    <?php endwhile; ?>

        <hr>
        <label>Payment Method:</label>
            <select id="payment_method" name="payment_method" required>
                <option value="">Select Payment Method</option>
                <option value="GCash">GCash</option>
                <option value="Bank Transfer">Bank Transfer</option>
            </select>
        <br><br>

    <img id="payment_img" src="../../qr_code/default.jpg" alt="Payment QR" height="550px" width="350px">
    <br><br>

    <label>Payment Receipt Name:</label>
    <input type="text" name="payment_receipt_name" required><br><br>

    <label>Reference Number:</label>
    <input type="text" name="reference_number" required><br><br>

    <label>Remarks:</label>
    <input type="text" name="remarks"><br><br>

    <label for="proof_of_payment">Upload Proof of Payment</label>
    <input type="file" id="proof_of_payment" name="proof_of_payment" accept=".jpg,.jpeg,.png">
    <br>
    <img id="payment_preview" src="#" alt="Preview" style="display:none; max-width:300px; margin-top:10px;">
    <br>
    <input type="hidden" name="user_id" value="<?php echo $user_id?>">

  

    <button type="submit" name="mark_as_paid">Mark Selected as Paid</button>
</form>

<?php } ?>

<script>
    const paymentSelect = document.getElementById('payment_method');
    const paymentImg = document.getElementById('payment_img');

    paymentSelect.addEventListener('change', function() {
        const value = this.value;

        switch(value) {
            case 'GCash':
                paymentImg.src = '../../qr_code/gcash.jpg';
                paymentImg.alt = 'GCash QR';
                break;
            case 'Bank Transfer':
                paymentImg.src = '../../qr_code/bank.png';
                paymentImg.alt = 'Bank Transfer QR';
                break;
            default:
                paymentImg.src = '../../qr_code/default.jpg';
                paymentImg.alt = 'Payment QR';
        }
    });


    const fileInput = document.getElementById('proof_of_payment');
    const preview = document.getElementById('payment_preview');

    fileInput.addEventListener('change', function() {
        const file = this.files[0];
        if(file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            preview.src = '#';
            preview.style.display = 'none';
        }
    });
</script>
</body>
</html>
