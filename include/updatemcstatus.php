<?php

	include('conn.php');

	$txtMCID=$_POST['MCID'];
	$txtMCStatus=$_POST['MCStatus'];

	mysqli_query($conn, "UPDATE tblmc
						 SET MCStatus_ID=$txtMCStatus
					     WHERE MC_CID=$txtMCID");

	mysqli_query($conn, "INSERT INTO tblloghistory(CID, 
										    Log_Date, 
											Log_Status) 
						 VALUES ($txtMCID,
						 		 CURRENT_TIMESTAMP(),
								 $txtMCStatus)");

?>