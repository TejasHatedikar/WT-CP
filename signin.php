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

// Get values from POST request
$prn = $_POST['prn'];
$password_input = $_POST['password'];

// Prepare and bind
$stmt = $conn->prepare("SELECT password FROM signup WHERE prn=?");
$stmt->bind_param("s", $prn);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($hashed_password);

if ($stmt->fetch()) {
    // Verify the password
    if (password_verify($password_input, $hashed_password)) {
        // Successful login - redirect to main page
        header("Location: CP.HTML");
        exit();
    } else {
        echo "Invalid PRN or Password.";
    }
} else {
    echo "Invalid PRN or Password.";
}

$stmt->close();
$conn->close();
?>  