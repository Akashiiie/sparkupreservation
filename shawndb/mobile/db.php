<?php
define("DB_HOST", "localhost");  // Change if necessary
define("DB_USER", "root");       // Default user for XAMPP
define("DB_PASS", "");           // Default password is empty in XAMPP
define("DB_NAME", "droid_test"); // Ensure this matches your database name

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check for connection errors
if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Database connection failed: " . $conn->connect_error]));
}
?>
