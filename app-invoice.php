<?php
include 'auth.php';
include 'app-functions.php';

session_start();
if(!isset($_SESSION["InvoiceRef"])){
header("Location: app-index.php ");
exit(); }

$invoice = $_SESSION['InvoiceRef'];
$query55 = "SELECT * FROM invoices WHERE invoiceRef = '$invoice'";
$result55 = mysqli_query($conn,$query55);
$row55 = mysqli_fetch_array($result55);

$currentInvoice = $row55['invoiceRef'];
$clientRef = $row55['clientRef'];

$query66 = "SELECT * FROM clients WHERE clientRef = '$clientRef'";
$result66 = mysqli_query($conn,$query66);
$row66 = mysqli_fetch_array($result66);
$clientDisplayName = $row66['displayName'];



# $query77 = "SELECT * FROM items WHERE itemRef = '$createItemRef' ";
# $result77 = mysqli_query($conn,$query77);
# $row77 = mysqli_fetch_array($result77);


$update = "UPDATE items SET invoiceRef='$currentInvoice' WHERE itemRef='$createItemRef'";
mysqli_query($conn,$update);


if(isset($_POST['itemDetails-submit'])){
    $invoiceRef = $_POST['invoice'];
    $newItemRef = generateCode(10);
    $setName = $_POST['itemName'];
    $setQuantity = $_POST['itemQuantity'];
    $setPrice = $_POST['itemPrice'];
    $setPtp = $setQuantity * $setPrice;
    
    
    $sql = "INSERT INTO `items` (`uid`, `itemRef`, `invoiceRef`, `createdAt`, `userRef`, `displayName`, `quantity`, `companyRef`, `category`, `price`, `pTp`) VALUES (NULL, '$newItemRef', '$invoiceRef', '$currentDate', '$userRef', '$setName', '$setQuantity', '$companyRef', '', '$setPrice', '$setPtp')";
    if (mysqli_query($conn,$sql)){
    header('Location: '.'app-invoice.php');
    }
    
}

