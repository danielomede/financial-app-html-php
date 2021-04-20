<?php
include 'auth.php';
$currentDate = date('Y/m/d');
$currentTime = date('h:i:s');


//INVOICE FUNCTIONS
if(isset($_POST['generate-invoice'])){
    $clientDisplayName = $_POST['clientDisplayName'];
    
    $newClientRef      = generateCode(10);
    $newInvoiceID      = generateCode(10);
    $newInvoiceRef     = generateCode(10);
    
                        
    $sql = "INSERT INTO `clients` (`uid`, `clientRef`, `userRef`, `createdAt`, `displayName`, `email`, `phoneNumber`, `website`, `photoURL`, `address`) VALUES (NULL, '$newClientRef', '$userRef', '$currentDate', '$clientDisplayName', '', '', '', '', '')";
                        
    if (mysqli_query($conn, $sql)){
      echo 'client created successfully';
      $currentInvoice = $newInvoiceRef;
      $client = $_POST['clientDisplayName'];
      $sql2 = "INSERT INTO `invoices` (`uid`, `invoiceRef`, `senderRef`, `clientRef`, `createdAt`, `userRef`, `amountDue`, `amountPaid`, `dueDate`, `companyRef`, `client`) VALUES ('$newInvoiceId', '$newInvoiceRef', '', '$newClientRef', '$currentDate', '$userRef', '', '', '', '$comapnyRef', '$clientDisplayName')";
      
          if (mysqli_query($conn, $sql2)){
          echo 'invoice created successfully';
          $_SESSION['InvoiceRef'] = $newInvoiceRef;
          
          header('Location: '.'app-invoice.php');
            }  
                else {
                echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
                }
        }  
        else {
           echo "Error: " . $sql . "<br>" . mysqli_error($conn);
           }                   
      mysqli_close($conn);                   
}
/*
if(isset($_POST['itemDetails-submit'])){
    $clientDisplayName = $_POST['clientDisplayName'];
    
     $setItemName = $_POST['itemName'];
    $setItemQuantity = $_POST['itemQuantity'];
    $setItemPrice = $_POST['itemPrice'];
    $createItemRef = generateCode(10);
    $thisInvoice = $invoice;
    
    $itemSql = "INSERT INTO `items` (`uid`, `itemRef`, `invoiceRef`, `createdAt`, `userRef`, `displayName`, `quantity`, `companyRef`, `category`, `price`) VALUES (NULL, '$createItemRef', '$invoice', '$currentDate', '$userRef', '$setItemName', '$setItemQuantity', '$myCompanyRef', '', '$setItemPrice')";
                        
    if (mysqli_query($conn, $itemSql)){
      echo 'item Added successfully';
      header('Location: '.'app-invoice.php');
      
        }  
        else {
           echo "Error: " . $itemSql . "<br>" . mysqli_error($conn);
           }                   
      mysqli_close($conn);                   
}
*/

function generateCode($limit){
    $code = '';
    for($i = 0; $i < $limit; $i++) { $code .= mt_rand(0, 9); }
    return $code;
    }
    

?>