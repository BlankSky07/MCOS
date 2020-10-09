<?php 

include('conn.php');
	
	$txtID=$_POST['CustomerID'];

	mysqli_query($conn, "DELETE FROM tblcustomer
					     WHERE Customer_ID=$txtID");

?>