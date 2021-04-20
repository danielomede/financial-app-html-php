<?php
include 'config.php';
include 'auth.php';

if (isset($_POST['companyDisplayName-submit'])) {

$companyDisplayName = $_POST['companyDisplayName'];
    function generateCode($limit){
    $code = '';
    for($i = 0; $i < $limit; $i++) { $code .= mt_rand(0, 9); }
    return $code;
    }
    #echo generateCode(10);
    $companyCode= generateCode(10);
    $newCompanyRef = 'CMP'  + $companyCode;
    $createdAt = date("Y/m/d");

                    $sql = "INSERT INTO `company` (`uid`, `companyRef`, `userRef`, `createdAt`, `displayName`, `photoURL`, `sector`, `address`, `companyInfo`, `inviteCode`)
                            VALUES (NULL, '$newCompanyRef', '$userRef', '$createdAt', '$companyDisplayName', '', '', '', '', '')";
                    if (mysqli_query($conn, $sql)) {
                        
                        $sql2 = "UPDATE users SET companyRef='$newCompanyRef' WHERE uid ='$userRef'";
                        
                        if(mysqli_query($conn, $sql2)){
                            header('Location: '.'company-setup.php');
                        }
                        
                        
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
        
                mysqli_close($conn);
         
}

if (isset($_POST['sector-submit'])) {

 $sector = $_POST['Sectors'];
    

                    $sql3 = "UPDATE company SET sector ='$sector' WHERE companyRef ='$companyRef'";
                    if (mysqli_query($conn, $sql3)) {
                        
                        header('Location: '.'company-setup.php');
                        
                        
                        
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
        
                mysqli_close($conn);
         
}

if (isset($_POST['companyAddress-submit'])) {

 $address = $_POST['address'];
    

                    $sql4 = "UPDATE company SET address ='$address' WHERE companyRef ='$companyRef'";
                    if (mysqli_query($conn, $sql4)) {
                        
                        header('Location: '.'company-setup.php');
                        
                        
                        
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
        
                mysqli_close($conn);
         
}

if (isset($_POST['companyInfo-submit'])) {

$companyInfo = $_POST['companyInfo'];
    

                    $sql5 = "UPDATE company SET companyInfo ='$companyInfo' WHERE companyRef ='$companyRef'";
                    if (mysqli_query($conn, $sql5)) {
                        
                        header('Location: '.'company-setup.php');
                        
                        
                        
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
        
                mysqli_close($conn);
         
}

?>
<!doctype html>
<html lang="en">
<head>
        <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Register your business</title>
    <!-- Material Design Theming -->
  <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.orange-indigo.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="assets/material-dashboard.min1c51.css">
  <script defer src="https://code.getmdl.io/1.1.3/material.min.js"></script>
    
    <link rel="stylesheet" href="assets/css/styleae52.css?v=5">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="description" content="Finapp HTML Mobile Template">
    <meta name="keywords" content="bootstrap, mobile template, mobile, html, wallet, banking, finance" />
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png" sizes="32x32">
    <link rel="shortcut icon" href="assets/img/favicon.png">
    
    
</head>
<body class="bg-white">
    
    <!-- App Header -->
    <div class="appHeader">
        <div class="left">
            <a href="#" class="headerButton goBack">
                <i class="material-icons">keyboard_arrow_left</i>
            </a>
        </div>
        <div class="pageTitle">
            Register Your Business
        </div>
        <div class="right">
            <a href="javascript:;" class="headerButton">
                <ion-icon name="trash-outline"></ion-icon>
            </a>
        </div>
    </div>
    <!-- * App Header -->   
    
    
    <!-- App Capsule -->
    <div id="appCapsule">

        <div class="section mt-2 mb-2">


            <div class="listed-detail mt-3">
                <div class="icon-wrapper">
                  
                        <img src="logo-white.png" height="75px" width="75px" >
                        
                  
                </div>
                
            </div>

            <ul class="listview flush transparent simple-listview no-space mt-3">
                <li>
                    <strong>Business Name</strong>
                 <a data-toggle="modal" data-target="#displayNameDialog"> <span class="text-success" >Edit</span></a>
                </li>
                <li>
                    <strong>Industry/Sector</strong>
                 <a data-toggle="modal" data-target="#sectorDialog"> <span class="text-success" >Edit</span></a>
                </li>
                <li>
                    <strong>Address</strong>
                    <a data-toggle="modal" data-target="#addressDialog"> <span class="text-success" >Edit</span></a>
                </li>
                <li>
                    <strong>Company description</strong>
                    <a data-toggle="modal" data-target="#infoDialog"> <span class="text-success" >Edit</span></a>
                </li>
                
            </ul>
            
        </div>
        
        <!-- Company Logo Dialog -->
        <div class="modal fade dialogbox" id="companyLogoDialog" data-backdrop="static" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Upload Your Logo</h5>
                    </div>
                    <form action="uploads/upload.php" method="post" enctype="multipart/form-data">
                        <div class="custom-file-upload">
                            <input type="file" id="fileuploadInput" accept=".png, .jpg, .jpeg">
                            <label for="fileuploadInput">
                                <span>
                                    <strong>
                                        <ion-icon name="arrow-up-circle-outline" role="img" class="md hydrated" aria-label="arrow up circle outline"></ion-icon>
                                        <i>Upload a Picture</i>
                                    </strong>
                                </span>
                            </label>
                        </div>
                        <div class="modal-footer">
                            <div class="btn-inline">
                                <button type="button" class="btn btn-text-secondary"
                                    data-dismiss="modal">CANCEL</button>
                                <input type="submit" data-target="#success" id="companyLogo-submit" class="btn btn-primary btn-block btn-lg" name="companyLogo-submit" value="Upload Image">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- company Logo Dialog -->
        
        
        <!-- Business Name Dialog -->
        <div class="modal fade dialogbox" id="displayNameDialog" data-backdrop="static" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Name Your Business</h5>
                    </div>
                    <form action="" method="POST">
                        <div class="modal-body text-left mb-2">

                            <div class="form-group basic">
                                <div class="input-wrapper">
                                    <label class="label" for="text1">Business Name</label>
                                    <input type="text" class="form-control" id="companyDisplayName" name="companyDisplayName" value="<?php if(isset($_POST['companyDisplayName'])){ echo $companyDisplayName;} ?>">
                                    <i class="clear-input">
                                        <ion-icon name="close-circle"></ion-icon>
                                    </i>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <div class="btn-inline">
                                <button type="button" class="btn btn-text-secondary"
                                    data-dismiss="modal">CANCEL</button>
                                <input type="submit" data-target="#success" id="companyDisplayName-submit" class="btn btn-primary btn-block btn-lg" name="companyDisplayName-submit" value="Submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Business Dialog Form -->
        
        <!-- Sector Dialog -->
        <div class="modal fade dialogbox" id="sectorDialog" data-backdrop="static" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Business Sector</h5>
                    </div>
                    <form action="" method="POST">
                        <div class="modal-body text-left mb-2">

                            <div class="form-group basic">
                                <div class="input-wrapper">
                                    
                                     <select class="form-control custom-select" name="Sectors">
                                      <option value="" disabled selected>Choose option</option>
                                      <option value="Agriculture">Agriculture</option>
                                      <option value="Aviation">Aviation</option>
                                      <option value="Commercial/Retail">Commercial/Retail</option>
                                      <option value="Education and Training">Education and Training</option>
                                      <option value="Energy and Power Generation">Energy and Power Generation</option>
                                      <option value="FMCG">FMCG</option>
                                      <option value="Fashion">Fashion</option>
                                      <option value="Financial Services">Financial Services</option>
                                      <option value="Haulage/Logistics">Haulage/Logistics</option>
                                      <option value="Healthcare">Healthcare</option>
                                      <option value="Information Technology">Information Technology</option>
                                      <option value="Manufacturing">Manufacturing</option>
                                      <option value="Media and Entertainment">Media and Entertainment</option>
                                      <option value="Oil & Gas">Oil & Gas</option>
                                      <option value="Professional Services">Professional Services</option>
                                      <option value="Telecommunication">Telecommunication</option>
                                      <option value="Tourism/Hospitality">Tourism/Hospitality</option>
                                      <option value="Transportation">Transportation</option>
                                      <option value="Waste Management">Waste Management</option>
                                    </select>
                                    <i class="clear-input">
                                        <ion-icon name="close-circle"></ion-icon>
                                    </i>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <div class="btn-inline">
                                <button type="button" class="btn btn-text-secondary"
                                    data-dismiss="modal">CANCEL</button>
                                <input type="submit" data-target="#success" id="sector-submit" class="btn btn-primary btn-block btn-lg" name="sector-submit" value="Submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Sector Dialog Form -->
        
        <!-- Address Dialog -->
        <div class="modal fade dialogbox" id="addressDialog" data-backdrop="static" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Office Address</h5>
                    </div>
                    <form action="" method="POST">
                        <div class="modal-body text-left mb-2">

                            <div class="form-group basic">
                                <div class="input-wrapper">
                                    
                                    <input type="text" class="form-control" id="address" name="address" value="">
                                    <i class="clear-input">
                                        <ion-icon name="close-circle"></ion-icon>
                                    </i>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <div class="btn-inline">
                                <button type="button" class="btn btn-text-secondary"
                                    data-dismiss="modal">CANCEL</button>
                                <input type="submit" data-target="#success" id="companyAddress-submit" class="btn btn-primary btn-block btn-lg" name="companyAddress-submit" value="Submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Address Form -->
        
        <!-- Description Dialog -->
        <div class="modal fade dialogbox" id="infoDialog" data-backdrop="static" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tell us about your business</h5>
                    </div>
                    <form action="" method="POST">
                        <div class="modal-body text-left mb-2">

                            <div class="form-group basic">
                                <div class="input-wrapper">
                                    <label class="label" for="text1"></label>
                                    <input type="text" class="form-control" id="companyInfo" name="companyInfo" value="">
                                    <i class="clear-input">
                                        <ion-icon name="close-circle"></ion-icon>
                                    </i>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <div class="btn-inline">
                                <button type="button" class="btn btn-text-secondary"
                                    data-dismiss="modal">CANCEL</button>
                                <input type="submit" data-target="#success" id="companyAddress-submit" class="btn btn-primary btn-block btn-lg" name="companyInfo-submit" value="Submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Description Dialog End -->
        
        
        <div class="section mt-2 mb-2">
            <div class="listed-detail mt-3">
                <h3 class="text-center mt-2">Details</h3>
            </div>
            
        <ul class="listview flush transparent simple-listview no-space mt-3">
                <li>
                    <strong>Business Name</strong>
                    <span><?php echo $myCompanyName; ?></span>
                </li>
                <li>
                    <strong>Sector</strong>
                 <span><?php echo $myCompanySector; ?></span>
                </li>
                <li>
                    <strong>Address</strong>
                    <span><?php echo $myCompanyAddress; ?></span>
                </li>
                <li>
                    <strong>Company description</strong>
                    <span><?php echo $myCompanyInfo; ?></span>
                </li>
                
            </ul>
            
            <a href="app-index.php"  style="background: black !important; border-color: black !important;" class="btn btn-primary btn-block btn-lg" name="generate-invoice">Go Home</a>
            
        </div>


    </div>
    <!-- * App Capsule -->

    <!-- ///////////// Js Files ////////////////////  -->
    <!-- Jquery -->
    <script src="assets/js/lib/jquery-3.4.1.min.js"></script>
    <!-- Bootstrap-->
    <script src="assets/js/lib/popper.min.js"></script>
    <script src="assets/js/lib/bootstrap.min.js"></script>
    <!-- Ionicons -->
    <script src="../../unpkg.com/ionicons%405.0.0/dist/ionicons.js"></script>
    <!-- Owl Carousel -->
    <script src="assets/js/plugins/owl-carousel/owl.carousel.min.js"></script>
</body>