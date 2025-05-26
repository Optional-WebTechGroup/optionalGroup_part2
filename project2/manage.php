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
    
	<?php 
    //checks if login
        session_start();
        require_once 'settings.php';
        if (!isset($_SESSION['username'])) {
            header("Location: login.php");
            exit;
        }  
        //connect to database
        $conn = mysqli_connect($host, $user, $pwd, $sql_db);
        if(!$conn) {
            die("Database connection failed: ".mysqli_connect_error());
        } 
        // Check if user exists and get their status
        $username = $_SESSION['username'];
        $query = "SELECT status FROM users WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        //checks user status (boolean:0,1)
        if ($result && $result->num_rows === 1) { //more then 1 row
            $row = $result->fetch_assoc();
            if ($row['status'] == '0') {
                include_once 'header_manager.inc';
            } else {
                header("Location: index.php");
                exit;
            }
        } else {
            echo "<p>Error: User not found or issue with users table.</p>";
        }

        $stmt->close();
        $conn->close();    
    ?>
    
    <main> 

        <?php 
            require_once 'settings.php';
            $conn = mysqli_connect($host, $user, $pwd, $sql_db);

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
        <!-- Search and Delete EOI by Job Reference Number -->
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
        <!-- Search All and Clear Results -->
        <form method="post" action="">
            <input type="submit" id="searchAll" name="searchAll"value="Search All"> 
            <input type="submit" id="clear" value="Clear">
        </form>
        <br> <br>
        <!-- Find Applicant by Last Name -->
        <form method="post" action="">
            <section id="applicantSort">
                <label for="ApplicantSurname">Find Applicant (Surname)</label>
                <br>
                <input type="text" name="Applicant" id="Applicant" required maxlength="20">
                <input type="submit" name= "find_applicant" value="Find Applicant">
            </section>
        </form>
        <br> <br>
         <!-- Update EOI Status -->
        <form method="post" action="">
            <section id="statusChange">
                <label for="eoiNumber_text">Enter EOI Number</label>
                <br>
                <input type="text" name="eoiNumber_text" id="eoiNumber_text" required maxlength="20">
                <br>

                <input type="radio" id="New" name="status" value="New">
                <label for="New">New</label>

                <input type="radio" id="Current" name="status" value="Current">
                <label for="Current">Current</label>

                <input type="radio" id="Final" name="status" value="Final">
                <label for="Final">Final</label>

                <br>
                <input type="submit" name="eoiNumber_submit" value="Submit">
            </section>
        </form>


        <?php //ChatGPT prompt: please check my code and give me feedback on how to get it working, 21/05/25 - code supplied edited (refered to how to get data entries sql command based on button clicked)
            $resultsOutput = "";
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['EOI_reference']) && !empty(trim($_POST['EOI_reference']))) {
                $eoi_reference = trim($_POST['EOI_reference']);
                // Prepare a query to check if the EOI reference exists
                $check_sql = "SELECT * FROM eoi WHERE job_reference_number = ?"; //creates sql query 
                $stmt = $conn->prepare($check_sql); //prepare sql for execution
                $stmt->bind_param("s", $eoi_reference); //allocates eoi_reference to '?'
                $stmt->execute(); 
                $result = $stmt->get_result(); 
                if (isset($_POST['search'])) { //when 'search' is pressed
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
                } elseif (isset($_POST['delete'])) {  //when 'delete' is pressed
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
                $conn = mysqli_connect($host, $user, $pwd, $sql_db);

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
                if (isset($_POST['find_applicant'])) {  //when 'find_applicant' is clicked
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

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST['eoiNumber_text']) && !empty(trim($_POST['eoiNumber_text']))) {
                    $eoiNumber = trim($_POST['eoiNumber_text']);

                    if (isset($_POST['status'])) {
                        $newStatus = $_POST['status'];

                        require_once("settings.php");
                        $conn = mysqli_connect($host, $user, $pwd, $sql_db);

                        if (!$conn) { 
                            die("Database connection failed: " . mysqli_connect_error());
                        }

                        // Check if eoi_number exists
                        $check_sql = "SELECT eoi_number FROM eoi WHERE eoi_number = ?";
                        $check_stmt = $conn->prepare($check_sql);
                        $check_stmt->bind_param("s", $eoiNumber);
                        $check_stmt->execute();
                        $check_result = $check_stmt->get_result();

                        if ($check_result->num_rows > 0) {
                            // Proceed to update
                            $query = "UPDATE eoi SET status = ? WHERE eoi_number = ?"; //creates sql query 
                            $stmt = $conn->prepare($query); //prepare sql for execution
                            $stmt->bind_param("ss", $newStatus, $eoiNumber);

                            if ($stmt->execute()) {
                                $resultsOutput .= "<p>Status updated to '$newStatus' for EOI Number: $eoiNumber</p>";
                            } else {
                                $resultsOutput .= "<p>Error updating status.</p>";
                            }

                            $stmt->close();
                        } else {
                            $resultsOutput .= "<p>Error: EOI Number '$eoiNumber' does not exist.</p>";
                        }

                        $check_stmt->close();
                        $conn->close();
                    } else {
                        $resultsOutput .= "<p>Please select a status.</p>"; 
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