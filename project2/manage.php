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
            require_once 'settings.php';
            $conn = mysqli_connect($host, $username, $password, $database);

            if ($conn) {
                $query = "SELECT * FROM eoi";
                $result = mysqli_query($conn, $query);

                if (!$result) {
                    die("Query failed: " . mysqli_error($conn));
                }

            } else {
                die("No connection to db: " . mysqli_connect_error());
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
        <br>
        <form method="post" action="">
            <input type="submit" id="searchAll" value="Search All"> 
            <input type="submit" id="clear" value="Clear">
        </form>
        <br> <br>
        <form method="post" action="">
            <section id="applicantSort">
                <label for="ApplicantSurname">Find Applicant (Surname)</label>
                <br>
                <input type="text" name="Applicant" id="Applicant" required maxlength="20">
                <input type="submit" name= "find_applicant" value="Find Applicant">
            </section>
        </form>

        <?php //ChatGPT prompt: please check my code and give me feedback on how to get it working, 21/05/25 - code supplied edited
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['EOI_reference']) && !empty(trim($_POST['EOI_reference']))) {
                $eoi_reference = trim($_POST['EOI_reference']);
                // Prepare a query to check if the EOI reference exists
                $check_sql = "SELECT * FROM eoi WHERE job_reference_number = ?"; //creates sql query 
                $stmt = $conn->prepare($check_sql); //prepare sql for execution
                $stmt->bind_param("s", $eoi_reference); //allocates eoi_reference to '?'
                $stmt->execute(); 
                $result = $stmt->get_result(); 
                $resultsOutput = "";
                if (isset($_POST['search'])) { 
                    if ($result->num_rows > 0) {
                        $resultsOutput .= "<p>Found record(s) for '$eoi_reference'</p><br>";
                        while ($row = $result->fetch_assoc()) {
                            $resultsOutput .= "<div class='eoi-record'>";
                            $resultsOutput .= "<p> [{$row['status']}] [{$row['eoi_number']}]. [{$row['job_reference_number']}]: {$row['first_name']} {$row['last_name']}, D.O.B: {$row['birthdate']}, Gender: {$row['gender']}, Address: {$row['street_address']} {$row['suburb']} {$row['state']} {$row['postcode']}, Contact: em: {$row['email_address']}, ph: {$row['phone_number']}, li: {$row['linkedin']}, tw: {$row['twitter']}, gh: {$row['github']}, web: {$row['personal_website']}, Skills and Experience: {$row['technical_skills']}, {$row['other_skills']}, {$row['experience_title']}, {$row['experience_company']}, {$row['experience_description']}, {$row['experience_from_date']}, {$row['experience_to_date']}, Work status: {$row['currently_working']}, Education: {$row['education_institution']}, {$row['education_degree']}, {$row['education_major']}, {$row['education_description']}, {$row['education_from_date']}, {$row['education_to_date']}, {$row['currently_attending']}, Resume: {$row['resume']}, Message: {$row['message_for_us']} </p>";
                            $resultsOutput .= "</div>";
                        }
                    } else {
                         $resultsOutput .= "<p>No data found for '$eoi_reference'</p>";
                    }
                } elseif (isset($_POST['delete'])) { 
                    if ($result->num_rows > 0) {
                        $delete_sql = "DELETE FROM eoi WHERE job_reference_number = ?";
                        $del_stmt = $conn->prepare($delete_sql); //prepares sql 
                        $del_stmt->bind_param("s", $eoi_reference); 
                        $del_stmt->execute();
                        echo "<p>Deleted all '$eoi_reference' EOIs</p>";
                    } else {
                        echo "<p>No data found for '$eoi_reference'</p>";
                    }
                }
                $stmt->close();
                $conn->close();
            }     

            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['searchAll'])) {
                require_once 'settings.php';
                $conn = mysqli_connect($host, $username, $password, $database);

                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                $query = "SELECT * FROM eoi";
                $result = mysqli_query($conn, $query);

                if ($result && mysqli_num_rows($result) > 0) {
                    $resultsOutput .= "<p>Found " . mysqli_num_rows($result) . " EOI record(s):</p><br>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        $resultsOutput .= "<div class='eoi-record'>";
                        $resultsOutput .= "<p> [{$row['status']}] [{$row['eoi_number']}]. [{$row['job_reference_number']}]: {$row['first_name']} {$row['last_name']}, D.O.B: {$row['birthdate']}, Gender: {$row['gender']}, Address: {$row['street_address']} {$row['suburb']} {$row['state']} {$row['postcode']}, Contact: em: {$row['email_address']}, ph: {$row['phone_number']}, li: {$row['linkedin']}, tw: {$row['twitter']}, gh: {$row['github']}, web: {$row['personal_website']}, Skills and Experience: {$row['technical_skills']}, {$row['other_skills']}, {$row['experience_title']}, {$row['experience_company']}, {$row['experience_description']}, {$row['experience_from_date']}, {$row['experience_to_date']}, Work status: {$row['currently_working']}, Education: {$row['education_institution']}, {$row['education_degree']}, {$row['education_major']}, {$row['education_description']}, {$row['education_from_date']}, {$row['education_to_date']}, {$row['currently_attending']}, Resume: {$row['resume']}, Message: {$row['message_for_us']} </p>";
                        $resultsOutput .= "</div>";
                    }
                } else {
                    echo "<p>No EOI records found.</p>";
                }

                mysqli_close($conn);
            }

            if (isset($_POST['clear'])) { 
                $resultsOutput .= "<p>No results currently</p>";
            } 

            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Applicant']) && !empty(trim($_POST['Applicant']))) {
                $Applicant = trim($_POST['Applicant']);
                $check_sql = "SELECT * FROM eoi WHERE last_name = ?"; //creates sql query 
                $stmt = $conn->prepare($check_sql); //prepare sql for execution
                $stmt->bind_param("s", $Applicant); //allocates eoi_reference to '?'
                $stmt->execute(); 
                $result = $stmt->get_result(); 
                $resultsOutput = "";
                if (isset($_POST['find_applicant'])) { 
                    if ($result->num_rows > 0) {
                        $resultsOutput .= "<p>Found record(s) for '$Applicant'</p><br>";
                        while ($row = $result->fetch_assoc()) {
                            $resultsOutput .= "<div class='eoi-record'>";
                            $resultsOutput .= "<p> [{$row['status']}] [{$row['eoi_number']}]. [{$row['job_reference_number']}]: {$row['first_name']} {$row['last_name']}, D.O.B: {$row['birthdate']}, Gender: {$row['gender']}, Address: {$row['street_address']} {$row['suburb']} {$row['state']} {$row['postcode']}, Contact: em: {$row['email_address']}, ph: {$row['phone_number']}, li: {$row['linkedin']}, tw: {$row['twitter']}, gh: {$row['github']}, web: {$row['personal_website']}, Skills and Experience: {$row['technical_skills']}, {$row['other_skills']}, {$row['experience_title']}, {$row['experience_company']}, {$row['experience_description']}, {$row['experience_from_date']}, {$row['experience_to_date']}, Work status: {$row['currently_working']}, Education: {$row['education_institution']}, {$row['education_degree']}, {$row['education_major']}, {$row['education_description']}, {$row['education_from_date']}, {$row['education_to_date']}, {$row['currently_attending']}, Resume: {$row['resume']}, Message: {$row['message_for_us']} </p>";
                            $resultsOutput .= "</div>";
                        }
                    } else {
                         $resultsOutput .= "<p>No data found for '$Applicant'</p>";
                    }
            } 
        }
        ?>

        <br> <br>
        <section id="results"> 
            <h2>Query Results:</h2>
            <br> 
            <?php 
                if (!empty($resultsOutput)) {
                    echo $resultsOutput;
                } else {
                    echo "<p>No results currently</p>";
                }
            ?>
        </section> 

    </main>
	
        <?php include_once 'footer.inc'; ?>

</body>
</html>