<?php
include 'config.php';
session_start();
if(!isset($_SESSION["email"])){
header("Location: app-login.php ");
exit(); }

$user = $_SESSION['email'];
$query = "SELECT * FROM users WHERE email = '$user'";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_array($result);

//USER DATA 
$userRef        = $row['uid'];
$displayName    = $row['displayName'];
$email          = $row['email'];
$photoURL       = $row['photoURL'];
$emailVerified  = $row['emailVerified'];
$phoneNumber    = $row['phoneNumber'];
$password       = $row['password'];
$companyRef     = $row['companyRef'];
$lastLoginAt    = $row['lastLoginAt'];
$createdAt      = $row['createdAt'];

//COMAPANY DATA
$query2 = "SELECT * FROM company WHERE userRef = '$userRef'";
$result2 = mysqli_query($conn,$query2);
$row2 = mysqli_fetch_array($result2);
$myCompanyName = $row2['displayName'];
$myCompanySector = $row2['sector'];
$myCompanyAddress = $row2['address'];
$myCompanyInfo = $row2['companyInfo'];
?>
