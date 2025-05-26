
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
session_start();

$conn = mysqli_connect($host, $user, $pwd, $sql_db);
if (!$conn) {
    header('Location: error.html');
    exit();
}

if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

// Initialize session variables if not set
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
}
if (!isset($_SESSION['lockout_time'])) {
    $_SESSION['lockout_time'] = null;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = trim($_POST['username'] ?? '');
    $pwd = trim($_POST['password'] ?? '');

    // Basic Validation
    if (empty($user) || empty($pwd)) {
        $resultsOutput .= "Username and password are required.";
    } else {
        // ChatGPT Prompt: How do I implement time in php code? 24/05/2025. Code Supplied: "time()"
        if ($_SESSION['lockout_time'] && time() < $_SESSION['lockout_time']) {
            $remaining = $_SESSION['lockout_time'] - time();
            $minutes = floor($remaining / 60);
            $seconds = $remaining % 60;
            $resultsOutput .= "Too many failed attempts. Try again in {$minutes} minute(s) and {$seconds} second(s).";
        } else {
            // Reset lockout if time has passed
            if ($_SESSION['lockout_time'] && time() >= $_SESSION['lockout_time']) {
                $_SESSION['login_attempts'] = 0;
                $_SESSION['lockout_time'] = null;
            }

            $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
            if ($stmt) {
                $stmt->bind_param("s", $user);
                $stmt->execute();
                $stmt->store_result();

                if ($stmt->num_rows === 1) {
                    $stmt->bind_result($stored_hashed_password);
                    $stmt->fetch();

                    if (password_verify($pwd, $stored_hashed_password)) {
                        $_SESSION['username'] = $user;
                        $_SESSION['login_attempts'] = 0;
                        $_SESSION['lockout_time'] = null;
                        header("Location: index.php");
                        exit;
                    } else {
                        // If login fails increments timer
                        $_SESSION['login_attempts']++;
                        // Checks if login attempts is less than or equal to 3
                        if ($_SESSION['login_attempts'] >= 3) {
                            // Locks user out for set time
                            $_SESSION['lockout_time'] = time() + 10; 
                            $resultsOutput .= "Too many failed attempts. Account locked for 10 seconds.";
                        } else {
                            $resultsOutput .= "Incorrect username or password.";
                        }
                    }
                } else {
                    // If login fails increments timer
                    $_SESSION['login_attempts']++;
                    // Checks if login attempts is less than or equal to 3
                    if ($_SESSION['login_attempts'] >= 3) {
                        // Locks user out for set time
                        $_SESSION['lockout_time'] = time() + 10;
                        $resultsOutput .= "Too many failed attempts. Account locked for 10 seconds.";
                    } else {
                        $resultsOutput .= "Incorrect username or password.";
                    }
                }

                $stmt->close();
            } else {
                $resultsOutput .= "Error preparing login statement: " . $conn->error;
            }
        }
    }
}

$conn->close();
include('header_login.inc');
?>

    <main>
            <h1>Login</h1><br></br>
        <form action="login.php" method="post">
            <section id="loginPage">
                <label>Username:</label>
                <input type="text" name="username" required><br></br>

                <label>Password:</label>
                <input type="password" name="password" required><br></br>

                <input id= "loginPageBtn" type="submit" value="Login">
            </section>
        </form>
        <br> <br>
        <section id="loginPageResults"> 
        <br> 
        <?php 
            if (!empty($resultsOutput)) {
                echo "<p class='center'>$resultsOutput</p>";
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