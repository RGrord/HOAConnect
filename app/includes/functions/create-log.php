<?php

function log_activity($conn, $user_id, $action, $description = null) {
    $ip_address = $_SERVER['REMOTE_ADDR'] ?? null;

    $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? null;

    $sql = "INSERT INTO activity_logs (user_id, action, description, ip_address, user_agent) 
            VALUES (?, ?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param(
            $stmt,
            "issss",
            $user_id,
            $action,
            $description,
            $ip_address,
            $user_agent
        );

        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        return true;
    }

    return false;
}

?>
