<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/';
require_once $root . 'config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';

if (!isset($_GET['id'])) {
    echo "<script>alert('Invalid request.'); window.location.href='list.php';</script>";
    exit;
}

$feeId = intval($_GET['id']);
$conn->autocommit(false);
$conn->begin_transaction();

try {
    $approveSql = "UPDATE fee_type 
                   SET `status` = 1 
                   WHERE id = ? 
                     AND `status` = 0";
    $stmt = $conn->prepare($approveSql);
    $stmt->bind_param("i", $feeId);
    $stmt->execute();
    $stmt->close();

    if ($conn->affected_rows === 0) {
        throw new Exception("Fee type already approved or not found.");
    }

    $feeSql = "SELECT fee_name, amount, is_recurring 
               FROM fee_type 
               WHERE id = ? 
                 AND status = 1";
    $stmt = $conn->prepare($feeSql);
    $stmt->bind_param("i", $feeId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        throw new Exception("Approved fee not found.");
    }

    $fee = $result->fetch_assoc();
    $feeAmount     = $fee['amount'];
    $isRecurring   = (int)$fee['is_recurring'];
    $feeName       = $fee['fee_name'];
    $stmt->close();

    if ($isRecurring !== 1) {
        $conn->commit();
        echo "<script>
                alert('Fee type \"{$feeName}\" approved successfully! (Non-recurring - not assigned to members)');
                window.location.href='list.php';
              </script>";
        exit;
    }

    $usersResult = $conn->query("SELECT user_id FROM users WHERE role_id = 6");
    
    if ($usersResult->num_rows === 0) {
        $conn->commit();
        echo "<script>
                alert('Fee type approved but no TODA members found to assegn.');
                window.location.href='list.php';
              </script>";
        exit;
    }

    $insertSql = "INSERT INTO fee_assignments 
                  (user_id, fee_type_id, amount, due_date, status, date_created) 
                  VALUES (?, ?, ?, DATE_FORMAT(NOW() + INTERVAL 1 MONTH, '%Y-%m-01'), 0, NOW())";

    $insertStmt = $conn->prepare($insertSql);
    $assignedCount = 0;

    while ($user = $usersResult->fetch_assoc()) {
        $userId = $user['user_id'];
        $insertStmt->bind_param("iid", $userId, $feeId, $feeAmount);
        
        if ($insertStmt->execute()) {
            $assignedCount++;
        }
    }
    $insertStmt->close();

    $conn->commit();

    echo "<script>
            alert('Success! \"{$feeName}\" approved and assigned to {$assignedCount} TODA members.\\nDue: " . date('F Y', strtotime('+1 month')) . "');
            window.location.href='list.php';
          </script>";

} catch (Exception $e) {
    $conn->rollback();
    echo "<script>
            alert('Error: " . addslashes($e->getMessage()) . "');
            window.location.href='list.php';
          </script>";
}

$conn->autocommit(true);
$conn->close();
exit;
?>