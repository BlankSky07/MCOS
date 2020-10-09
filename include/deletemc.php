<?php 

include('conn.php');
	
	$txtID=$_POST['MCID'];

	mysqli_query($conn, "DELETE FROM tblmc
					     WHERE MC_ID=$txtID");

?>