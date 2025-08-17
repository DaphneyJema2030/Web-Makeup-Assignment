<?php
require 'connect.php';
date_default_timezone_set('Africa/Nairobi');

if (isset($_GET['update_author'])) {
    $userId = intval($_GET['update_author']);

    // Fetch author details from users table
    $sql = "SELECT * FROM `users` WHERE userId=$userId AND UserType='author'";
    $result = mysqli_query($mysqli, $sql);

    if (!$result || mysqli_num_rows($result) == 0) {
        die("Author not found.");
    }

    $row = mysqli_fetch_assoc($result);
    $Full_Name    = $row['Full_Name'];
    $email        = $row['email'];
    $phone_Number = $row['phone_Number']; 
    $UserType     = $row['UserType'];
    $Password     = ""; 
}

if (isset($_POST['submit'])) {
    // Retrieve form data
    $Full_Name    = trim($_POST['fullname']);
    $email        = trim($_POST['email']);
    $phone_Number = trim($_POST['tel']);
    $UserType     = "author"; 
    $Password     = $_POST['password'];

    // update
    $update_sql = "UPDATE users 
                   SET Full_Name='$Full_Name',
                       email='$email',
                       phone_Number='$phone_Number',
                       UserType='$UserType'";

    if (!empty($Password)) {
        $hash_password = password_hash($Password, PASSWORD_DEFAULT);
        $update_sql .= ", Password='$hash_password'";
    }

    $update_sql .= " WHERE userId=$userId";

    $result = mysqli_query($mysqli, $update_sql);

    if ($result) {
        header("Location: manage_authors.php?status=updated");
        exit();
    } else {
        die("Error: " . mysqli_error($mysqli));
    }
}
?>
