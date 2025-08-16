<?php
require 'connect.php';
session_start();

if (!isset($_SESSION['userId']) || $_SESSION['usertype'] !== 'author') {
    header("Location: login.php");
    exit();
}

$userId   = $_SESSION['userId'];
$username = $_SESSION['username'];

$stmt = $mysqli->prepare("SELECT * FROM users WHERE userId = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$currentUser = $stmt->get_result()->fetch_assoc();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Author Dashboard - DBT</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2>Welcome, <?= htmlspecialchars($currentUser['Full_Name']) ?> (Author)</h2>

    <div class="menu">
        <a href="update_profile.php" class="btn">Update My Profile</a>
        <a href="my_articles.php" class="btn">Manage My Articles</a>
        <a href="view_articles.php" class="btn">View Articles</a>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
</body>
</html>
