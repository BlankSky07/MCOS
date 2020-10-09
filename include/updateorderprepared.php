<?php

	include('conn.php');

	$txtOrderID=$_POST['OrderID'];

	mysqli_query($conn, "UPDATE tblorders
						 SET OrderStatus_ID=3
					     WHERE Order_ID=$txtOrderID");

	$conn->query("DELETE FROM tblupdates
				  WHERE Order_ID=$txtOrderID"); 

	$conn->query("INSERT INTO tblupdates (Order_ID, OrderStatus_ID) 
				  VALUES ($txtOrderID, 3)"); 

    $conn->commit(); 

    $conn->close();

?>