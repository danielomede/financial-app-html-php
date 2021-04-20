<?php
include 'auth.php';


header('Content-Type: application/json');

$sql = "SELECT amount, createdAt FROM payments WHERE userRef = '$userRef'";

$result = mysqli_query($conn,$sql);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);
?>