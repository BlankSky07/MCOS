<?php

	include('conn.php');

	$txtOrderID=$_POST['OrderID'];
	$txtServedQty=$_POST['ServedQty'];

	mysqli_query($conn, "UPDATE tblorders
						 SET Served_Qty2=$txtServedQty, Item_Status2=3
					     WHERE Order_ID=$txtOrderID");

	echo $txtOrderID .' and '. $txtServedQty

?>