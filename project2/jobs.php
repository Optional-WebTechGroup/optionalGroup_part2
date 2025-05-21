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


<!DOCTYPE html>
<html lang="en">

<head> <!-- Adds web browser support meta tags for format and search algorithm-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="The Optional Group">
    <meta name="author" content="">
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="shortcut icon" href="images/OptionalGroup_Tab_Icon.png">
    <!-- ChatGPT GenAI Image Prompt: Create an image for a company logo for It company called The Optional Group. It’s a company which supplies remote it support and environmental impact. The group colours are blues, greens, and shades-->
    <title>The Optional Group</title>
</head>

<body>
    <?php include('header.inc') ?>

    <main id="jobs_main">
        <h1>Find your <span class="text_gradient">Dream Job</span></h1>
        <section>
            <div class="row">
                <div class="column">
                    <h3>The Optional Group Description:</h3>
                    <p>The Optional Group is a forward-thinking technology company dedicated to bridging the digital
                        divide
                        by
                        setting up advanced, sustainable networks for remote communities and off-grid locations. By
                        combining
                        cutting-edge technology with green, eco-friendly practices, we empower underserved areas with
                        reliable,
                        high-speed internet access and smart solutions that promote environmental sustainability. Our
                        mission
                        is to create interconnected, self-sufficient ecosystems that enable remote communities to thrive
                        through
                        innovation, while minimising environmental impact. At The Optional Group, we believe technology
                        should
                        enhance the quality of life without compromising the planet.</p>
                </div>
                <aside class="column green_section">
                    <h3>How to Apply?</h3>
                    <p>Remember the job's reference number, then click the button below</p>
                    <a href="apply.php" id="apply_button" class="button">Apply Now!</a>
                </aside>
            </div>
            <!-- used ai to create job description, the prompt was used ai to create description, prompot was create a company description for this company The Optional Group, this is the brief description setting up networks for remote communties and places with like advanced technology and green impact and things-->
        </section>

        <br>

<?php

// Database connection

$host = "localhost";
$user = "root";
$password = "";
$database = "optional_group_db";

$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query jobs
$sql = "SELECT * FROM `Jobs`";
$result = $conn->query($sql);

echo "<h1>Available Job Positions</h1>";

 
     $query = "SELECT * FROM jobs";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_row($result)) {
    // $row is a numeric array
    echo "<div style='border:1px solid #ccc; padding:15px; margin-bottom:20px;'>";
    echo "<p><strong>Job Reference:</strong> " . htmlspecialchars($row[0]) . "</p>";
    echo "<h2>" . htmlspecialchars($row[1]) . "</h2>";
    echo "<p><strong>Summary:</strong><br>" . nl2br(htmlspecialchars($row[2])) . "</p>";
    echo "<p><strong>Essential Qualification:</strong><br>" . nl2br(htmlspecialchars($row[3])) . "</p>";
    echo "<p><strong>Preferred Qualifications:</strong><br>" . nl2br(htmlspecialchars($row[4])) . "</p>";
    echo "<p><strong>Salary & Benefits:</strong><br>" . nl2br(htmlspecialchars($row[5])) . "</p>";
    echo "<p><strong>Reports To:</strong><br>" . nl2br(htmlspecialchars($row[6])) . "</p>";
}

       { echo "</div>";
       }

$conn->close();
?>

    </main>
    
    <?php include('footer.inc') ?>
</body>

</html>