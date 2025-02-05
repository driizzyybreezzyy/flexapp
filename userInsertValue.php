<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Set response headers for JSON and CORS
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Read JSON input
$input = file_get_contents("php://input");
$data = json_decode($input, true);

// Check if data is valid
if (!isset($data['age']) || !isset($data['batch'])) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid input: Age and batch are required']);
    exit;
}

$age = intval($data['age']); // Ensure age is an integer
$batch = trim($data['batch']); // Remove any unnecessary spaces
$description = "You have been enrolled in the $batch batch. Please pay Rs. 500 for this month.";

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "flexapp";

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed: ' . $conn->connect_error]);
    exit;
}

// Prepare and execute SQL statement
$stmt = $conn->prepare("INSERT INTO users (age, batch, description) VALUES (?, ?, ?)");
$stmt->bind_param("iss", $age, $batch, $description);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Data inserted successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to insert data']);
}

// Close database connection
$stmt->close();
$conn->close();
?>
