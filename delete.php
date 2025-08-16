<?php
include 'connect.php';
if(isset($_GET['deleteid'])){
    $userId=$_GET['deleteid'];

    $sql="delete from `users` where userId=$userId";
    $result=mysqli_query($mysqli,$sql);
    if($result){
        //echo "Deleted successfully";
        header('location:profile.php');

    }else{
         die("Connection failed: " . $mysqli->connect_error);
    }
}

?>