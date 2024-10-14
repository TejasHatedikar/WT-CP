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

// Fetch projects from the database
$sql = "SELECT id, group_number, title, description, domain, guide, tags, final_report, working_model, presentation, research_paper FROM projects"; // Update the SQL query
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Overview</title>
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
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Navigation Bar */
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
            color: #1abc9c; /* Hover color */
        }

        /* Search Bar Styles */
        .search-bar {
            float: right; /* Align search bar to the right */
        }

        .search-bar input[type=text] {
            padding: 6px; /* Padding inside the input */
            border: 1px solid #ccc; /* Border for the input field */
            border-radius: 4px; /* Rounded corners for the input */
            font-size: 16px; /* Font size for the input text */
        }

        .search-bar button {
            padding: 6px 10px; /* Padding inside the button */
            background-color: #1abc9c; /* Button background color */
            color: white; /* Button text color */
            border: none; /* Remove border */
            border-radius: 4px; /* Rounded corners for the button */
            cursor: pointer; /* Pointer cursor on hover */
        }

        .search-bar button:hover {
            background-color: #16a085; /* Darker shade on hover */
        }

        /* Main Content Sections */
        section {
            padding: 40px 20px; /* Adjusted padding for sections */
            text-align: center;
            background-color: #fff; /* White background for sections */
            border-bottom: 1px solid #ddd; /* Light border between sections */
        }

        section h2 {
           font-size: 2em; /* Font size for section headings */
           margin-bottom: 15px; /* Space below headings */
           color: #34495e; /* Dark color for headings */
        }

        section p { 
           font-size: 1em; /* Font size for paragraph text */
           color: #7f8c8d; /* Lighter color for paragraph text */
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 1em;
            text-align: left;
        }

        table th, table td {
            padding: 12px;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #1abc9c;
            color: #ffffff;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .download-link {
            color: #1abc9c; /* Button-like green color for download links */
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .download-link:hover {
            color: #16a085; /* Darker shade on hover for links */
        }

        footer {
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 20px;
            text-align: center;
        }
    </style>
</head>
<body>

    <!-- Navigation Bar -->
    <nav>
      <div class="container">
          <div class="logo">
              <a href="CP.HTML">Major Project Management</a>
          </div>
          <!-- Search Bar -->
          <div class="search-bar">
              <form action="/search" method="get">
                  <input type="text" placeholder="Search..." name="query" required>
                  <button type="submit">Search</button>
              </form>
          </div>
          <ul class="nav-links">
              <li><a href="timelines.html">Timelines</a></li>
              <li><a href="domain.html">Domain</a></li>
              <li><a href="display_projects.php">Documentation</a></li>
              <li><a href="project.html">Project</a></li>
              <li><a href='groupmate.html'>Group Mate Details</a></li> <!-- Link back to form page -->
              <li><a href='display_data.php'>View Group Mates</a></li> <!-- Link to this page -->
          </ul>
      </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
      <section class="content">
          <h2>Project Overview</h2>
          <p>Details about various projects, including group number, project ID, titles, descriptions, guides, and tags.</p>

          <!-- Project Table -->
          <table>
              <thead>
                  <tr>
                      <th>Project ID</th>
                      <th>Group Number</th>
                      <th>Title</th>
                      <th>Description</th>
                      <th>Guide</th>
                      <th>Tags</th>
                      <th>Working Model</th> <!-- New column for Working Model -->
                  </tr>
              </thead>
              <tbody>
                  <?php if ($result->num_rows > 0): ?>
                      <?php while ($row = $result->fetch_assoc()): ?>
                          <tr>
                              <td>
                                  <a href="project_details.php?id=<?php echo htmlspecialchars($row['id']); ?>">
                                      <?php echo htmlspecialchars($row['id']); ?>
                                  </a>
                              </td>
                              <td><?php echo htmlspecialchars($row['group_number']); ?></td>
                              <td><?php echo htmlspecialchars($row['title']); ?></td>
                              <td><?php echo htmlspecialchars($row['description']); ?></td>
                              <td><?php echo htmlspecialchars($row['guide']); ?></td>
                              <td><?php echo htmlspecialchars($row['tags']); ?></td>
                              <td>
                                  <?php if (!empty($row['working_model'])): ?>
                                      <a href="<?php echo htmlspecialchars($row['working_model']); ?>" class="download-link" target="_blank">View Model</a>
                                  <?php else: ?>
                                      No Model Available
                                  <?php endif; ?>
                              </td>
                          </tr>
                      <?php endwhile; ?>
                  <?php else: ?>
                      <tr><td colspan="7">No projects found.</td></tr>
                  <?php endif; ?>
              </tbody>
          </table>
      </section>

      <!-- Footer -->
      <footer>
          &copy; <?php echo date("Y"); ?> Course Project Management. All rights reserved.
      </footer>

    </div> <!-- End of container -->

<?php
$conn->close();
?>
</body>
</html>
