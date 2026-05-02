<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';
header('Content-Type: application/json');

$tables = [
    "homeowner_fees",
    "court_fees",
    "stall_renter_fees",
    "toda_fees"
];

$totalCollected = 0;

foreach ($tables as $table) {
    $sql = "SELECT COALESCE(SUM(amount_paid), 0) AS total 
            FROM $table 
            WHERE status = 1 AND is_remitted = 0 AND date_created >= DATE_FORMAT(CURDATE(), '%Y-%m-01 00:00:00')
AND date_created <= NOW()";
    
    $result = $conn->query($sql);
    if($result) {
        $row = $result->fetch_assoc();
        $totalCollected += (float)$row['total'];
    }
}

echo json_encode([
    "success" => true,
    "data" => [
        [
            "total" => $totalCollected
        ]
    ]
]);

$conn->close();
