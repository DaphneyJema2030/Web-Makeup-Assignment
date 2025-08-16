<?php
// connection.php
date_default_timezone_set('Africa/Nairobi');
require_once "constant.php";
//Create conn
$mysqli = new mysqli(Host_Name, DB_User, DB_Password, DB_Name);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>
