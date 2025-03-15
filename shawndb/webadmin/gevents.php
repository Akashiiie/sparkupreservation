<?php
include "db.php"; // Ensure this connects to the database


header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *"); // Allow access from any client
header("Access-Control-Allow-Methods: GET");

// Fetch events from the database
$sql = "SELECT id, title, description, event_date, image FROM events ORDER BY event_date ASC";
$result = $conn->query($sql);

$events = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
    echo json_encode(["success" => true, "events" => $events]);
} else {
    echo json_encode(["success" => false, "message" => "No events found"]);
}

$conn->close();
?>
