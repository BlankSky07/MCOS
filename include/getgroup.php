<?php 

include('connectionEE.php');

if(isset($_POST['NewCID'])){ 

    $NewCID = $_POST['NewCID']; 

    $result = $conn->prepare("SELECT Group1
                                        FROM emp_name
                                        WHERE CID = ".$NewCID."");
    $result->execute();
                
    $row = $result->fetch(); 

                echo $row['Group1'];

        }


?>