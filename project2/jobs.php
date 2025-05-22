<!-- 
============================================================
  File Name: jobs.html
  Description: [Brief description of the file's purpose and functionality]
  Author: The Optional Group
  Page Manager: Giuliano Zuccara
  Created On: 3/28/2025
  Last Updated: 3/28/2025
  Version: 0.0.1
  ============================================================
  Project: Project Part 1
  Dependencies: styles.css
  Changelog:
    - Latest Chnage: [Date]: [Change description]
    - What needs to be done: [Date]: [Change description]

============================================================
-->

<?php
session_start();

// If the user is NOT logged in, send them to signup
if (!isset($_SESSION['username'])) {
   header("Location: login.php");
    exit;
}
?>

<?php
session_start();
// Database settings
require_once 'settings.php';

// Connect to database
$conn = new mysqli($host, $user, $pwd, $sql_db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch job listings
$sql = "SELECT * FROM Jobs";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="The Optional Group">
    <meta name="author" content="">
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="shortcut icon" href="images/OptionalGroup_Tab_Icon.png">
    <title>The Optional Group</title>
</head>

<body>
    <?php include('header.inc'); ?>

    <main id="jobs_main">
        <h1>Find your <span class="text_gradient">Dream Job</span></h1>

        <section>
            <div class="row">
                <div class="column">
                    <h3>The Optional Group Description:</h3>
                    <p>The Optional Group is a forward-thinking technology company dedicated to bridging the digital divide
                        by setting up advanced, sustainable networks for remote communities and off-grid locations. We
                        combine cutting-edge technology with eco-friendly practices to empower underserved areas with
                        reliable, high-speed internet access. Our mission is to enable these communities to thrive through
                        innovation—while minimizing environmental impact.</p>
                </div>
                <aside class="column green_section">
                    <h3>How to Apply?</h3>
                    <p>Remember the job's reference number, then click the button below</p>
                    <a href="apply.php" id="apply_button" class="button">Apply Now!</a>
                </aside>
            </div>
        </section>

        <section>
            <!-- 
  Used AI to generate the styled boxes that separate each job description.
  The prompt was based on enhancing the original echo code to match the updated layout.
  Each job section now appears in a distinct, cleanly styled container box. also used AI to fix
  comments since theyw ere not working properly and borke the code.
-->
            <h1>Available Job Positions</h1>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div style='border: 2px solid #4CAF50; background-color: #eafbea; padding: 20px; margin-bottom: 30px; border-radius: 12px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);'>";
                    
                    echo "<h2 style='color:rgb(3, 3, 3); margin-bottom: 20px;'>" . htmlspecialchars($row['Name of position']) . "</h2>";

                    echo "<div style='background-color: #fff; border: 1px solid #ccc; padding: 15px; border-radius: 8px; margin-bottom: 12px;'>
                            <strong>Summary:</strong><br>" . nl2br(htmlspecialchars($row['Summary'])) . "
                          </div>";

                    echo "<div style='background-color: #fff; border: 1px solid #ccc; padding: 15px; border-radius: 8px; margin-bottom: 12px;'>
                            <strong>Essential Qualification:</strong><br>" . nl2br(htmlspecialchars($row['Essential Qualification'])) . "
                          </div>";

                    echo "<div style='background-color: #fff; border: 1px solid #ccc; padding: 15px; border-radius: 8px; margin-bottom: 12px;'>
                            <strong>Preferred Qualifications:</strong><br>" . nl2br(htmlspecialchars($row['Preferred Qualifications'])) . "
                          </div>";

                    echo "<div style='background-color: #fff; border: 1px solid #ccc; padding: 15px; border-radius: 8px; margin-bottom: 12px;'>
                            <strong>Salary & Benefits:</strong><br>" . nl2br(htmlspecialchars($row['Salary range/benefit'])) . "
                          </div>";

                    echo "<div style='background-color: #fff; border: 1px solid #ccc; padding: 15px; border-radius: 8px; margin-bottom: 12px;'>
                            <strong>Reports To:</strong><br>" . nl2br(htmlspecialchars($row['Title to report to'])) . "
                          </div>";

                    echo "<div style='background-color: #fff; border: 1px solid #ccc; padding: 15px; border-radius: 8px;'>
                            <strong>Job Reference:</strong> " . htmlspecialchars($row['Job reference number']) . "
                          </div>";

                    echo "</div>";
                }
            } else {
                echo "<p>No job listings found.</p>";
            }
            ?>
        </section>
    </main>

    <?php include('footer.inc'); ?>
</body>

</html>