if(isset($_POST['paymentSubmit'])){
    $amount     = $_POST['amount'];
    $invoiceRef = $_POST['invoice'];
    
    $sql = "INSERT INTO `payments` (`id`, `amount`, `invoiceRef`, `createdAt`, 'userRef') VALUES (NULL, '$amount', '$invoiceRef', '$currentDate', '$userRef')";
    
    if (mysqli_query($conn, $sql)){
        
        $sql2 = "SELECT * FROM invoices WHERE invoiceRef = '$invoiceRef'";
        $result = mysqli_query($conn,$sql2);
        $row = mysqli_fetch_array($result);
        $amountPaid = $row['amountPaid'];
        $newBalance = $amount + $amountPaid;
        
            $sql3 = "UPDATE invoices SET amountPaid = $newBalance WHERE invoiceRef = '$invoiceRef'";
            
            if(mysqli_query($conn, $sql3)){
                echo "<script>alert('Payment Recorded')</script>";
                echo "<script>window.open('app-invoice.php','_self')</script>";
            } else {
           echo "Error: " . $sql3 . "<br>" . mysqli_error($conn);
           }                   
      mysqli_close($conn);                   
            
        
        
    }
    
    else {
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
    <title>Hulp Invoice Generator | V 1.3.1 | Brielconcept.org</title>
    <!-- Material Design Theming -->
  <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.orange-indigo.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  
  <script defer src="https://code.getmdl.io/1.1.3/material.min.js"></script>
    
    <link rel="stylesheet" href="assets/css/styleae52.css?v=5">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="description" content="Finapp HTML Mobile Template">
    <meta name="keywords" content="bootstrap, mobile template, mobile, html, wallet, banking, finance" />
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png" sizes="32x32">
    <link rel="shortcut icon" href="assets/img/favicon.png">
    
    <style>
        .btn-black {
            color: white;
            background: #524e61;            
        }
        
    .appBottomMenu {
    min-height: 56px;
    position: fixed;
    z-index: 999;
     width: 95%; 
     
    bottom: 0;
    left: 0;
    right: 0;
    background: #121213;
    display: flex;
    align-items: center;
    justify-content: center;
    /* border-top: 1px solid #DCDCE9; */
    padding-left: 4px;
    padding-right: 4px;
    padding-bottom: env(safe-area-inset-bottom);
    margin-left: 10px;
    margin-right: 15px;
    border-radius: 20px;
}
 
        
    </style>
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
            New Invoice
        </div>
        <div class="right">
            <a href="javascript:;" class="headerButton">
                <ion-icon name="trash-outline"></ion-icon>
            </a>
        </div>
    </div>
    <!-- * App Header -->   
    
    <div id="appCapsule">
        
        <div class="section mt-2 mb-2">


            <div class="listed-detail mt-3">
                <div class="icon-wrapper " >
                    <div class="iconbox btn-dark">
                        <i class="material-icons">account_balance_wallet</i>
                    </div>
                </div>
                <a data-toggle="modal"><h3 class="text-center mt-2">Invoice number</h3></a>
                <h4 class="text-center mt-2"><?php echo $currentInvoice; ?></h4>
            </div>

            <ul class="listview flush transparent simple-listview no-space mt-3">
                <li>
                    <strong>Client:</strong>
                 <a data-toggle="modal" data-target="#clientDialog"> <span class="text-success" ><?php echo $clientDisplayName;  ?></span></a>
                </li>
            </ul>
        </div>
        <br>
        <div class="section mt-2 mb-2">
            
            <div class="pageTitle">
            <a data-toggle="modal" data-target="#itemDialog"> <span class="text-success" >Add Item</span></a>
        </div>
            
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-striped rounded">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col" class="text-right">(₦)Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        <?php
                        
						$result = mysqli_query($conn, "SELECT * FROM `items` WHERE `invoiceRef`= '$invoice' " );
						while ($row = mysqli_fetch_array($result)) {
							$getItemRef = $row['itemRef'];
							$getItemName = $row['displayName'];
							$getItemPrice = $row['price'];
							$getItemQuantity = $row['quantity'];
							$getPtp = $row['pTp'];

							
							echo "<tr>";
        					echo "<td>" .$getItemName. "</td>";
        					echo "<td>" .number_format($getItemPrice). "</td>";
        					echo "<td>" .$getItemQuantity. "</td>";
        					echo "<td>" .number_format($getPtp). "</td>";
    						echo "</tr>";
    						
    						
    						
                        }
						?>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        
        <div class="section inset mt-5">
            <div class="wide-block pt-2 pb-2 text-center" style="background: #1dcc70 !important; color: white;">
                Total: ₦
                <?
                
                $sqlSUM="SELECT sum(pTp) as total FROM items WHERE invoiceRef =  '$currentInvoice'";
                
                $resultSUM = mysqli_query($conn, $sqlSUM);
                
                    while ($rowSUM = mysqli_fetch_assoc($resultSUM))
                    { 
                        $total = $rowSUM['total'];
                        
                        $sql = "UPDATE invoices SET amountDue = $total WHERE invoiceRef = '$currentInvoice';";
                        mysqli_query($conn, $sql);
                        
                        
                        
                       echo  number_format($total); 
                    }
                
                mysqli_close($con);
    
                
                ?>
            </div>
        </div>
     
     
     <div class="section inset mt-5">
            <div class="wide-block pt-2 pb-2 text-center" style="background: orange !important; color: white;">
                Amount Paid: ₦
                <?
                
                $sql="SELECT * FROM invoices WHERE invoiceRef =  '$currentInvoice'";
                
                $result = mysqli_query($conn, $sql);
                
                    while ($row = mysqli_fetch_assoc($result))
                    { 
                        $amountPaid = $row['amountPaid'];
                        
                          echo  number_format($amountPaid); 
                    }
                
                mysqli_close($con);
    
                
                ?>
            </div>
        </div>
        
        
        
        
        
        
        
        <!-- Client Dialog -->
        <div class="modal fade dialogbox" id="clientDialog" data-backdrop="static" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Client's Details</h5>
                    </div>
                    <form name="clientForm" id="clientForm" action="" method="POST" >
                        <div class="modal-body text-left mb-2">

                            <div class="form-group basic">
                                <div class="input-wrapper">
                                    <label class="label" for="text1">Name</label>
                                    <input type="text" class="form-control" id="clientDisplayName" name="clientDisplayName" value="">
                                    <i class="clear-input">
                                        <ion-icon name="close-circle"></ion-icon>
                                    </i>
                                </div>
                            </div>
                            
                            <div class="form-group basic">
                                <div class="input-wrapper">
                                    <label class="label" for="text1">Email</label>
                                    <input type="text" class="form-control" id="clientEmail" name="clientEmail" value="">
                                    <i class="clear-input">
                                        <ion-icon name="close-circle"></ion-icon>
                                    </i>
                                </div>
                            </div>
                            
                            <div class="form-group basic">
                                <div class="input-wrapper">
                                    <label class="label" for="text1">Phone</label>
                                    <input type="text" class="form-control" id="clientPhone" name="clientPhone" value="">
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
                                <input type="submit" data-target="#success" id="clientDetails-submit" class="btn btn-primary btn-block btn-lg" name="clientDetails-submit" value="Submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Client Dialog Form -->
        
        <!-- Item Dialog -->
        <div class="modal fade dialogbox" id="itemDialog" data-backdrop="static" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Item Details</h5>
                    </div>
                    <form action="app-invoice.php" name="itemForm" id="itemForm" method="POST" >
                        <div class="modal-body text-left mb-2">

                            <div class="form-group basic">
                                <div class="input-wrapper">
                                    <label class="label" for="text1">Name</label>
                                    <input type="text" class="form-control" id="itemDisplayName" name="itemName" value="">
                                    <i class="clear-input">
                                        <ion-icon name="close-circle"></ion-icon>
                                    </i>
                                </div>
                            </div>
                            
                            <div class="form-group basic">
                                <div class="input-wrapper">
                                    <label class="label" for="text1">Price</label>
                                    <input type="text" class="form-control" id="itemPrice" name="itemPrice" value="">
                                    <i class="clear-input">
                                        <ion-icon name="close-circle"></ion-icon>
                                    </i>
                                </div>
                            </div>
                            
                            <div class="form-group basic">
                                <div class="input-wrapper">
                                    <label class="label" for="text1">Quantity</label>
                                    <input type="text" class="form-control" id="itemQuantity" name="itemQuantity" value="">
                                    <i class="clear-input">
                                        <ion-icon name="close-circle"></ion-icon>
                                    </i>
                                </div>
                            </div>

                            <div class="form-group basic">
                                <div class="input-wrapper">
                                    <label class="label" for="text1">Invoice</label>
                                    <input type="text" class="form-control" id="invoice" name="invoice" value="<? echo $currentInvoice ?>">
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
                                <input type="submit"  id="itemDetails-submit" class="btn btn-primary btn-block btn-lg" name="itemDetails-submit" value="Submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Item Dialog Form -->
        
        
        <!-- Deposit Action Sheet -->
        <div class="modal fade action-sheet" id="paymentDialog" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">New Payment</h5>
                    </div>
                    <div class="modal-body">
                        <div class="action-sheet-content">
                            <form action="" method="POST">
                                <div class="form-group basic">
                                    <label class="label">Amount</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="input2"></span>
                                        </div>
                                        <input type="text" name="amount" class="form-control form-control-lg" value="">
                                    </div>
                                </div>

                        <div class="form-group basic">
                                    <div class="input-wrapper">
                                        <label class="label" for="text1">Invoice</label>
                                        <input type="text" class="form-control" id="invoice" name="invoice" value="<? echo $currentInvoice ?>">
                                        <i class="clear-input">
                                            <ion-icon name="close-circle"></ion-icon>
                                        </i>
                                    </div>
                                </div>
        


                                <div class="form-group basic">
                                    <input type="submit" style="background: black !important; border-color: black !important;" class="btn btn-primary btn-block btn-lg"
                                     value="Add Payment" name="paymentSubmit">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- * Deposit Action Sheet -->
        
        <!-- DELETE ALL ITEMS ACTION SHEET -->
        
        <div class="modal fade action-sheet inset" id="clearDialog" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="action-sheet-content">
                            <div class="iconbox text-danger">
                                <i class="material-icons">warning</i>
                            </div>
                            <div class="text-center p-2">
                                <h3>Delete Items?</h3>
                            </div>
                            <form action="" method="POST">
                            <div class="form-group basic">
                                    <div class="input-wrapper">
                                        <label class="label" for="text1">Invoice</label>
                                        <input type="text" class="form-control" id="invoice" name="invoice" value="<? echo $currentInvoice ?>">
                                        <i class="clear-input">
                                            <ion-icon name="close-circle"></ion-icon>
                                        </i>
                                    </div>
                                </div>    
                            <input type="submit" class="btn btn-danger btn-lg btn-block" name="deleteItems" value="Delete">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <?
        if(isset($_POST['deleteItems'])){
            $invoiceRef = $_POST['invoice'];;
            $sql = "DELETE FROM `items` WHERE invoiceRef = $invoice";
            
            if(mysqli_query($conn, $sql)){
             echo "<script>window.open('app-invoice.php','_self')</script>";   
            }
            
        }
        
        ?>
        
        <!-- DELETE ALL ITEMS ACTION SHEET -->
        
    </div>
    <!--App capsule end-->
    
        <div class="appBottomMenu">
            
                
                    <div class="col">
                        <a data-toggle="modal" data-target="#paymentDialog" class="item text-success">
                        <h2 class=" text-success">₦</h2>
                        
                        </a>
                    </div>
                    <!--
                    <div class="col">
                        <a data-toggle="modal" data-target="#shareDialog" class="item text-primary">
                            <i class="material-icons" >share</i>
                            
                        </a>
                    </div>
                    -->
                    <div class="col">
                        <a data-toggle="modal" data-target="#clearDialog" class="item text-danger">
                            <i class="material-icons" >clear</i>
                            
                        </a>
                    </div>
                    
                    <div class="col ">
                        <a href="app-index.php" class="item text-light ">
                            <h2 class=" text-light">DONE</h2>
                            
                        </a>
                    </div>
                
            
        </div>
    
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