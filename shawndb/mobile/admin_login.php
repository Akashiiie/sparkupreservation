<?php
header("Content-Type: application/json");
require_once 'db.php';

// Read JSON Input
$input = json_decode(file_get_contents("php://input"), true);

$admin_id = isset($input['admin_id']) ? trim($input['admin_id']) : null;
$password = isset($input['password']) ? trim($input['password']) : null;

// Validate input
if (empty($admin_id) || empty($password)) {
    echo json_encode(["success" => false, "message" => "Admin ID and Password are required"]);
    exit;
}

// Connect to database
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Database connection failed"]);
    exit;
}

// Check if admin exists
$stmt = $conn->prepare("SELECT password FROM admin WHERE admin_id = ?");
$stmt->bind_param("s", $admin_id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    if (password_verify($password, $row['password'])) {
        echo json_encode(["success" => true, "message" => "Admin login successful"]);
    } else {
        echo json_encode(["success" => false, "message" => "Invalid credentials"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Admin not found"]);
}

$stmt->close();
$conn->close();
?>
