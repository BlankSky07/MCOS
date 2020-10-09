<?php

	include('conn.php');

	$txtOrderID=$_POST['OrderID'];
	$txtServedQty=$_POST['ServedQty'];

	mysqli_query($conn, "UPDATE tblorders
						 SET Served_Qty5=$txtServedQty, Item_Status5=3
					     WHERE Order_ID=$txtOrderID");

?>