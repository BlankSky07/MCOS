<?php

	include('conn.php');

	$file=$_FILES['file']['tmp_name'];
	$image= addslashes(file_get_contents($_FILES['file']['tmp_name']));
	$image_name= addslashes($_FILES['file']['name']);
			
	move_uploaded_file($_FILES["file"]["tmp_name"],"img/inventory/" . $_FILES["file"]["name"]);
			
	$location="include/img/inventory/" . $_FILES["file"]["name"];

	$txtItemName=$_POST['AddItemName'];
	$txtItemDesc=$_POST['AddItemDesc'];
	$txtItemQty=$_POST['AddItemQty'];

	mysqli_query($conn, "INSERT INTO tblinventory (Item_Name, 
												   Item_Description,
												   Item_Qty,
												   InventoryStatus_ID,
												   Item_Remarks,
												   Photo_Location, 
												   Latest_Update) 
						VALUES ('$txtItemName',
								'$txtItemDesc',
								 $txtItemQty,
								 2,
								 '',
								 '$location',
								 CURRENT_TIMESTAMP())");
	
?>