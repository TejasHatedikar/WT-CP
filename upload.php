<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "TEJAS@123";
$dbname = "course_project_management";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle file uploads and form data
$title = $conn->real_escape_string($_POST['title']);
$description = $conn->real_escape_string($_POST['description']);
$groupNumber = $conn->real_escape_string($_POST['groupNumber']);
$domain = $conn->real_escape_string($_POST['domain']);
$tags = $conn->real_escape_string($_POST['tags']);
$guide = $conn->real_escape_string($_POST['guide']);

$uploads_dir = 'uploads/'; // Directory where files will be stored
$researchPaper = $_FILES['researchPaper']['name'];
$presentation = $_FILES['presentation']['name'];
$workingModel = $_FILES['workingModel']['name'];
$finalReport = $_FILES['finalReport']['name'];

// Move uploaded files to desired folder
move_uploaded_file($_FILES['researchPaper']['tmp_name'], $uploads_dir . $researchPaper);
move_uploaded_file($_FILES['presentation']['tmp_name'], $uploads_dir . $presentation);
move_uploaded_file($_FILES['workingModel']['tmp_name'], $uploads_dir . $workingModel);
move_uploaded_file($_FILES['finalReport']['tmp_name'], $uploads_dir . $finalReport);

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO projects (title, description, group_number, domain, tags, guide, research_paper, presentation, working_model, final_report) 
                         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssssss", $title, $description, $groupNumber, $domain, $tags, $guide, $researchPaper, $presentation, $workingModel, $finalReport);

// Execute the statement
if ($stmt->execute()) {
    // Redirect to display_projects.php after successful upload
    echo("Location: display_projects.php");
    exit(); // Ensure no further code is executed after the redirect
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
