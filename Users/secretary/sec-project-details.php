<?php
session_start();
include('../../connection/connection.php'); 
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['user_id'])) {
    exit("Unauthorized");
}
$user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Resolution</title>
</head>
<body>

<?php

if (isset($_GET['id'])) {

    $id = intval($_GET['id']);

    $query = "SELECT * FROM resolution WHERE id = $id";
    $run = mysqli_query($conn, $query);

    if (mysqli_num_rows($run) > 0) {
        
        $row = mysqli_fetch_assoc($run);
        ?>

        <h1>Resolution Details</h1>

        <label>Resolution Title</label><br>
        <input type="text" value="<?= htmlspecialchars($row['project_resolution_title']) ?>" readonly><br><br>

        <label>Resolution Summary</label><br>
        <textarea readonly><?= htmlspecialchars($row['resolution_summary']) ?></textarea><br><br>

        <label>Estimated Budget</label><br>
        <input type="text" value="<?= htmlspecialchars($row['estimated_budget']) ?>" readonly><br><br>

        <label>Start Date</label><br>
        <input type="date" value="<?= $row['target_start_date'] ?>" readonly><br><br>

        <label>End Date</label><br>
        <input type="date" value="<?= $row['target_end_date'] ?>" readonly><br><br>

        <label>Project Proposal Document</label><br>
        <?php if (!empty($row['project_proposal_document'])): ?>
            <a href="view_pdf.php?id=<?= $id ?>&file=proposal" target="_blank">View Proposal PDF</a>
        <?php else: ?>
            <span>No PDF uploaded</span>
        <?php endif; ?>
        <br><br>

        <label>Signed Resolution</label><br>
        <?php if (!empty($row['upload_signed_resolution'])): ?>
            <a href="view_pdf.php?id=<?= $id ?>&file=signed" target="_blank">View Signed Resolution PDF</a>
        <?php else: ?>
            <span>No PDF uploaded</span>
        <?php endif; ?>
        <br><br>

        <?php
    } else {
        echo "No record found.";
    }
}
?>

</body>
</html>
