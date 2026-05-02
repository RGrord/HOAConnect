<?php
session_start();
include('../../connection/connection.php'); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$user_id = $_SESSION['user_id'];

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) die("Invalid project resolution ID.");

// Fetch liquidation info (single fetch)
$sql_liq = "SELECT 
                r.project_resolution_title,
                r.estimated_budget,
                l.total_expenses,
                l.status AS liq_status,
                d.audit_result,
                d.remaning_budget,
                d.remarks
            FROM resolution r
            JOIN liquidation_of_expenses l ON r.id = l.project_resolution_id
            JOIN liquidation_expenses_details d ON l.id = d.liquidation_id
            WHERE r.id = $id
            LIMIT 1"; // single fetch
$result_liq = mysqli_query($conn, $sql_liq);

if (!$result_liq || mysqli_num_rows($result_liq) == 0) {
    die("No liquidation data found for this resolution.");
}

$liq_info = mysqli_fetch_assoc($result_liq);

// Fetch all expense line items
$sql_exp = "SELECT particular, amount, receipt 
            FROM liquidation_expenses_details 
            WHERE liquidation_id = (SELECT id FROM liquidation_of_expenses WHERE project_resolution_id = $id LIMIT 1)
            ORDER BY id ASC";
$result_exp = mysqli_query($conn, $sql_exp);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Liquidation Details</title>
<style>
table { border-collapse: collapse; width: 100%; margin-top: 10px; }
th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
th { background-color: #f4f4f4; }
</style>
</head>
<body>

<h2>Project Resolution: <?php echo htmlspecialchars($liq_info['project_resolution_title']); ?></h2>
<p>Estimated Budget: ₱ <?php echo number_format($liq_info['estimated_budget'], 2); ?></p>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Particular</th>
            <th>Amount</th>
            <th>Receipt</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $count = 1;
        while($row = mysqli_fetch_assoc($result_exp)) {
            echo "<tr>";
            echo "<td>{$count}</td>";
            echo "<td>" . htmlspecialchars($row['particular']) . "</td>";
            echo "<td>₱ " . number_format($row['amount'], 2) . "</td>";
            echo "<td>";
            if(!empty($row['receipt'])) {
                echo "<a href='../../uploads/liquidation_expenses/".htmlspecialchars($row['receipt'])."' target='_blank'>View</a>";
            } else {
                echo "N/A";
            }
            echo "</td>";
            echo "</tr>";
            $count++;
        }
        ?>
    </tbody>
</table>

<h3>Summary</h3>
<ul>
    <li>Total Expenses: ₱ <?php echo number_format($liq_info['total_expenses'], 2); ?></li>
    <li>Audit Result: <?php echo htmlspecialchars($liq_info['audit_result']); ?></li>
    <li>Remaining Budget: ₱ <?php echo number_format($liq_info['remaning_budget'], 2); ?></li>
    <li>Remarks: <?php echo htmlspecialchars($liq_info['remarks']); ?></li>
</ul>


<?php
// Check if a financial summary already exists for this project
$check_file_sql = "SELECT id FROM financial_summary WHERE project_id = $id LIMIT 1";
$check_file_result = mysqli_query($conn, $check_file_sql);
$already_uploaded = mysqli_num_rows($check_file_result) > 0;
?>

<?php if (!$already_uploaded): ?>
<form action="" method="POST" enctype="multipart/form-data">
    <label for="">Upload Receipt</label>
    <br>
    <input type="file" name="upload_receipt" id="">
    <br>
    <input type="submit" name="upload" value="Upload">
    <input type="hidden" name="project_id" value="<?php echo $id?>">
</form>
<?php else: ?>
<p style="color:green;">You have already uploaded the financial summary for this project.</p>
<?php endif; ?>



</body>
</html>

<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$upload_dir = __DIR__ . '/../../uploads/financial_summary/';

if(isset($_POST['upload'])){
    $project_id = intval($_POST['project_id'] ?? 0);

    if($project_id <= 0){
        die("Invalid project ID.");
    }

    if(isset($_FILES['upload_receipt']) && $_FILES['upload_receipt']['error'] === 0){
        $tmp_name = $_FILES['upload_receipt']['tmp_name'];
        $original_name = $_FILES['upload_receipt']['name'];
        $safe_name = time() . '_' . preg_replace("/[^a-zA-Z0-9_.-]/", "_", $original_name);
        $target_file = $upload_dir . $safe_name;

        if(!move_uploaded_file($tmp_name, $target_file)){
            die("Failed to move uploaded file. Check folder permissions.");
        }

        $file_content = addslashes(file_get_contents($target_file));

        $sql = "INSERT INTO financial_summary (project_id, file, created_by, has_validated, date_created)
                VALUES ('$project_id', '$file_content', '$user_id',0, NOW())";

        if(mysqli_query($conn, $sql)){
            echo "<script>window.location.href = '' </script> ";
        } else {
            die("Database error: " . mysqli_error($conn));
        }
    } else {
        echo "<p style='color:red;'>No file uploaded or upload error.</p>";
    }
}
?>