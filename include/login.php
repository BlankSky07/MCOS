<?php
	if(isset($_POST['login'])){
		
		session_start();
		include('conn.php');
	
		$uname=$_POST['uname'];
		$pword=$_POST['pword'];
	
		$query=mysqli_query($conn, "SELECT * FROM `tbllogin` WHERE Uname='$uname' && Pword='$pword'");
	
		if (mysqli_num_rows($query) == 0){
			$_SESSION['message']="Login Failed. User not Found!";
			header('location:../index.php');
		}
		else{
			$row=mysqli_fetch_array($query);
			
			$_SESSION['id']=$row['Login_ID'];
			header('location:../page/admin/admin.php');
		}
			}
			
			else{
				header('location:../index.php');
				$_SESSION['message']="Please Login!";
			}
?>