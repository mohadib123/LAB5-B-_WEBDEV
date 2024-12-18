<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
</head>
<body>
    <h2>User Registration</h2>
    <form action="register_process.php" method="POST">
        <label for="matric">Matric:</label><br>
        <input type="text" id="matric" name="matric" required><br><br>
        
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        
        <label for="role">Role:</label><br>
        <select id="role" name="role" required>
            <option value="student">Student</option>
            <option value="lecturer">Lecturer</option>
        </select><br><br>
        
        <button type="submit">Register</button>
    </form>
</body>
</html>
