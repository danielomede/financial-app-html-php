<?php
$servername = "localhost";
$username = "mobileju_briel_admin";
$password = "jaykay007";
$dbname = "mobileju_briel";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
 #echo "Connected successfully";
?>