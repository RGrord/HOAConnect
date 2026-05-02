<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

$required = ['id', 'amount_paid', 'due_date'];
foreach ($required as $field) {
    if (!isset($_POST[$field]) || trim($_POST[$field]) === '') {
        echo json_encode(['success' => false, 'message' => ucfirst(str_replace('_', ' ', $field)) . ' is required.']);
        exit;
    }
}

$toda_id     = (int)$_POST['id'];
$amount_paid = (float)$_POST['amount_paid'];
$due_date    = trim($_POST['due_date']);

if ($toda_id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid TODA ID.']);
    exit;
}
if ($amount_paid <= 0) {
    echo json_encode(['success' => false, 'message' => 'Amount must be greater than zero.']);
    exit;
}
if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $due_date)) {
    echo json_encode(['success' => false, 'message' => 'Invalid date format. Use YYYY-MM-DD.']);
    exit;
}

$dueDateObj   = new DateTime($due_date);
$today        = new DateTime();
$currentMonth = $today->format('Y-m');
$nextMonth    = (clone $today)->add(new DateInterval('P1M'))->format('Y-m');
$dueMonth     = $dueDateObj->format('Y-m');

if ($dueMonth !== $currentMonth && $dueMonth !== $nextMonth) {
    echo json_encode([
        'success' => false,
        'message' => 'Due date must be this month or next month only.'
    ]);
    exit;
}

try {
    $stmt = $conn->prepare("SELECT id FROM toda WHERE id = ?");
    $stmt->bind_param("i", $toda_id);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows === 0) {
        $stmt->close();
        echo json_encode(['success' => false, 'message' => 'TODA not found.']);
        exit;
    }
    $stmt->close();

    $checkPaid = $conn->prepare("
        SELECT id 
        FROM toda_fees 
        WHERE toda_id = ? 
          AND DATE_FORMAT(due_date, '%Y-%m') = ? 
          AND status = 1 
        LIMIT 1
    ");
    $yearMonth = $dueDateObj->format('Y-m');
    $checkPaid->bind_param("is", $toda_id, $yearMonth);
    $checkPaid->execute();
    $checkPaid->store_result();

    if ($checkPaid->num_rows > 0) {
        $checkPaid->close();
        echo json_encode([
            'success' => false,
            'message' => 'Already paid for ' . $dueDateObj->format('F Y') . '. No duplicate payments allowed!'
        ]);
        exit;
    }
    $checkPaid->close();

    $insert = $conn->prepare("
        INSERT INTO toda_fees 
        (toda_id, amount_paid, status, due_date, date_created) 
        VALUES (?, ?, 1, ?, NOW())
    ");
    $insert->bind_param("ids", $toda_id, $amount_paid, $due_date);

    if ($insert->execute()) {
        echo json_encode([
            'success' => true,
            'message' => 'Payment recorded for ' . $dueDateObj->format('F Y') . '!'
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to save payment.']);
    }
    $insert->close();

} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}

$conn->close();
?>