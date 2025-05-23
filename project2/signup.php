
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
        $resultsOutput = "";
        require_once("settings.php");

        // Establish database connection
        $conn = mysqli_connect($host, $user, $pwd, $sql_db);

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Only process POST requests
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Trim and sanitize user input
            $user = trim($_POST['username'] ?? '');
            $pwd = trim($_POST['password'] ?? '');

            // Basic validation
            if (empty($user) || empty($pwd)) {
                $resultsOutput .= "Username and password are required.";
                exit;
            }

            // Hash the password
            $hashed_password = password_hash($pwd, PASSWORD_DEFAULT);

            // Prepare SQL statement
            $stmt = $conn->prepare("INSERT INTO users (username, password, status) VALUES (?, ?, ?)");

            if ($stmt) {
                $status = 1;
                $stmt->bind_param("ssi", $user, $hashed_password, $status);

                if ($stmt->execute()) {
                    $resultsOutput .= "Signup successful. You can now <a href='login.php'>login</a>.";
                } else {
                        $resultsOutput .= "Signup failed: " . $stmt->error;
                }

                $stmt->close();
            } else {
                $resultsOutput .= "Error preparing the statement: " . $conn->error;
            }
        }

        $conn->close();
        include('header_login.inc')
    ?>

    <main>
        <h1>Sign Up</h1>
        <form action="signup.php" method="post">
            <section id="signupPage">
                <label>Username:</label>
                <input type="text" name="username" required><br>

                <label>Password:</label>
                <input type="password" name="password" required><br>

                <input type="submit" value="Sign Up">
            </section>
        </form>
        <section id="singupPageResults"> 
        <br> 
        <?php 
            if (!empty($resultsOutput)) {
                echo $resultsOutput;
                echo "<br>";
            } else {
                echo "<br><br>";
            }
        ?>
        </section> 
    </main>
    <?php include('footer.inc') ?>
</body>
</html>