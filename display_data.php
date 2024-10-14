<?php
// Database connection parameters
$servername = "localhost"; // Your server name
$username = "root"; // Your MySQL username
$password = "TEJAS@123"; // Your MySQL password
$dbname = "course_project_management"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to select data from group_mates table
$sql = "SELECT * FROM group_mates";
$result = $conn->query($sql);

// Start HTML output
echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Group Mates Data</title>
    <link rel='stylesheet' href='timelines.CSS'> <!-- Link to your existing CSS file -->
    <style>
        /* Global styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f7f7f7;
            color: #333;
            margin: 0;
            padding: 0;
        }

        /* Navigation bar */
        nav {
            background-color: #2c3e50;
            padding: 15px 0;
            text-align: center;
        }

        nav .logo a {
            color: #ecf0f1;
            font-size: 1.8em;
            font-weight: bold;
            text-decoration: none;
            margin-right: 30px;
        }

        nav .nav-links {
            list-style-type: none;
            display: inline-block;
            padding-left: 0;
        }

        nav .nav-links li {
            display: inline;
            margin: 0 15px;
        }

        nav .nav-links a {
            color: #ecf0f1;
            font-size: 1em;
            font-weight: bold;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        nav .nav-links a:hover {
            color: #1abc9c;
        }

        /* Main content section */
        section {
            padding: 40px 20px;
            text-align: center;
        }

        section h2 {
            font-size: 2em;
            margin-bottom: 15px;
            color: #34495e;
        }

        /* Table styling */
        table {
            width: 80%;
            margin: 0 auto; /* Center the table */
            border-collapse: collapse;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Adds a subtle shadow */
            background-color: #ffffff;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #1abc9c;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2; /* Alternating row color */
        }

        tr:hover {
            background-color: #f1f1f1; /* Row hover effect */
        }

        td {
            color: #333;
        }

        /* Footer styling */
        footer {
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 20px;
            text-align: center;
            margin-top: 30px;
        }
    </style>
</head>
<body>

<!-- Navigation Bar -->
<nav>
    <div class='container'>
        <div class='logo'>
            <a href='CP.HTML'>Major Project Management</a>
        </div>
        <!-- Search Bar -->
        <div class='search-bar'>
            <form action='/search' method='get'>
                <input type='text' placeholder='Search...' name='query' required>
                <button type='submit'>Search</button>
            </form>
        </div>
        <ul class='nav-links'>
            <li><a href='timelines.html'>Timelines</a></li>
            <li><a href='domain.html'>Domain</a></li>
            <li><a href='display_projects.php'>Documentation</a></li>
            <li><a href='project.html'>Project</a></li>
            <li><a href='groupmate.html'>Group Mate Details</a></li> <!-- Link back to form page -->
            <li><a href='display_data.php'>View Group Mates</a></li> <!-- Link to this page -->
        </ul>
    </div>
</nav>

<!-- Main Content Section -->
<section id='group-mate-data'>
    <h2>Group Mates Information</h2>
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Role</th>
        </tr>";

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row["name"]) . "</td>
                <td>" . htmlspecialchars($row["email"]) . "</td>
                <td>" . htmlspecialchars($row["phone"]) . "</td>
                <td>" . htmlspecialchars($row["role"]) . "</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='4'>No records found</td></tr>";
}

echo "</table>
</section>";

// Close connection
$conn->close();

echo "<footer>
    <p>&copy; 2024 Course Project Management. All rights reserved.</p>
</footer>

</body></html>";
?>
