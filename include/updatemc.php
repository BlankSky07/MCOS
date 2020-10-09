<?php

	include('conn.php');

	$txtOrderID=$_POST['OrderID'];
	$txtMC=$_POST['MC'];

	$conn->autocommit(FALSE); 

    $conn->query("UPDATE tblorders
				  SET MC_ID=$txtMC, 
					  OrderStatus_ID=2, 
					  Item_Status1=2,
				   	  Item_Status2=2,
					  Item_Status3=2,
					  Item_Status4=2,
					  Item_Status5=2
				  WHERE Order_ID=$txtOrderID"); 


    $conn->query("DELETE FROM tblupdates
				  WHERE Order_ID=$txtOrderID"); 

    $conn->query("INSERT INTO tblupdates (Order_ID, OrderStatus_ID) 
				  VALUES ($txtOrderID, 2)"); 

    $conn->commit(); 

    $conn->close();


?>