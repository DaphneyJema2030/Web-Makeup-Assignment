<?php
require 'connect.php';

if (isset($_POST['submit'])) {
    // Retrieve form data
    $Full_Name   = $_POST['fullname'];
    $email       = $_POST['email'];
    $Phone_Number= $_POST['tel'];
    $User_Name   = $_POST['username'];
    $UserType    = $_POST['usertype'];
    $Password    = $_POST['password'];

    // Validate required fields
    if (empty($Full_Name) || empty($email) || empty($Phone_Number) || empty($User_Name) || empty($UserType) || empty($Password)) {
        echo "All fields are required.";
        exit;
    }

    // Hash password
    $hash_password = password_hash($Password, PASSWORD_DEFAULT);

    // Prepare and bind
    $stmt = $mysqli->prepare("INSERT INTO users (Full_Name, email, phone_Number, User_Name, UserType, Password) 
                              VALUES (?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $mysqli->error);
    }

    $stmt->bind_param("ssssss", $Full_Name, $email, $Phone_Number, $User_Name, $UserType, $hash_password);

    // Execute
    if ($stmt->execute()) {
        header("Location: login.php?statindexus=success");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "No data submitted.";
}

?>