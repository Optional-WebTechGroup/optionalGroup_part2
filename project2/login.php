<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("settings.php");
session_start();

// Establish database connection
$conn = mysqli_connect($host, $user, $pwd, $sql_db);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
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
?>

<form action="login.php" method="post">
    <label>Username:</label><br>
    <input type="text" name="username" required><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br>

    <input type="submit" value="Login">
</form>