<?php
session_start();
include('../../connection/connection.php'); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

</body>
</html>
