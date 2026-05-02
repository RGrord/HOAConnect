<?php
header('Content-Type: application/json');
include('../connection/connection.php');

// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (!$conn) {
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}

// Replace 'events_table' with your table name
$sql = "SELECT id, title, start_date, end_date, description FROM events ORDER BY start_date ASC";
$result = mysqli_query($conn, $sql);

if (!$result) {
    echo json_encode(['error' => mysqli_error($conn)]);
    exit;
}

$events = [];

while ($row = mysqli_fetch_assoc($result)) {
    $start = $row['start_date'];
    $end = $row['end_date'];

    if ($end) {
        $end = date('Y-m-d', strtotime($end . ' +1 day'));
    }

    $events[] = [
        'id' => $row['id'],
        'title' => $row['title'],
        'start' => $start,
        'end' => $end,
        'description' => $row['description'],
        'allDay' => true
    ];
}

echo json_encode($events);
?>
