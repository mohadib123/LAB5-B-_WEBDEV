<?php
// Start the session
session_start();

// Database connection settings
$servername = "localhost";
$username = "root";
$password = ""; // Your MySQL root password
$dbname = "Lab_5b";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$error_message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matric = $_POST['matric'];
    $password = $_POST['password'];

    // Query to validate the user
    $query = "SELECT * FROM users WHERE matric = ? AND password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $matric, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Authentication successful
        $_SESSION['matric'] = $matric;
        header("Location: display_users.php");
        exit();
    } else {
        // Authentication failed
        $error_message = "Invalid username or password, try <a href='login.php'>login</a> again.";
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>

    <form method="POST" action="login.php">
        <label for="matric">Matric:</label>
        <input type="text" id="matric" name="matric" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit">Login</button>
    </form>

    <?php
    if (!empty($error_message)) {
        echo "<div style='color: red; border: 1px solid black; padding: 10px; margin-top: 10px;'>";
        echo $error_message;
        echo "</div>";
    }
    ?>

    <p>
        <a href="register.php">Register</a> here if you have not.
    </p>
</body>
</html>
