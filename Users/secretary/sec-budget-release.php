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
    <title>Budget Release Details</title>
</head>
<body>
    <h1>Budget Release Details</h1>

    <?php
    if(isset($_GET['id'])){
        $id = intval($_GET['id']);

        $sql_budget = "SELECT 
                            r.id AS resolution_id,
                            r.project_resolution_title,
                            r.estimated_budget,
                            b.recipient,
                            b.release_date,
                            b.payment_method,
                            b.reference_number,
                            b.acknowledgement_receipt,
                            b.purpose,
                            b.approval_notes
                        FROM resolution r
                        LEFT JOIN budget b ON r.id = b.project_id
                        WHERE r.id = '$id'";

        $run_budget = mysqli_query($conn,$sql_budget);

        if(mysqli_num_rows($run_budget) > 0){
            $budget = mysqli_fetch_assoc($run_budget);
            ?>

            <form action="" method="POST" enctype="multipart/form-data">
                <label>Project Resolution Title:</label><br>
                <input type="text" name="project_resolution_title" value="<?php echo htmlspecialchars($budget['project_resolution_title']); ?>" readonly><br><br>

                <label>Estimated Budget:</label><br>
                <input type="text" name="estimated_budget" value="<?php echo htmlspecialchars($budget['estimated_budget']); ?>" readonly><br><br>

                <label>Recipient:</label><br>
                <input type="text" name="recipient" value="<?php echo htmlspecialchars($budget['recipient']); ?>" readonly><br><br>

                <label>Release Date:</label><br>
                <input type="date" name="release_date" value="<?php echo $budget['release_date']; ?>" readonly><br><br>

                <label>Payment Method:</label><br>
                <input type="text" name="payment_method" value="<?php echo htmlspecialchars($budget['payment_method']); ?>" readonly><br><br>

                <label>Reference Number:</label><br>
                <input type="text" name="reference_number" value="<?php echo htmlspecialchars($budget['reference_number']); ?>" readonly><br><br>

                <label>Acknowledgement Receipt:</label><br>
                <?php if(!empty($budget['acknowledgement_receipt'])): ?>
                    <a href="../../uploads/budget_release/<?php echo $budget['acknowledgement_receipt']; ?>" target="_blank">View PDF</a>
                <?php else: ?>
                    <span>No file uploaded</span>
                <?php endif; ?>
                <br><br>

                <label>Purpose:</label><br>
                <input type="text" name="purpose" value="<?php echo htmlspecialchars($budget['purpose']); ?>" readonly><br><br>

                <label>Approval Notes:</label><br>
                <input type="text" name="approval_notes" value="<?php echo htmlspecialchars($budget['approval_notes']); ?>" readonly><br><br>
            </form>

            <?php
        } else {
            echo "<p>No budget release data found for this resolution.</p>";
        }
    } else {
        echo "<p>Invalid request. Resolution ID not provided.</p>";
    }
    ?>
</body>
</html>
