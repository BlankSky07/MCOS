<?php

	include('conn.php');
	
	$txtCustomerName=$_POST['AddCustomerName'];
	$txtCustomerCID=$_POST['AddCustomerCID'];

	mysqli_query($conn, "INSERT INTO tblcustomer (CID, 
												  Customer_Name, 
												  Latest_Update) 
						 VALUES ($txtCustomerCID,
								'$txtCustomerName',
								 CURRENT_TIMESTAMP())");
	
?>