<?php
require 'connect.php';
date_default_timezone_set('Africa/Nairobi');


if (isset($_GET['updateid'])) {
    $userId = intval($_GET['updateid']);

    // form filed
    $sql="Select * from `users` where userId=$userId";
    $result = mysqli_query($mysqli,$sql);
    $row = mysqli_fetch_assoc($result);
    $Full_Name   = $row['Full_Name'];
    $email       = $row['email'];
    $phone_Number= $row['phone_Number']; 
    $UserType    = $row['UserType'];
    $Password    = $row['Password'];


}

if (isset($_POST['submit'])) {
    // Retrieve form data
    $Full_Name    = trim($_POST['fullname']);
    $email        = trim($_POST['email']);
    $phone_Number = trim($_POST['tel']);
    //username 
    $UserType     = $_POST['usertype'];
    $Password     = $_POST['password'];

    // Hash password when entered
    if (!empty($Password)) {
        $hash_password = password_hash($Password, PASSWORD_DEFAULT);
        $password_sql = ", Password='$hash_password'";
    } else {
        $password_sql = "";
    }

    // Update query
    $sql = "UPDATE users 
            SET Full_Name='$Full_Name',
                email='$email',
                phone_Number='$phone_Number',
                
                UserType='$UserType',
                $password_sql
            WHERE userId=$userId";

    $result = mysqli_query($mysqli, $sql);

    if ($result) {
        echo "Updated successfully!";
        header("Location: profile.php?status=updated");
        exit();
    } else {
        die("Error: " . mysqli_error($mysqli));
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>DBT-Makeup</title>
</head>
<body>
    <div class="header">
        <h2>Update User</h2>
    </div>

    <form action="" method="post">
        <input type="text" name="fullname" placeholder="Enter your fullname" value=<?php echo $Full_Name; ?> />
        <br>
        <input type="email" name="email" placeholder="Enter your email" value=<?php echo $email; ?>/>
        <br>
        <input type="tel" name="tel" placeholder="Enter your phone number" value=<?php echo $phone_Number; ?>/>
        
        <br>
        <input type="password" name="password" placeholder="Enter new password or Keep old leave blank" value=<?php echo $Password; ?> />
        <br>
        <div class="selectors">
            <label><input type="radio" name="usertype" value="user" <?php if($UserType=="user") echo "checked"; ?>> User</label><br>
            <label><input type="radio" name="usertype" value="author" <?php if($UserType=="author") echo "checked"; ?>> Author</label><br>
            <label><input type="radio" name="usertype" value="admin" <?php if($UserType=="admin") echo "checked"; ?>> Admin</label><br>
        </div>
        <br>
        <input type="submit" name="submit" class="btn btn-primary" value="Update" />
    </form>
</body>
</html>
