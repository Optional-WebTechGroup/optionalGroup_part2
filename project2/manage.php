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
            // ChatGPT support, Prompt: 'is this how to correctly link databse file?' 20/0/5/2025 - edited from response
            require_once 'settings.php';
            $conn = mysqli_connect($host,$username,$password,$database);

            if ($conn) {
                $query = "SELECT * FROM eoi";
                $result = mysqli_query($conn, $query); 
            } else {
                die("No connection to db");
            }
        ?>
        <h1>Manager Profile</h1>
        <br><br>    
        <form method="post" action="">
            <section id="jobRef">
                <label for="JobReference">EOI: Job Reference Number</label>
                <br>
                <input type="text" name="EOI_reference" required maxlength="20">
                <input  type="submit" name="search" value="Search">
                <input  type="submit" name="delete" value="Delete EOI References">
            </section>
        </form>
        <input type="submit" id="searchAll" value="Search All">
        <br> <br>
        <form method="post" action="">
            <section id="applicantSort">
                <label for="ApplicantSurname">Find Applicant (Surname)</label>
                <br>
                <input type="text" name="Applicant" id="Applicant" required maxlength="20">
                <input type="submit" value="Find Applicant">
            </section>
        </form>

        <?php 
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['EOI_reference']) && !empty(trim($_POST['EOI_reference']))) {
                //$eoi_reference = trim($_POST['EOI_reference'] ?? '');
                if (isset($_POST['search'])) { 
                    //if $eoi_reference is in database
                        //SELECT * FROM Jobs WHERE $eoi_reference;
                        //echo "<p>Found '$eoi_reference'</p>"
                    // if $eoi_reference not in database
                        // echo "<p>No data found for '$eoi_reference'</p>"
                } elseif (isset($_POST['delete'])) { 
                    //if $eoi_reference is in database
                        //DELETE * FROM Jobs WHERE $eoi_reference;
                        //echo "<p>Deleted all '$eoi_reference' EOIs</p>"
                    // if $eoi_reference not in database
                        // echo "<p>No data found for '$eoi_reference'</p>"
                } //if nothing then don't react
            }
        ?>
        <br> <br>
        <section id="results"> 
            <h2>Query Results:</h2>
            <br> 
            <p> No results currently </p> <!-- test content -->
        </section> 

    </main>
	
        <?php include_once 'footer.inc'; ?>

</body>
</html>