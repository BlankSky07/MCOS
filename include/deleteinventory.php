<?php 

include('conn.php');
	
	$txtInventoryID=$_POST['InventoryID'];

	mysqli_query($conn, "DELETE FROM tblinventory
					     WHERE Inventory_ID=$txtInventoryID");

?>