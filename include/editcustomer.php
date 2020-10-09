<?php

	include('conn.php');

	$txtCustomerID=$_POST['CustomerID'];
	$txtCustomerName=$_POST['CustomerName'];
	$txtCustomerCID=$_POST['CustomerCID'];

	mysqli_query($conn, "UPDATE tblcustomer 
						 SET Customer_Name='$txtCustomerName',
						     Latest_Update=CURRENT_TIMESTAMP()
					     WHERE Customer_ID=$txtCustomerID");

?>