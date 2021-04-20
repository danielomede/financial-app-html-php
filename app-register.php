<?php
include ('config.php');
session_start();


if (isset($_POST['register'])) {

function generateCode($limit){
$code = '';
for($i = 0; $i < $limit; $i++) { $code .= mt_rand(0, 9); }
return $code;
}
#echo generateCode(10);

$usercode= generateCode(10);
$userRef = 'USR'  + $usercode;
$displayName = $_POST['displayName'];
$email = $_POST['email'];
$password = $_POST['password'];
$password2 = $_POST['password2'];
$passwordhash = md5($password);
$createdAt = date("Y/m/d");
        if ($password != $password2){
            echo "Passwords do not match";
        } else {
                    $sql = "INSERT INTO `users` (`uid`, `displayName`, `photoURL`, `email`, `emailVerified`, `phoneNumber`, `password`, `companyRef`, `lastLoginAt`, `createdAt`)
                                         VALUES (NULL, '$displayName', '', '$email', '0', '', '$passwordhash', '', '', '$createdAt')";
                    if (mysqli_query($conn, $sql)) {
                        //$_SESSION['email']=$email;
                        $to_email = $email;
                        $subject = 'Hulp - Verify Your Email  ';
                        $url = '<a href="http://brielconcept.org/2/verify-email.php"></a>';
                        $message = 'Dear '  .$displayName. ', Thank you for choosing to register with us. Please click on the link to verify your account.' .$url;
                        #$message .= "<html><head></head><body><img src='' alt='' /></body></html>";
                        $headers = 'From: noreply@brielconcept.org';
                        #$headers .= "Content-type: text/html";
                         mail($to_email,$subject,$message,$headers);
                        header('Location: '.'company-setup.php');
                        
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
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
    <title>Register | HULP</title>
    <link rel="stylesheet" href="assets/css/styleae52.css?v=5">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="description" content="Finapp HTML Mobile Template">
    <meta name="keywords" content="bootstrap, mobile template, mobile, html, wallet, banking, finance" />
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png" sizes="32x32">
    <link rel="shortcut icon" href="assets/img/favicon.png">
    
       <style>
        
         .btn-grad {background-image: linear-gradient(to right, #DC2424 0%, #4A569D  51%, #DC2424  100%)}
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

<body style="background: url('bg3.jpg');">

    

    <!-- App Header -->
    <div class="appHeader no-border transparent position-absolute">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle"></div>
        <div class="right">
            <a href="app-login.php" class="headerButton text-white">
                Login
            </a>
        </div>
    </div>
    <!-- * App Header -->

    <!-- App Capsule -->
    <div id="appCapsule">

        <div class="section mt-2 text-center">
            <img src="logo-white.png" height="75px" width="75px"> 
            
        </div>
        <div class="section mb-5 p-2">
            <form action="" method="POST">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="fullname1">Full Name</label>
                                <input type="text" class="form-control" id="fullname" placeholder="Your Full Name" name="displayName">
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>
                        
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="email1">E-mail</label>
                                <input type="email" class="form-control" id="email1" placeholder="Your e-mail" name="email">
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>
        
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="password1">Password</label>
                                <input type="password" class="form-control" id="password1" placeholder="Your password" name="password">
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>
        
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="password2">Password Again</label>
                                <input type="password" class="form-control" id="password2" placeholder="Type password again" name="password2">
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>

                        <div class="custom-control custom-checkbox mt-2 mb-1">
                            <input type="checkbox" class="custom-control-input" id="customChecka1">
                            <label class="custom-control-label" for="customChecka1">
                                I agree to the <a href="#" data-toggle="modal" data-target="#termsModal">terms and conditions</a>
                            </label>
                        </div>
        
                    </div>
                </div>



                <div class="form-button-group transparent">
                    <input type="submit" data-target="#success"  id="register-submit" class="btn btn-grad btn-lg  mr-1" name="register" value="Register">
                </div>

            </form>
        </div>

    </div>
    <!-- * App Capsule -->


    <!-- Terms Modal -->
    <div class="modal fade modalbox" id="termsModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Terms and Conditions</h5>
                    <a href="javascript:;" data-dismiss="modal">Close</a>
                </div>
                <div class="modal-body">
                    <p>
                       You acknowledge that by accessing and using this website you unconditionally accept all provisions
                       of these Terms and Conditions and the disclaimers and limitations of liability contained herein.
                       If you do not accept any part of these Terms and Conditions and Gatehouse Bank’s website privacy policy
                       (which should be read in conjunction with, and which is governed by, these Terms and Conditions)
                       you are not permitted to use this website and should refrain from doing so. 
                       
                    </p>
                    <p>
                        You represent, warrant and undertake not to use this website for any purpose that is unlawful under
                       any applicable law or prohibited by these Terms and Conditions. You agree not to take any action, alone,
                       or with others that would interfere with the operation of this website, to alter this website in any way, 
                       or to impede others’ access to and freedom to enjoy and use this website. Unauthorised use of this
                       website may give rise to a claim for damages and/or be a criminal offence.
                    </p>
                    <p>
                       Nothing on this website constitutes or forms part of any offer for sale or subscription of, 
                       or any invitation to offer to buy or subscribe for, any securities or other financial instruments,
                       nor should it or any part of it form the basis of, or be relied upon in any connection with any contract or commitment whatsoever.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- * Terms Modal -->
    <div class="modal fade action-sheet" id="success" tabindex="-1" role="dialog">
    <div class='modal-dialog' role='document'>
                                    <div class='modal-content'>
                                        <div class='modal-body'>
                                            <div class='action-sheet-content'>
                                                <div class='iconbox text-success'>
                                                    <ion-icon name='checkmark-circle'></ion-icon>
                                                </div>
                                                <div class='text-center p-2'>
                                                    <h3>Success</h3>
                                                    <p>Your account has been created successfully.</p>
                                                    <p>We will get in touch with you.</p>
                                                </div>
                                                <a href='https://gatehouse-bank.com/fl-index.html' class='btn btn-primary btn-lg btn-block' data-dismiss='modal'>Done</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>

   <!-- ///////////// Js Files ////////////////////  -->
    <!-- Jquery -->
    <script src="assets/js/lib/jquery-3.4.1.min.js"></script>
    <!-- Bootstrap-->
    <script src="assets/js/lib/popper.min.js"></script>
    <script src="assets/js/lib/bootstrap.min.js"></script>
    <!-- Ionicons -->
    <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
   

</body>



</html>