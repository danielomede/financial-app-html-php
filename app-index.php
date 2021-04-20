<?php
include ('auth.php');
session_start();

$sqlSUM="SELECT sum(amount) as total FROM payments WHERE userRef =  '$userRef'";
                
$resultSUM = mysqli_query($conn, $sqlSUM);
$rowSUM = mysqli_fetch_assoc($resultSUM);
$total = $rowSUM['total'];

$earnings =  number_format($total); 

$sqlIn = "SELECT sum(amountPaid) as total FROM invoices WHERE userRef = '$userRef';" ;
$resultIn = mysqli_query($conn,$sqlIn);
$rowIn = mysqli_fetch_assoc($resultIn);
$totalAmountPaid = $rowIn['total'];

$sqlDue = "SELECT sum(amountDue) as total FROM invoices WHERE userRef = '$userRef';" ;
$resultDue = mysqli_query($conn,$sqlDue); 
$rowDue = mysqli_fetch_assoc($resultDue);
$totalAmountDue = $rowDue['total'];

$outstanding = number_format($totalAmountDue - $totalAmountPaid);







?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $displayName; ?></title>
    <link rel="stylesheet" href="assets/css/styleae52.css?v=5">
      <!-- Material Design Theming -->
  <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.orange-indigo.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="keywords" content="bootstrap, mobile template, mobile, html, wallet, banking, finance" />
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png" sizes="32x32">
    <link rel="shortcut icon" href="assets/img/favicon.png">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/Chart.min.js"></script>
    <style>
    .wallet-card-section:before {
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    content: "";
    display: block;
    height: 140px;
    background: #121213;
}

.sidebar-balance {
    background: #121213 !important;
    
}

