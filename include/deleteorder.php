<?php 

include('conn.php');
	
	$txtID=$_POST['OrderID'];

	mysqli_query($conn, "DELETE FROM tblorders
					     WHERE Order_ID=$txtID");


header('location:../page/all-orders.php');

?>