<?php

	include('conn.php');

	$file=$_FILES['file']['tmp_name'];
	$image= addslashes(file_get_contents($_FILES['file']['tmp_name']));
	$image_name= addslashes($_FILES['file']['name']);
			
	move_uploaded_file($_FILES["file"]["tmp_name"],"img/inventory/" . $_FILES["file"]["name"]);
			
	$location="include/img/inventory/" . $_FILES["file"]["name"];
	
	$txtMCFName=$_POST['MCFName'];
	$txtMCLName=$_POST['MCLName'];
	$txtMCCID=$_POST['MCCID'];

	mysqli_query($conn, "INSERT INTO tblmc (MC_CID, 
												  MC_Fname, 
												  MC_Lname, 
												  MCStatus_ID,
												  MC_Photo) 
						 VALUES ('$txtMCCID',
						 		 '$txtMCFName',
								 '$txtMCLName',
								 4,
								 '$location')");
	
?>