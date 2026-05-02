<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['user_id'], $_POST['fees'])) {
    die("Invalid request.");
}

$user_id = intval($_POST['user_id']);
$fee_type_ids = array_map('intval', $_POST['fees']);

if (empty($fee_type_ids)) {
    header("Location: assign.php?id=$user_id&msg=none_selected");
    exit;
}

$due_date = date('Y-m-d', strtotime('first day of next month'));

$placeholders = str_repeat('?,', count($fee_type_ids) - 1) . '?';
$sql = "SELECT id, amount, fee_name FROM fee_type WHERE id IN ($placeholders)";
$stmt = $conn->prepare($sql);
$stmt->bind_param(str_repeat('i', count($fee_type_ids)), ...$fee_type_ids);
$stmt->execute();
$result = $stmt->get_result();

$inserted = 0;
$skipped = 0;

while ($fee = $result->fetch_assoc()) {
    $fee_type_id = $fee['id'];
    $amount = $fee['amount'];

    $check = $conn->prepare("
        SELECT id FROM fee_assignments 
        WHERE user_id = ? 
          AND fee_type_id = ? 
          AND due_date = ? 
          AND status = 0
    ");
    $check->bind_param("iis", $user_id, $fee_type_id, $due_date);
    $check->execute();
    $exists = $check->get_result()->num_rows > 0;

    if ($exists) {
        $skipped++;
        continue;
    }

    $insert = $conn->prepare("
        INSERT INTO fee_assignments 
        (user_id, fee_type_id, amount, due_date, status, date_created) 
        VALUES (?, ?, ?, ?, 0, NOW())
    ");
    $insert->bind_param("iids", $user_id, $fee_type_id, $amount, $due_date);

    if ($insert->execute()) {
        $inserted++;
    } else {
        error_log("Insert failed for user $user_id, fee $fee_type_id: " . $insert->error);
    }
}

$redirect = "assign.php?id=$user_id&success=$inserted";
if ($skipped > 0) {
    $redirect .= "&skipped=$skipped";
}
echo "<script> alert('Fee/s assigned!') </script>";
header("Location: $redirect");
exit;
?>