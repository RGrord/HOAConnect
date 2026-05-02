<?php
session_start();
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
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Always sanitize input
    $query_transaction = "SELECT * FROM transactions WHERE id = $id LIMIT 1";
    $run_transaction = mysqli_query($conn, $query_transaction);

    if ($run_transaction && mysqli_num_rows($run_transaction) > 0) {
        $row_transaction = mysqli_fetch_assoc($run_transaction);

        $particulars          = htmlspecialchars($row_transaction['particulars']);
        $date                 = htmlspecialchars($row_transaction['date']);
        $transaction_type     = htmlspecialchars($row_transaction['transaction_type']);
        $name_of_payer        = htmlspecialchars($row_transaction['name_of_payer']);
        $name_of_receiver     = htmlspecialchars($row_transaction['name_of_receiver']);
        $payment_method       = htmlspecialchars($row_transaction['payment_method']);
        $reference_number     = htmlspecialchars($row_transaction['reference_number']);
        $remarks              = htmlspecialchars($row_transaction['remarks']);
        $status_code          = intval($row_transaction['status']);

        switch ($status_code) {
            case 0: $status_text = "Pending"; break;
            case 1: $status_text = "Approved"; break;
            case 2: $status_text = "Rejected"; break;
            default: $status_text = "Unknown"; break;
        }

        echo "<h2>Transaction Details</h2>";
        echo "<p><strong>Particulars:</strong> $particulars</p>";
        echo "<p><strong>Date:</strong> $date</p>";
        echo "<p><strong>Transaction Type:</strong> $transaction_type</p>";
        echo "<p><strong>Name of Payer:</strong> $name_of_payer</p>";
        echo "<p><strong>Name of Receiver:</strong> $name_of_receiver</p>";
        echo "<p><strong>Payment Method:</strong> $payment_method</p>";
        echo "<p><strong>Reference Number:</strong> $reference_number</p>";
        echo "<p><strong>Remarks:</strong> $remarks</p>";
        echo "<p><strong>Status:</strong> $status_text</p>";

        // If there is an acknowledgement_receipt
        if (!empty($row_transaction['acknowledgement_receipt'])) {
            echo "<p><strong>Receipt:</strong> <a href='president-view-receipt.php?id=$id' target='_blank'>View PDF</a></p>";
        } else {
            echo "<p><strong>Receipt:</strong> None</p>";
        }

    } else {
        echo "<p style='color:red;'>Transaction not found.</p>";
    }
    
}
?>

<form action="" method="POST">
    <input type="submit" name="approve">
</form>



    
</body>
</html>