<?php
// Database connection parameters
$servername = "localhost"; // Change if your server is different
$username = "root"; // Your MySQL username
$password = "TEJAS@123"; // Your MySQL password
$dbname = "course_project_management"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Use isset() to check if the keys exist in $_POST
    $name = isset($_POST['name']) ? $_POST['name'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $phone = isset($_POST['phone']) ? $_POST['phone'] : null;
    $role = isset($_POST['role']) ? $_POST['role'] : null;

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO group_mates (name, email, phone, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $phone, $role);

    // Execute and check for errors
    if ($stmt->execute()) {
        header("Location: display_data.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}


// Close connection
$conn->close();
?>