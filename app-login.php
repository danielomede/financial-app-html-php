
<?php
include ('config.php');
session_start();
if (isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_hash = md5($password);

    $query = "SELECT * FROM `users` WHERE email='$email' and password = '$password_hash'";
	$result = mysqli_query($conn, $query);
	$rows = mysqli_num_rows($result);

        if($rows==0) {
        echo "<script>alert('Password or email is incorrect')</script>";
		exit();

        } else  {
    	    $_SESSION['email']=$email;
    	    
        	
            $new_lastLogin = date("Y/m/d h:i:sa");
                
             
             $sql = "UPDATE users SET lastLoginAt='$new_lastLogin' WHERE email='$email'";
            
            if (mysqli_query($conn, $sql)) {
                echo "<script>window.open('app-index.php','_self')</script>";
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }
        
    mysqli_close($conn);

    }
}
?>
<!doctype html>
<html lang="en">
<head>
        <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login | Hulp </title>
    <link rel="stylesheet" href="assets/css/styleae52.css?v=5">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="description" content="HTML Mobile Template">
    <meta name="keywords" content="bootstrap, mobile template, mobile, html, wallet, banking, finance" />
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png" sizes="32x32">
    <link rel="shortcut icon" href="assets/img/favicon.png">
    
    <style>
        
         
         
        
         .btn-grad {background-image: linear-gradient(to right, #780206 0%, #061161  51%, #780206  100%)}
         .btn-grad {
            margin: 10px;
            padding: 15px 45px;
            text-align: center;
            text-transform: uppercase;
            transition: 0.5s;
            background-size: 200% auto;
            color: white;            
            box-shadow: 0 0 20px #eee;
            border-radius: 10px;
            display: block;
          }

          .btn-grad:hover {
            background-position: right center; /* change the direction of the change here */
            color: #fff;
            text-decoration: none;
          }
         
         
         
    </style>
</head>

<body style="background: url('bg-login.jpg');">

    <!-- loader -->
    
    <!-- * loader -->

    <!-- App Header -->
    <div class="appHeader no-border transparent position-absolute">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle"></div>
        <div class="right">
        </div>
    </div>
    <!-- * App Header -->

    <!-- App Capsule -->
    <div id="appCapsule">

        <div class="section mt-2 text-center">
            <img src="logo-white.png" height="75px" width="75px"> 
            <h4 class="text-white">Login to your account</h4>
        </div>
        <div class="section mb-5 p-2">

            <form action="" method="post">
                <div class="card">
                    <div class="card-body pb-1">
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="email1">E-mail</label>
                                <input type="email" class="form-control" id="email1" placeholder="Your e-mail" name="email">
                                <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                            </div>
                        </div>
        
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="password1">Password</label>
                                <input type="password" class="form-control" id="password1" placeholder="Your password" name="password">
                                <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="form-links mt-2">
                    <div>
                        <a class="text-white" href="app-register.php">Need an account?</a>
                    </div>
                    <!--<div><a href="app-forgot-password.html" class="text-muted">Forgot Password?</a></div>-->
                </div>

                <div class="form-button-group  transparent">
                    <input type="submit"  class=" btn btn-grad btn-lg  mr-1" value="Log in" name="login">
                </div>

            </form>
        </div>

    </div>
    <!-- * App Capsule -->



   


</body>



</html>