<?php 
function assignMonthlyFeesToUser($conn, $user_id) {
    $due_date = date('Y-m-01', strtotime('+1 month'));

    $query = "SELECT id, fee_name, amount 
              FROM fee_type 
              WHERE `status` = 1 AND is_recurring = 1";

    $result = $conn->query($query);
    if ($result->num_rows === 0) return true;

    $stmt = $conn->prepare("
        INSERT INTO fee_assignments
        (user_id, fee_type_id, amount, status, due_date, date_created)
        VALUES (?, ?, ?, ?, ?, NOW())
    ");

    while ($fee = $result->fetch_assoc()) {
        // MUST create real variables so PHP can bind by reference
        $fee_id    = (int)$fee['id'];
        $amount    = (float)$fee['amount'];
        $status    = 0;

        $stmt->bind_param(
            "sidis",
            $user_id,
            $fee_id,
            $amount,
            $status,
            $due_date
        );

        $stmt->execute();
    }

    $stmt->close();
    $result->free();
    return true;
}
