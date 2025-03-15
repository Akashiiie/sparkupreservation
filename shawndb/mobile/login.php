<?php
header("Content-Type: application/json; charset=UTF-8");
error_reporting(0);
require_once 'db.php';

// Check if the request is JSON or form-data
$input = json_decode(file_get_contents("php://input"), true);
if (!$input) {
    $email = isset($_POST['email']) ? trim($_POST['email']) : null;
    $password = isset($_POST['password']) ? trim($_POST['password']) : null;
} else {
    $email = isset($input['email']) ? trim($input['email']) : null;
    $password = isset($input['password']) ? trim($input['password']) : null;
}

// Validate inputs
if (empty($email) || empty($password)) {
    echo json_encode(["success" => false, "message" => "All fields are required"]);
    exit;
}

// Database connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Database connection failed"]));
}

// Check if user exists
$stmt = $conn->prepare("SELECT id, fullname, email, password FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    if (password_verify($password, $row['password'])) {
        echo json_encode([
            "success" => true,
            "message" => "Login successful",
            "user" => [
                "id" => $row['id'],
                "fullname" => $row['fullname'],
                "email" => $row['email']
            ]
        ]);
    } else {
        echo json_encode(["success" => false, "message" => "Invalid credentials"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "User not found"]);
}

$stmt->close();
$conn->close();
?>
