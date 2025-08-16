<?php
require 'connect.php';
session_start();

$error = "";

if (isset($_POST['submit'])) {
    $user_Name = trim($_POST['username']);
    $Password = trim($_POST['password']);

    // Check user in database
    $stmt = $mysqli->prepare("SELECT * FROM users WHERE User_Name = ?");
    $stmt->bind_param("s", $User_Name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['Password'])) {
            // Save Info
            $_SESSION['userId']   = $user['userId'];
            $_SESSION['User_Name'] = $user['User_Name'];
            $_SESSION['UserType'] = $user['UserType'];

            // Redirect based on role
            if ($user['UserType'] === 'admin') {
                header("Location: admin_dashboard.php");
            } elseif ($user['UserType'] === 'author') {
                header("Location: author_dashboard.php");
            } elseif ($user['UserType'] === 'users') {
                header("Location: dashboard.php");
            } else {
                header("Location: profile.php"); // fallback
            }
            exit();
        } else {
            $error = "Invalid Password";
        }
    } else {
        $error = "User does not exist";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - DBT</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="header">
        Login
            </div>
        <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
        <form action="" method="post">
            <input type="text" name="username" placeholder="Enter your username" required>
            <br>
            <input type="password" name="password" placeholder="Enter your password" required>
            <br>
            <input type="submit" name="submit" class="btn" value="Login">
        </form>
    
</body>
</html>