.action-group {
    background: #121213 ;
}

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
          
          
    
         .icon-grad {
             background-image: linear-gradient(to right, #E55D87 0%, #5FC3E4  51%, #E55D87  100%);
         }
         
        
               

    </style>
</head>

<body style="background: white;">

    

    <!-- App Header -->
    <div class="appHeader bg-primary text-light" style="background:#121213 !important;">
        <div class="left">
            <a href="#" class="headerButton" data-toggle="modal" data-target="#sidebarPanel">
                <i class="material-icons">sort</i>
            </a>
        </div>
        
        <div class="right">
            <a href="" class="headerButton">
               <img src="logo-white.png" height="40px" width="40px"> 
                
            </a>
        </div>
    </div>
    <!-- * App Header -->


    <!-- App Capsule -->
    <div id="appCapsule">
        
    
        <!-- Wallet Card -->
        <div class="section wallet-card-section pt-1">
            <div class="wallet-card">
                <!-- Balance -->
                <div class="balance">
                    <div class="left">
                        <span class="title">Earnings from <? echo $myCompanyName; ?></span>
                        <h1 class="total">₦ <? echo $earnings;?></h1>
                        
                    </div>
                    <div class="right">
                        <a href="#" class="button" data-toggle="modal" data-target="#depositActionSheet">
                            <ion-icon name="add-outline"></ion-icon>
                        </a>
                    </div>
                </div>
                <!-- * Balance -->
                <!-- Wallet Footer -->
                <div class="wallet-footer">
                    <div class="item">
                        <a href="company-setup.php" >
                            <div class="icon-wrapper bg-danger icon-grad">
                                <i class="material-icons">work</i>
                            </div>
                            <strong>My Company</strong>
                        </a>
                    </div>
                    <!--
                    <div class="item">
                        <a href="#" data-toggle="modal" data-target="#sendActionSheet">
                            <div class="icon-wrapper">
                                <i class="material-icons">store</i>
                            </div>
                            <strong>Products</strong>
                        </a>
                    </div>
                    
                    <div class="item">
                        <a href="#" data-toggle="modal" data-target="#exchangeActionSheet">
                            <div class="icon-wrapper bg-warning">
                                <i class="material-icons">request_page</i>
                            </div>
                            <strong>Reports</strong>
                        </a>
                    </div>
                    -->
                </div>
                <!-- * Wallet Footer -->
            </div>
        </div>
        <!-- Wallet Card -->
        
        
        
        <div class="section">
            <div id="chart-container">
        <canvas id="graphCanvas"></canvas>
    </div>

    <script>
        $(document).ready(function () {
            showGraph();
        });


        function showGraph()
        {
            {
                $.post("data.php",
                function (data)
                {
                    console.log(data);
                     var createdAt = [];
                    var amount = [];

                    for (var i in data) {
                        amount.push(data[i].amount);
                        createdAt.push(data[i].createdAt);
                    }

                    var chartdata = {
                        labels: createdAt,
                        datasets: [
                            {
                                label: 'Earnings',
                                backgroundColor: '#49e2ff',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: amount
                            }
                        ]
                    };

                    var graphTarget = $("#graphCanvas");

                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: chartdata
                    });
                });
            }
        }
        </script>
            
        </div>

        <!-- Deposit Action Sheet -->
        <div class="modal fade action-sheet" id="depositActionSheet" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">New Payment</h5>
                    </div>
                    <div class="modal-body">
                        <div class="action-sheet-content">
                            <form action="app-functions.php" method="POST">
                                <div class="form-group basic">
                                    <label class="label">Customer's Name</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="input2"></span>
                                        </div>
                                        <input type="text" name="clientDisplayName" class="form-control form-control-lg" value="">
                                    </div>
                                </div>


                                <div class="form-group basic text-center">
                                    <input type="submit"  class="btn btn-grad btn-lg  mr-1"
                                     value="Generate Invoice" name="generate-invoice">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- * Deposit Action Sheet -->

        

        
        <!-- Stats -->
        <div class="section">
            <div class="row mt-2">
                
                
                <div class="col-6">
                    <div class="stat-box">
                        <div class="title">Money Received</div>
                        <div class="value text-success">₦ <? echo number_format($totalAmountPaid); ?></div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="stat-box">
                        <div class="title">Outstanding</div>
                        <div class="value text-danger">₦ <? echo $outstanding; ?></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- * Stats -->
        
        <br>
        <div class="section mt-2 mb-2">
            
        <div class="pageTitle">
            <a href="clients.php"><h5>Clients</h5></a>
        </div>
            
            
                    <ul class="listview simple-listview inset">
                        
                        
                            
                        <?php
                        
						$result = mysqli_query($conn, "SELECT * FROM invoices WHERE userRef = '$userRef' AND client != ''" );
						while ($row = mysqli_fetch_array($result)) {
							$getClientName = $row['client'];
							$getAmountPaid = $row['amountPaid'];
							$getTotal      = $row['pTp'];
							
							
							echo "<li>";
        					echo "<a href=''>" .$getClientName.  "</a>";
        					echo  "<span class='text-muted'>" .$getAmountPaid. "</span>";
    						echo "</li>";
                        }
						?>
                            
                        
                    </ul>
            
        </div>
       
    <br><br>
    
    </div>
    <!-- * App Capsule -->


    <!-- App Bottom Menu -->
    <div class="appBottomMenu">
        <a href="app-index.php" class="item active">
            <div class="col">
                <ion-icon name="pie-chart-outline"></ion-icon>
                <strong>Overview</strong>
            </div>
        </a>
        <a href="app-settings.php" class="item">
            <div class="col">
                <ion-icon name="settings-outline"></ion-icon>
                <strong>Settings</strong>
            </div>
        </a>
    </div>
    <!-- * App Bottom Menu -->

    <!-- App Sidebar -->
    <div class="modal fade panelbox panelbox-left" id="sidebarPanel" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <!-- profile box -->
                    <div class="profileBox pt-2 pb-2">
                        <div class="image-wrapper">
                            <? echo $displayName;?>
                        </div>
                        
                        <a href="#" class="btn btn-link btn-icon sidebar-close" data-dismiss="modal">
                            <ion-icon name="close-outline"></ion-icon>
                        </a>
                    </div>
                    <!-- * profile box -->
                    <!-- balance -->
                    <div class="sidebar-balance">
                        <div class="listview-title">My Details</div>
                        <div class="in">
                            <h4 class="amount"><? echo $myCompanyName; ?></h4>
                            <h4 class="amount"> Reference: <? echo $companyRef; ?></h4>
                        </div>
                    </div>
                    <!-- * balance -->

                    <!-- action group -->
                    <div class="action-group">
                        <a href="" class="action-button" data-toggle="modal" data-target="#depositActionSheet">
                            <div class="in">
                                <div class="iconbox">
                                    <ion-icon name="add-outline"></ion-icon>
                                </div>
                                New Invoice
                            </div>
                        </a>
                        <a href="app-index.php" class="action-button">
                            <div class="in">
                                <div class="iconbox">
                                    <ion-icon name="arrow-down-outline"></ion-icon>
                                </div>
                                Withdraw
                            </div>
                        </a>
                        <a href="app-index.php" class="action-button">
                            <div class="in">
                                <div class="iconbox">
                                    <ion-icon name="arrow-forward-outline"></ion-icon>
                                </div>
                                Send
                            </div>
                        </a>
                    </div>
                    <!-- * action group -->

                    

                    <!-- others -->
                    <div class="listview-title mt-1">Quick Links</div>
                    <ul class="listview flush transparent no-line image-listview">
                        
                        <li>
                            <a href="" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="chatbubble-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Clients
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="chatbubble-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Settings
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="chatbubble-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Receipts
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="app-login.php" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="log-out-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Log out
                                </div>
                            </a>
                        </li>
                    </ul>
                    <!-- * others -->

                    

                </div>
            </div>
        </div>
    </div>
    <!-- * App Sidebar -->

    <!-- ///////////// Js Files ////////////////////  -->
    <!-- Jquery -->
    <script src="assets/js/lib/jquery-3.4.1.min.js"></script>
    <!-- Bootstrap-->
    <script src="assets/js/lib/popper.min.js"></script>
    <script src="assets/js/lib/bootstrap.min.js"></script>
    <!-- Ionicons -->
    <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
    <script src="https://cdnjs.com/libraries/Chart.js"></script>
    

</body>

</html>