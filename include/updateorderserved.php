<?php

	include('conn.php');

	$txtOrderID=$_POST['OrderID'];

	mysqli_query($conn, "UPDATE tblorders
						 SET OrderStatus_ID=4, Order_Served=CURRENT_TIMESTAMP()
					     WHERE Order_ID=$txtOrderID");

	$conn->query("DELETE FROM tblupdates
				  WHERE Order_ID=$txtOrderID"); 

	$conn->query("INSERT INTO tblupdates (Order_ID, OrderStatus_ID) 
				  VALUES ($txtOrderID, 4)"); 

    $conn->commit(); 

    $conn->close();

?>