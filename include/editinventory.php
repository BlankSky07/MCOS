<?php

	include('conn.php');

	$file=$_FILES['file']['tmp_name'];
	$image= addslashes(file_get_contents($_FILES['file']['tmp_name']));
	$image_name= addslashes($_FILES['file']['name']);
			
	move_uploaded_file($_FILES["file"]["tmp_name"],"img/inventory/" . $_FILES["file"]["name"]);
			
	$location="include/img/inventory/" . $_FILES["file"]["name"];

	$imagenamae=$_FILES["file"]["name"];

	$txtInventoryID=$_POST['InventoryID'];
	$txtItemName=$_POST['ItemName'];
	$txtItemDesc=$_POST['ItemDesc'];
	$txtItemRemarks=$_POST['ItemRemarks'];
	$txtItemStatus=$_POST['ItemStatus'];
	$txtItemQty=$_POST['ItemQty'];

	if ($imagenamae != ""){

		mysqli_query($conn, "UPDATE tblinventory 
							 SET Item_Name='$txtItemName', 
							     Item_Description='$txtItemDesc',
							     Item_Qty=$txtItemQty,
							     InventoryStatus_ID=$txtItemStatus,
							     Item_Remarks='$txtItemRemarks',
							     Photo_Location='$location',
							     Latest_Update=CURRENT_TIMESTAMP()
						     WHERE Inventory_ID=$txtInventoryID");

		}

	else{

		mysqli_query($conn, "UPDATE tblinventory 
							 SET Item_Name='$txtItemName', 
								 Item_Description='$txtItemDesc',
								 Item_Qty=$txtItemQty,
								 InventoryStatus_ID=$txtItemStatus,
								 Item_Remarks='$txtItemRemarks',
								 Latest_Update=CURRENT_TIMESTAMP()
							 WHERE Inventory_ID=$txtInventoryID");
	}
	
?>