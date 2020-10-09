<?php

	include('conn.php');

	$txtOrderID=$_POST['OrderID'];
	$txtServedQty=$_POST['ServedQty'];

	mysqli_query($conn, "UPDATE tblorders
						 SET Served_Qty1=$txtServedQty, Item_Status1=3
					     WHERE Order_ID=$txtOrderID");

	echo $txtOrderID .' and '. $txtServedQty

?>