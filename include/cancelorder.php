<?php

	include('conn.php');

	if(isset($_POST['getOrderID'])){
	
		$txtID=$_POST['getOrderID'];

		mysqli_query($conn, "UPDATE tblorders 
						     SET OrderStatus_ID=5, 
						     	 Order_Cancelled=CURRENT_TIMESTAMP()
					    	 WHERE Order_ID=$txtID");
	}

?>