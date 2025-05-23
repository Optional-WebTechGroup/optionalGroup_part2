
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
        require_once("settings.php");
        session_start();

        // Establish database connection
        $conn = mysqli_connect($host, $user, $pwd, $sql_db);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        if (isset($_SESSION['username'])) {
            header("Location: index.php");
            exit;
        }

        // Only process POST requests
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $user = trim($_POST['username'] ?? '');
            $pwd = trim($_POST['password'] ?? '');

            // Basic validation
            if (empty($user) || empty($pwd)) {
                echo "Username and password are required.";
                exit;
            }

            // Fetch user record from database
            $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
            if ($stmt) {
                $stmt->bind_param("s", $user);
                $stmt->execute();
                $stmt->store_result();

                // Check if user exists
                if ($stmt->num_rows === 1) {
                    $stmt->bind_result($stored_hashed_password);
                    $stmt->fetch();

                    // Verify entered password against stored hash
                    if (password_verify($pwd, $stored_hashed_password)) {
                        $_SESSION['username'] = $user;

                        // Redirect to home page after successful login
                        header("Location: index.php");
                        exit;
                    } else {
                        echo "Incorrect username or password.";
                    }
                } else {
                    echo "Incorrect username or password.";
                }

                $stmt->close();
            } else {
                echo "Error preparing login statement: " . $conn->error;
            }
        }

        $conn->close();

        include('header_login.inc') 
    ?>

    <main>
        <h1>Login</h1>
        <form action="login.php" method="post">
            <label>Username:</label><br>
            <input type="text" name="username" required><br>

            <label>Password:</label><br>
            <input type="password" name="password" required><br>

            <input type="submit" value="Login">
        </form>
    </main>
    <?php include('footer.inc') ?>
</body>
</html>