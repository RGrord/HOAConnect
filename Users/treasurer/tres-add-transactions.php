<?php
session_start();
include('../../connection/connection.php'); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$user_id = $_SESSION['user_id'] ?? 0;

// Upload folder
$upload_dir = __DIR__ . '/../../uploads/acknowledgement_receipt/';

// Create directory if not exist
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

$message = "";

if (isset($_POST['submit_transaction'])) {

    // Get POST fields
    $particulars        = mysqli_real_escape_string($conn, $_POST['particulars']);
    $date               = mysqli_real_escape_string($conn, $_POST['date']);
    $transaction_type   = "Debit";
    $name_of_payer      = mysqli_real_escape_string($conn, $_POST['name_of_payer']);
    $name_of_receiver   = mysqli_real_escape_string($conn, $_POST['name_of_receiver']);
    $payment_method     = mysqli_real_escape_string($conn, $_POST['payment_method']);
    $reference_number   = mysqli_real_escape_string($conn, $_POST['reference_number']);
    $remarks            = mysqli_real_escape_string($conn, $_POST['remarks']);
    $today              = date("Y-m-d");

    // ======================
    // HANDLE PDF UPLOAD
    // ======================
    if ($_FILES['acknowledgement_receipt']['error'] === 0) {

        $tmp_name = $_FILES['acknowledgement_receipt']['tmp_name'];
        $original_name = $_FILES['acknowledgement_receipt']['name'];

        // Only allow PDF
        $extension = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));
        if ($extension !== "pdf") {
            die("<p style='color:red;'>Only PDF files are allowed.</p>");
        }

        // Clean file name
        $safe_name = time() . "_" . preg_replace("/[^a-zA-Z0-9._-]/", "_", $original_name);

        // Final path
        $target_file = $upload_dir . $safe_name;

        // Move file
        if (!move_uploaded_file($tmp_name, $target_file)) {
            die("<p style='color:red;'>Failed to upload PDF file.</p>");
        }

        // Save filename into DB (NOT file contents)
        $file_to_db = $safe_name;

    } else {
        $file_to_db = ""; // No file uploaded
    }

    // ======================
    // INSERT QUERY
    // ======================
    $sql = "INSERT INTO transactions 
            (particulars, date, transaction_type, name_of_payer, name_of_receiver, 
             payment_method, reference_number, acknowledgement_receipt, remarks,status, created_by, date_created, date_updated)
            VALUES 
            ('$particulars', '$date', '$transaction_type', '$name_of_payer', '$name_of_receiver',
             '$payment_method', '$reference_number', '$file_to_db', '$remarks', 0,'$user_id','$today', '$today')";

    if (mysqli_query($conn, $sql)) {
        $message = "<p style='color:green;'>Transaction saved successfully!</p>";
        echo "<script>window.location.href='tres-transactions.php' </script>";
    } else {
        $message = "<p style='color:red;'>Database Error: " . mysqli_error($conn) . "</p>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Transaction</title>
</head>
<body>

<h2>Add New Transaction</h2>

<?= $message ?>

<form action="" method="POST" enctype="multipart/form-data">

    <label>Particulars</label><br>
    <input type="text" name="particulars" required><br><br>

    <label>Date</label><br>
    <input type="date" name="date" required><br><br>

    <label>Name of Payer</label><br>
    <input type="text" name="name_of_payer" required><br><br>

    <label>Name of Receiver</label><br>
    <input type="text" name="name_of_receiver" required><br><br>

    <label>Payment Method</label><br>
    <input type="text" name="payment_method" required><br><br>

    <label>Reference Number</label><br>
    <input type="text" name="reference_number" required><br><br>

    <label>Acknowledgement Receipt (PDF)</label><br>
    <input type="file" name="acknowledgement_receipt" accept="application/pdf"><br><br>

    <label>Remarks</label><br>
    <textarea name="remarks" required></textarea><br><br>

    <input type="submit" name="submit_transaction" value="Save Transaction">

</form>

</body>
</html>
