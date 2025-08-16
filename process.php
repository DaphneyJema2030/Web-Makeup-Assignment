<?php
if(isset($_POST['submit'])){
    $Full_Name=$_POST['fullname'];
    $email=$_POST['email'];
    $Phone_Number=$_POST['tel'];
    $User_Name=$_POST['username'];
    $UserType=$_POST['usertype'];
    $Password=$_POST['password'];

    $hash_password = password_hash($confirm_password, PASSWORD_DEFAULT);

    $sql="insert into `users` (Full_Name,email,Phone_Number,User_Name,UserType,Password)
    values('$fullname','$email','$tel','$username','$usertype','$password')";
    $result=mysqli_query($mysqli,$sql);
    if($result){
        echo "Data inserted succesfully";
    }else{
        die(mysqli_error($mysqli));
    }
    }


?>