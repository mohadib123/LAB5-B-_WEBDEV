<?php
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

// Fetch user details if `matric` is provided
if (isset($_GET['matric'])) {
    $matric = $_GET['matric'];
    $query = "SELECT name, role FROM users WHERE matric = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $matric);
    $stmt->execute();
    $stmt->bind_result($name, $role);
    $stmt->fetch();
    $stmt->close();
} else {
    echo "Invalid request.";
    exit();
}

// Handle form submission for updates
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $updatedName = $_POST['name'];
    $updatedRole = $_POST['role'];

    $updateQuery = "UPDATE users SET name = ?, role = ? WHERE matric = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("sss", $updatedName, $updatedRole, $matric);

    if ($stmt->execute()) {
        echo "<p>User updated successfully!</p>";
        echo "<a href='display_users.php'>Back to Users List</a>";
        $stmt->close();
        $conn->close();
        exit();
    } else {
        echo "<p>Error updating user: " . $stmt->error . "</p>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
</head>
<body>
    <h2>Update User</h2>
    <form method="POST">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required><br><br>

        <label for="role">Role:</label><br>
        <select id="role" name="role" required>
            <option value="student" <?php echo ($role == 'student') ? 'selected' : ''; ?>>Student</option>
            <option value="lecturer" <?php echo ($role == 'lecturer') ? 'selected' : ''; ?>>Lecturer</option>
        </select><br><br>

        <button type="submit">Update</button>
    </form>
    <a href="display_users.php">Cancel</a>
</body>
</html>
