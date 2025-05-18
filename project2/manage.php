<!DOCTYPE html> <!-- derfines program langauge file as html-->
<html lang="en"> <!-- defines actual language as English 'en' -->
<head>
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
    
	<?php include_once 'header.inc'; ?>
    
    <main> 

        <?php 

            $fileName = 'optional_group_db.sql';
            $fileExists = file_exists($fileName);
            if (!$fileExists) {
                echo "<p>Error: Database cannot be found. Please try again later. Sorry for the inconvenience!</p>";
            } else { 
        ?>
        <h1>Manager Profile</h1>
        <br><br>
        <form method="post" action="">
            <section>
                <label for="JobReference">EOI: Job Reference Number</label>
                <br>
                <input type="text" name="EOI_reference" required maxlength="20">
                <input  type="submit" name="search" value="Search">
                <input  type="submit" name="delete" value="Delete EOI References">
            </section>
        </form>
        <input type="submit" value="Search All">
        <br> <br>
        <form method="post" action="">
            <section>
                <label for="ApplicantSurname">Find Applicant (Surname)</label>
                <br>
                <input type="text" name="Applicant" id="Applicant" required maxlength="20">
                <input type="submit" value="Find Applicant">
            </section>
        </form>
        <?php 
            } 
        ?>    

        <?php 
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['EOI_reference']) && !empty(trim($_POST['EOI_reference']))) {
                if (isset($_POST['search'])) { 
                    //content
                } elseif (isset($_POST['delete'])) { 
                //cotent
                } //if nothing then don't react
            }
        ?>
        <br> <br>
        <section id="results"> 
            <h2>Query Results:</h2>
            <br> 
        </section> 

    </main>
	
        <?php include_once 'footer.inc'; ?>

</body>
</html>