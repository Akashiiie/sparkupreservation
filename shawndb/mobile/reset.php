<?php
// Database credentials
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "droid_test";

// Connect to MySQL (without selecting a database)
$conn = new mysqli($host, $user, $pass);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Drop and recreate the database
$sql = "DROP DATABASE IF EXISTS $dbname; CREATE DATABASE $dbname;";
if ($conn->multi_query($sql)) {
    echo "Database reset successfully.\n";
} else {
    die("Error resetting database: " . $conn->error);
}

// Close connection before reconnecting
$conn->close();

// Reconnect to the newly created database
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the users table with updated fields
$sql = "CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(255) NOT NULL,
    student_number VARCHAR(20) NOT NULL,
    department VARCHAR(50) NOT NULL,
    program VARCHAR(50) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);";

if ($conn->query($sql) === TRUE) {
    echo "Users table created successfully.\n";
} else {
    die("Error creating table: " . $conn->error);
}

// Close connection
$conn->close();
echo "Database reset and tables recreated successfully.";
?>
