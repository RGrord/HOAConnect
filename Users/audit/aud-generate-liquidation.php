<?php
session_start();
include('../../connection/connection.php'); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$user_id = $_SESSION['user_id'] ?? '';

// Get project resolution details
if(isset($_GET['id'])){
    $id = intval($_GET['id']);
    $sql_project = "SELECT id, project_resolution_title, estimated_budget FROM resolution WHERE id='$id'";
    $run_project = mysqli_query($conn, $sql_project);
    $project = mysqli_fetch_assoc($run_project);
}

// Handle form submission
if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $project_id = intval($_POST['project_id']);
    $remarks = mysqli_real_escape_string($conn, $_POST['remarks']);

    $total_expenses = isset($_POST['total_expenses']) && $_POST['total_expenses'] !== '' ? floatval($_POST['total_expenses']) : 0;
    $remaining_budget = isset($_POST['remaining_budget']) && $_POST['remaining_budget'] !== '' ? floatval($_POST['remaining_budget']) : 0;
    $audit_result = isset($_POST['audit_result']) ? mysqli_real_escape_string($conn, $_POST['audit_result']) : '';

    // Upload folder (must exist and be writable)
    $upload_dir = $_SERVER['DOCUMENT_ROOT'].'/hoa_system/uploads/liquidation_expenses/';
    if(!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    // Insert into liquidation_of_expenses
    $insert_liq = "INSERT INTO liquidation_of_expenses (project_resolution_id, status, total_expenses, date_created, date_updated) 
                   VALUES ('$project_id', 1, '$total_expenses', NOW(), NOW())";

    if(mysqli_query($conn, $insert_liq)) {
        $liq_id = mysqli_insert_id($conn);

        // Loop through each expense row
        if(isset($_POST['expense_particular']) && count($_POST['expense_particular']) > 0){
            for($i=0; $i<count($_POST['expense_particular']); $i++){
                $particular = mysqli_real_escape_string($conn, $_POST['expense_particular'][$i]);
                $amount = floatval($_POST['expense_amount'][$i]);
                $receipt_file = '';

                // Handle receipt upload
                if(isset($_FILES['expense_receipt']['name'][$i]) && $_FILES['expense_receipt']['error'][$i] === 0){
                    $tmp_name = $_FILES['expense_receipt']['tmp_name'][$i];
                    $filename = time().'_'.preg_replace("/[^a-zA-Z0-9_.-]/", "_", $_FILES['expense_receipt']['name'][$i]);
                    $target_file = $upload_dir.$filename;
                    if(move_uploaded_file($tmp_name, $target_file)){
                        $receipt_file = $filename;
                    }
                }

                // Insert into liquidation_expenses_details
                $insert_exp = "INSERT INTO liquidation_expenses_details 
                               (liquidation_id, particular, amount, receipt, total_expenses, remaning_budget, audit_result, remarks, date_created, date_updated)
                               VALUES ('$liq_id', '$particular','$amount', '$receipt_file', '$total_expenses', '$remaining_budget', '$audit_result', '$remarks', NOW(), NOW())";

                mysqli_query($conn, $insert_exp);
            }
        }

        echo "<p style='color:green;'>Liquidation saved successfully!</p>";
    } else {
        echo "<p style='color:red;'>Error: ".mysqli_error($conn)."</p>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Generate Expense Liquidation</title>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style>
input[type=text], input[type=number], input[type=file] { margin-bottom:5px; }
table { border-collapse: collapse; width: 100%; margin-bottom: 10px;}
table th, table td { border: 1px solid #ccc; padding:5px; text-align:left; }
button { padding:5px 10px; margin-top:5px;}
</style>
</head>
<body>

<h1>Generate Expense Liquidation</h1>

<form method="POST" enctype="multipart/form-data">
    <input type="hidden" name="project_id" value="<?php echo $project['id']; ?>">
    <label>Project Resolution:</label>
    <input type="text" value="<?php echo $project['project_resolution_title']; ?>" readonly><br>
    <label>Released Budget:</label>
    <input type="text" id="released_budget" value="<?php echo $project['estimated_budget']; ?>" readonly><br>

    <table id="expenses_table">
        <thead>
            <tr>
                <th>Particular</th>
                <th>Amount</th>
                <th>Receipt</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><input type="text" name="expense_particular[]"></td>
                <td><input type="number" step="0.01" class="expense_amount" name="expense_amount[]"></td>
                <td><input type="file" name="expense_receipt[]"></td>
                <td><button type="button" class="remove_row">Remove</button></td>
            </tr>
        </tbody>
    </table>
    <button type="button" id="add_row">Add Expense</button><br><br>

    <label>Total Expenses:</label>
    <input type="text" id="total_expenses" name="total_expenses" readonly><br>
    <label>Remaining Budget:</label>
    <input type="text" id="remaining_budget" name="remaining_budget" readonly><br>

    <label>Audit Result:</label>
    <input type="text" id="audit_result" name="audit_result" readonly><br>

    <label>Remarks:</label>
    <input type="text" name="remarks"><br><br>

    <input type="submit" value="Submit Liquidation">
</form>

<script>
function calculateTotals(){
    let total = 0;
    $('.expense_amount').each(function(){
        let val = parseFloat($(this).val()) || 0;
        total += val;
    });
    $('#total_expenses').val(total.toFixed(2));

    let released = parseFloat($('#released_budget').val()) || 0;
    let remaining = released - total;
    $('#remaining_budget').val(remaining.toFixed(2));

    if(total > released){
        $('#audit_result').val('Overspent');
    } else if(total < released){
        $('#audit_result').val('Underspent');
    } else {
        $('#audit_result').val('Balanced');
    }
}

$(document).ready(function(){
    $('#add_row').click(function(){
        let row = `<tr>
                    <td><input type="text" name="expense_particular[]"></td>
                    <td><input type="number" step="0.01" class="expense_amount" name="expense_amount[]"></td>
                    <td><input type="file" name="expense_receipt[]"></td>
                    <td><button type="button" class="remove_row">Remove</button></td>
                  </tr>`;
        $('#expenses_table tbody').append(row);
    });

    $(document).on('click', '.remove_row', function(){
        $(this).closest('tr').remove();
        calculateTotals();
    });

    $(document).on('input', '.expense_amount', function(){
        calculateTotals();
    });

    calculateTotals();
});
</script>

</body>
</html>
