<?php
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
        echo "Username and password are required.";
        exit;
    }

    // Hash the password
    $hashed_password = password_hash($pwd, PASSWORD_DEFAULT);

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");

    if ($stmt) {
        $stmt->bind_param("ss", $user, $hashed_password);

        if ($stmt->execute()) {
            echo "Signup successful. You can now <a href='login.php'>login</a>.";
        } else {
                echo "Signup failed: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error preparing the statement: " . $conn->error;
    }
}

$conn->close();
?>

<form action="signup.php" method="post">
    <label>Username:</label>
    <input type="text" name="username" required><br>

    <label>Password:</label>
    <input type="password" name="password" required><br>

    <input type="submit" value="Sign Up">
</form>