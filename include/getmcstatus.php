<?php 

include('connection.php');

    $MCID = $_POST['MCID']; 

    $result = $conn->prepare("SELECT tblmc.MC_Fname, tblmc.MC_Lname, tblmc.MC_Photo, tblmcstatus.Status, tblmc.MCStatus_ID
							  FROM tblmc 
							  LEFT JOIN tblmcstatus ON tblmcstatus.MCStatus_ID = tblmc.MCStatus_ID 
							  WHERE tblmc.MC_CID ='$MCID'");
    $result->execute();
                
    $row = $result->fetch(); 

    	if ($row['Status'] == "Not Available"){
    		$NewStatus = "Available";
    	}

    	elseif($row['Status'] == "Available"){
    		$NewStatus = "Not Available";
    	}

                echo '<div class=".u-full-width">
				          <div class=".u-full-width">
				            <hr>
				            <br>
				            <label style="font-size:50px;">Name: <strong>'.$row['MC_Fname'].' '.$row['MC_Lname'].'</strong></label>
				            <br>
				            <label style="font-size:80px;">Status: <strong>'.$NewStatus.'</strong></label>
				          </div>
				        </div>';

				        include('conn.php');

				        if($row['MCStatus_ID'] == 1){
				        	
						$query=mysqli_query($conn, "UPDATE tblmc 
													SET MCStatus_ID=4
													WHERE MC_CID=$MCID");
				        }

				        elseif($row['MCStatus_ID'] == 4){

						$query=mysqli_query($conn, "UPDATE tblmc 
												    SET MCStatus_ID=1
											        WHERE MC_CID=$MCID");

				        }


?>