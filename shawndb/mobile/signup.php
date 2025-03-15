<?php
header("Content-Type: application/json");
require_once 'db.php';

// Read JSON Input
$input = json_decode(file_get_contents("php://input"), true);

if (!$input) {
    echo json_encode(["success" => false, "message" => "Invalid JSON input"]);
    exit;
}

// Extract fields
$fullname = isset($input['fullname']) ? trim($input['fullname']) : null;
$student_number = isset($input['student_number']) ? trim($input['student_number']) : null;
$department = isset($input['department']) ? trim($input['department']) : null;
$program = isset($input['program']) ? trim($input['program']) : null;
$email = isset($input['email']) ? trim($input['email']) : null;
$password = isset($input['password']) ? trim($input['password']) : null;
$confirm_password = isset($input['confirm_password']) ? trim($input['confirm_password']) : null;

// Validate input
if (!$fullname || !$student_number || !$department || !$program || !$email || !$password || !$confirm_password) {
    echo json_encode(["success" => false, "message" => "All fields are required"]);
    exit;
}

// ✅ Email validation: Only allow @phinmaed.com
if (!preg_match('/@phinmaed\.com$/', $email)) {
    echo json_encode(["success" => false, "message" => "Only @phinmaed.com emails are allowed"]);
    exit;
}

// ✅ Password validation: Only lowercase letters and numbers
if (!preg_match('/^[a-z0-9]+$/', $password)) {
    echo json_encode(["success" => false, "message" => "Password can only contain lowercase letters and numbers"]);
    exit;
}

// ✅ Minimum password length
if (strlen($password) < 8) {
    echo json_encode(["success" => false, "message" => "Password must be at least 8 characters long"]);
    exit;
}

// Check password match
if ($password !== $confirm_password) {
    echo json_encode(["success" => false, "message" => "Passwords do not match"]);
    exit;
}

// Hash password
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

// Connect to database
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Database connection failed", "error" => $conn->connect_error]);
    exit;
}

// Check if email exists
$stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo json_encode(["success" => false, "message" => "Email already taken"]);
    $stmt->close();
    $conn->close();
    exit;
}
$stmt->close();

// Insert user into database
$stmt = $conn->prepare("INSERT INTO users (fullname, student_number, department, program, email, password) VALUES (?, ?, ?, ?, ?, ?)");
if (!$stmt) {
    echo json_encode(["success" => false, "message" => "SQL Prepare failed", "error" => $conn->error]);
    exit;
}
$stmt->bind_param("ssssss", $fullname, $student_number, $department, $program, $email, $hashed_password);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Signup successful"]);
} else {
    echo json_encode(["success" => false, "message" => "Signup failed", "error" => $stmt->error]);
}

// Close connections
$stmt->close();
$conn->close();
?>
