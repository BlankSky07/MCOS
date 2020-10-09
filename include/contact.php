<?php

	include('conn.php');
	
	$txtContactName=$_POST['contactname'];
	$txtEmail=$_POST['contactemail'];
	$txtSubject=$_POST['contactsubject'];
	$txtMessage=$_POST['contactmessage'];


	mysqli_query($conn, "INSERT INTO tblcontact (Contact_Name, 
									   			 Contact_Email, 
												 Contact_Subject, 
												 Contact_Message, 
												 Contact_Date) 
						 VALUES ('$txtContactName', 
								 '$txtEmail',
								 '$txtSubject',
								 '$txtMessage',
								  CURRENT_DATE())");

	header('location:../page/index/about.php');
	
?>