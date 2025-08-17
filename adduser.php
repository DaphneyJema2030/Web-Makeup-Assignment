<?php
require 'connect.php';
session_start();

$message = "";

if (isset($_POST['submit'])) {
    $Full_Name    = trim($_POST['fullname']);
    $email        = trim($_POST['email']);
    $Phone_Number = trim($_POST['tel']);
    $User_Name    = trim($_POST['username']);
    $UserType     = trim($_POST['usertype']);
    $Password     = trim($_POST['password']);

    if (!empty($Full_Name) && !empty($email) && !empty($Phone_Number) && !empty($User_Name) && !empty($Password) && !empty($UserType)) {
        // Hash the password before saving
        $hashedPassword = password_hash($Password, PASSWORD_DEFAULT);

        // Prepare insert statement
        $stmt = $mysqli->prepare("INSERT INTO users (Full_Name, email, Phone_Number, User_Name, UserType, Password) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $Full_Name, $email, $Phone_Number, $User_Name, $UserType, $hashedPassword);

        if ($stmt->execute()) {
            // Redirect to profile.php once user is added
            header("Location: profile.php?success=1");
            exit();
        } else {
            $message = "Error " . $stmt->error;
        }

        $stmt->close();
    } else {
        $message = "⚠️ All fields are required.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add User</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2>Add New User</h2>

    <?php if (!empty($message)) echo "<p>$message</p>"; ?>

    <form action="" method="post">
        <input type="text" name="fullname" placeholder="Enter full name" required><br><br>
        <input type="email" name="email" placeholder="Enter email" required><br><br>
        <input type="tel" name="tel" placeholder="Enter phone number" required><br><br>
        <input type="text" name="username" placeholder="Enter username" required><br><br>
        <input type="password" name="password" placeholder="Enter password" required><br><br>

        <label>User Type:</label><br>
        <select name="usertype" required>
            <option value="user">User</option>
            <option value="author">Author</option>
            <option value="admin">Admin</option>
        </select><br><br>

        <input type="submit" name="submit" value="Add User">
    </form>
</body>
</html>
