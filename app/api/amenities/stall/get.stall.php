<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/core/init.php';

$sql = "SELECT id, stall_no FROM stalls WHERE status = 1 ORDER BY stall_no DESC";
$result = mysqli_query($conn, $sql);

$stalls = [];
while ($row = mysqli_fetch_assoc($result)) {
    $stalls[] = $row;
}

json_success([
    'data' => $stalls
]);
?>
