<?php

	include('conn.php');

	$txtOrderID=$_POST['OrderID'];
	$txtServedQty=$_POST['ServedQty'];

	mysqli_query($conn, "UPDATE tblorders
						 SET Served_Qty3=$txtServedQty, Item_Status3=3
					     WHERE Order_ID=$txtOrderID");

?>