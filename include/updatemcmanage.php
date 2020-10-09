<?php

	include('conn.php');

	$file=$_FILES['file']['tmp_name'];
	$image= addslashes(file_get_contents($_FILES['file']['tmp_name']));
	$image_name= addslashes($_FILES['file']['name']);
			
	move_uploaded_file($_FILES["file"]["tmp_name"],"img/inventory/" . $_FILES["file"]["name"]);
			
	$location="include/img/inventory/" . $_FILES["file"]["name"];

	$imagenamae=$_FILES["file"]["name"];

	$txtMCFName=$_POST['MCFName'];
	$txtMCLName=$_POST['MCLName'];
	$txtMCCID=$_POST['MCCID'];
	$txtMCID=$_POST['MCID'];

	if ($imagenamae != ""){

		mysqli_query($conn, "UPDATE tblmc
							 SET MC_CID=$txtMCCID, 
							 	 MC_Fname='$txtMCFName',
							 	 MC_Lname='$txtMCLName',
							 	 MC_Photo='$location'
						     WHERE MC_ID=$txtMCID");

	}

	else{

		mysqli_query($conn, "UPDATE tblmc
							 SET MC_CID=$txtMCCID, 
							 	 MC_Fname='$txtMCFName',
							 	 MC_Lname='$txtMCLName'
						     WHERE MC_ID=$txtMCID");

	}

	
?>