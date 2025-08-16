<?php
require 'connect.php';
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
    <div class="container">
        <a href="adduser.php" class="btn btn-primary my-5">Add User</a>
        <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">SN</th>
      <th scope="col">Fullname</th>
      <th scope="col">Email</th>
      <th scope="col">Phone Number</th>
      <th scope="col">Username</th>
      <th scope="col">Password</th>
      <th scope="col">Operations</th>
    </tr>
  </thead>
  <tbody>
  <?php
  $sql="Select * from `users`";
$result=mysqli_query($mysqli,$sql);
if($result){
    while( $row=mysqli_fetch_assoc($result)){
        $userId=$row['userId'];
        $Full_Name=$row['Full_Name'];
        $email=$row['email'];
        $Phone_Number=$row['phone_Number'];
        $User_Name=$row['User_Name'];
        $Password=$row['Password'];
        echo'<tr>
      <th scope="row">'.$userId.'</th>
      <td>'.$Full_Name.'</td>
      <td>'.$email.'</td>
      <td>'.$Phone_Number.'</td>
      <td>'.$User_Name.'</td>
      <td>'.$Password.'</td>

      <td>
      <a href="update.php?updateid='.$userId.'" class="btn btn-primary my-5">Update User</a>
      <a href="delete.php?deleteid='.$userId.'" class="btn btn-primary my-5">Delete User</a>

      </td>

    </tr>';

    }
}

  ?>
  </tbody>
</table>

    </div>
    
</body>
</html>