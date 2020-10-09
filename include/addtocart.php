<?php
	include('conn.php');

	$db_server = "localhost";
	$db_username = "root";
	$db_password = "";
	$db_database = "mosdb";

	$con = new PDO("mysql:host=$db_server;dbname=$db_database", $db_username, $db_password);
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$string=exec('getmac');
	$mac=substr($string, 0, 17); 
	echo $mac;

			$query = "SELECT `AUTO_INCREMENT` AS OrderID
						FROM  INFORMATION_SCHEMA.TABLES
						WHERE TABLE_SCHEMA = 'mosdb'
						AND   TABLE_NAME   = 'tblorders'";

			$result = $con->prepare($query);

            $result->execute();

            $row = $result->fetch();

            $orderID = $row['OrderID'];

            echo $orderID;


	$txtUseCase=$_POST['UseCase'];
	$invid1 = (!empty($_POST['InvID1']) ? $_POST['InvID1'] : 0);
  	$invqty1 = (!empty($_POST['InvQTY1']) ? $_POST['InvQTY1'] : 0);

  	$invid2 = (!empty($_POST['InvID2']) ? $_POST['InvID2'] : 0);
  	$invqty2 = (!empty($_POST['InvQTY2']) ? $_POST['InvQTY2'] : 0);

	$invid3 = (!empty($_POST['InvID3']) ? $_POST['InvID3'] : 0);
	$invqty3 = (!empty($_POST['InvQTY3']) ? $_POST['InvQTY3'] : 0);

	$invid4 = (!empty($_POST['InvID4']) ? $_POST['InvID4'] : 0);
	$invqty4 = (!empty($_POST['InvQTY4']) ? $_POST['InvQTY4'] : 0);

	$invid5 = (!empty($_POST['InvID5']) ? $_POST['InvID5'] : 0);
	$invqty5 = (!empty($_POST['InvQTY5']) ? $_POST['InvQTY5'] : 0);

	$custname = (!empty($_POST['CustName']) ? $_POST['CustName'] : 0);

	$custgroup = (!empty($_POST['custgroup']) ? $_POST['custgroup'] : 0);

	switch ($custgroup) {
		  case "MS1":
		    $groupid = 1;
		    break;
		  case "T2K":
		    $groupid = 2;
		    break;
		  case "MS2":
		    $groupid = 3;
		    break;
		  default:
		    $groupid = 4;
		}

	if($custgroup != "--"){
			
			$conn->autocommit(FALSE);


			$conn->query("INSERT INTO tblorders (Customer_Name, 
											 	 Customer_PCName,
												 Order_Date,
												 Inventory_ID1, 
												 Item_Qty1, 
												 Item_Status1, 
												 Inventory_ID2, 
												 Item_Qty2,
												 Item_Status2,
												 Inventory_ID3, 
												 Item_Qty3,
												 Item_Status3,
												 Inventory_ID4, 
												 Item_Qty4,
												 Item_Status4,
												 Inventory_ID5, 
												 Item_Qty5,
												 Item_Status5,
												 Use_Case, 
												 OrderStatus_ID, 
												 MC_ID, 
												 Group_ID,
												 Order_Served) 
						VALUES ('$custname', 
								'$mac',  
								 CURRENT_TIMESTAMP(),
								 $invid1,
								 $invqty1,
								 1,
								 $invid2,
								 $invqty2,
								 1,
								 $invid3,
								 $invqty3,
							 	 1,
								 $invid4,
								 $invqty4,
								 1,
								 $invid5,
								 $invqty5,
								 1,
								 '$txtUseCase', 
								 1, 
								 0, 
								 $groupid,
								'0000-00-00 00:00:00')");


			$conn->query("INSERT INTO tblupdates (Order_ID, OrderStatus_ID) 
				  		  VALUES ($orderID, 1)"); 


			$conn->commit();
			$conn->close();
}
	
?>