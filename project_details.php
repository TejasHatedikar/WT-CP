<?php
// Database connection
$servername = "localhost"; // Change as needed
$username = "root"; // Change as needed
$password = "TEJAS@123"; // Change as needed
$dbname = "course_project_management"; // Change as needed

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get project ID from URL
$project_id = isset($_GET['id']) ? intval($_GET['id']) : 0;



if ($project_id > 0) {
    // Fetch project details based on ID
    $sql = "SELECT * FROM projects WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $project_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $project = $result->fetch_assoc();
    } else {
        echo "No project found with the given ID.";
        exit;
    }
} else {
    echo "Invalid project ID.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($project['title']); ?> - Project Details</title>
    <link rel="stylesheet" href="timelines.css"> <!-- Link to any additional CSS -->
    <style>
        /* Global Styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #f7f7f7;
            color: #333;
        }

        /* Container for Centering Content */
        .container {
            max-width: 900px;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h1 {
            font-size: 2.5em;
            color: #2c3e50;
            margin-bottom: 20px;
            text-align: center;
        }

        .project-info {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            background-color: #f9f9f9;
        }

        p {
            font-size: 1.1em;
            color: #555;
            margin-bottom: 15px;
        }

        .download-link {
            color: #1abc9c;
            text-decoration: none;
            font-weight: bold;
        }

        .download-link:hover {
            color: #16a085;
        }

        video {
            width: 100%;
            height: auto;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            color: #777;
        }

        /* Responsive Styles */
        @media (max-width: 600px) {
            h1 {
                font-size: 2em;
            }

            .container {
                padding: 15px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h1><?php echo htmlspecialchars($project['title']); ?></h1>

    <div class="project-info">
        <p><strong>Project ID:</strong> <?php echo htmlspecialchars($project['id']); ?></p>
        <p><strong>Group Number:</strong> <?php echo htmlspecialchars($project['group_number']); ?></p>
        <p><strong>Description:</strong> <?php echo htmlspecialchars($project['description']); ?></p>
        <p><strong>Guide:</strong> <?php echo htmlspecialchars($project['guide']); ?></p>
        <p><strong>Tags:</strong> <?php echo htmlspecialchars($project['tags']); ?></p>
    </div>

    <!-- Document Links Section -->
    <h3>Documents Related to the Project</h3>
    
    <?php if (!empty($project['research_paper'])): ?>
        <p><strong>Research Paper:</strong> <a href="<?php echo htmlspecialchars($project['research_paper']); ?>" class="download-link" target='uploads/'>Download</a></p>
    <?php endif; ?>

    <?php if (!empty($project['presentation'])): ?>
        <p><strong>Presentation (PPT):</strong> <a href="<?php echo htmlspecialchars($project['presentation']); ?>" class="download-link" target="_blank">Download</a></p>
    <?php endif; ?>

    <?php if (!empty($project['working_model'])): ?>
        <h3>Working Model (Video)</h3>
        <video controls>
            <source src="<?php echo htmlspecialchars($project['working_model']); ?>" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    <?php else: ?>
        <p>No working model video available.</p>
    <?php endif; ?>

    <?php if (!empty($project['final_report'])): ?>
        <p><strong>Final Report:</strong> <a href="<?php echo htmlspecialchars($project['final_report']); ?>" class="download-link" target="_blank">Download</a></p>
    <?php endif; ?>
</div>

<div class="footer">
    &copy; <?php echo date("Y"); ?> Course Project Management. All rights reserved.
</div>

<?php
$conn->close();
?>

</body>
</html>
