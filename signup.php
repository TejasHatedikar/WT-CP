<?php
$servername = "localhost"; // Change if needed
$username = "root"; // Your MySQL username
$password = "TEJAS@123"; // Your MySQL password
$dbname = "course_project_management"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO signup (prn, password, role) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $prn, $hashed_password, $role);

// Get values from POST request
$prn = $_POST['prn'];
$password = $_POST['password'];
$role = $_POST['role'];

// Hash the password before storing it
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Execute the statement
if ($stmt->execute()) {
    echo "New record created successfully. Redirecting to sign in...";
    header("Location: signin.html");
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>