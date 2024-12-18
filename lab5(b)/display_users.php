<?php

session_start();

// Check if the user is logged in
if (!isset($_SESSION['matric'])) {
    header("Location: login.php");
    exit();
}
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

// Query to fetch matric, name, and role
$sql = "SELECT matric, name, role FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users List</title>
</head>
<body>
    <h2>Users List</h2>

    <table border="1">
        <thead>
            <tr>
                <th>Matric</th>
                <th>Name</th>
                <th>Access Level</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                // Fetch and display each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['matric']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['role']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No users found.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <?php $conn->close(); ?>
</body>
</html>


