<?php
include 'connect.php';
include 'process.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial cale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>DBT-Makeup</title>
</head>
<body>
    <div class="header">
        Sign In
    </div>

    <form action="" method="post">
    <input type="text" name="fullname" placeholder="Enter your fullname" required/>
    <br>
    <input type="text" name="email" placeholder="Enter your email" required/>
    <br>
    <input type="tel" name="tel" placeholder="Enter your phone number" required/>
    <br>
    <input type="text" name="username" placeholder="Enter your username" required/>
    <br>
    <input type="password" name="password" placeholder="Enter your password" required />
    <br>
    <div class="selectors">
     <label><input type="radio" name="usertype" value="user" required> User</label>
     <br>
    <label><input type="radio" name="usertype" value="author"> Author</label>
    <br>
    <label> <input type="radio" name="usertype" value="admin"> Admin</label>
    <br>
    </div>

    <input type="submit" name="submit" value="Sign In"/>

</form>


</body>
</html>