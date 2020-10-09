<?php
  session_start();
  
  if (!isset($_SESSION['id']) ||(trim ($_SESSION['id']) == '')) {
    header('../../index.php');
    exit();
  }

  include('../../include/conn.php');
  $query=mysqli_query($conn,"SELECT * FROM tbluser WHERE User_ID='".$_SESSION['id']."'");
  $row=mysqli_fetch_assoc($query);

?>


<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>MC Ordering System - Mainscreen View</title>
  
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css'>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/css/dataTables.bootstrap4.css'>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css'>
  <link rel="stylesheet" href="../../include/css/style.css">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>

<meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body onload=loadlink()>

<!--------------------------------Page Content-------------------------------->
<div class="content-wrapper" style="margin-left:-1px; margin-top:-20px ; ">

<div class="main-header" style="height:65px;">
        <div class="main-header__intro-wrapper">
          <div class="main-header__welcome">
            
            <div class="main-header__welcome-title text-light" style="padding-bottom:80px;">
              <strong>O</strong>rder List
            </div>

            <div class="main-header__welcome-subtitle text-light">
            </div>

          </div> <!--Main Header Welcome-->
        </div> <!--Main Header Intro Wrapper-->
      </div>  <!--Main Header-->
   <div class="container-fluid">

<div class="edit" id="mainscreen">

<div class="cardo">

  <div class="cardo">

    <div class="documents">

      <div class="table-responsive">

      <table class="table table-bordered" id="mainscreenTable" width="100%" cellspacing="0">
              
          <thead>
            <tr>
              <th style="border-color: black;">Order #</th>
              <th style="border-color: black;">Customer</th>
              <th style="border-color: black;">Group</th>
              <th style="border-color: black;">Order Date</th>
              <th style="border-color: black;">No. of Items</th>
              <th style="border-color: black;">MC Personnel</th>
              <th style="border-color: black;">Status</th>
              <th style="border-color: black;">Duration</th>
            </tr>
          </thead>

        <tbody>

          <?php require('../../include/connection.php');

          $PCNamae = gethostname();

            $result = $conn->prepare("SELECT tblorders.Order_ID,
                                             tblorders.Customer_Name,
                                             tblorders.Order_Date,
                                             a.Item_Name AS Item1,
                                             a.Item_Description AS Desc1,
                                             tblorders.Item_Qty1 AS Qty1,
                                             tblorders.Served_Qty1 AS ServedQty1,
                                             aa.Item_Status AS Stat1,
                                             ab.Item_Name AS Item2,
                                             ab.Item_Description AS Desc2,
                                             tblorders.Item_Qty2 AS Qty2,
                                             abb.Item_Status AS Stat2,
                                             tblorders.Served_Qty2 AS ServedQty2,
                                             abc.Item_Name AS Item3,
                                             abc.Item_Description AS Desc3,
                                             tblorders.Item_Qty3 AS Qty3,
                                             abcc.Item_Status AS Stat3,
                                             tblorders.Served_Qty3 AS ServedQty3,
                                             abcd.Item_Name AS Item4,
                                             abcd.Item_Description AS Desc4,
                                             tblorders.Item_Qty4 AS Qty4,
                                             abcdd.Item_Status AS Stat4,
                                             tblorders.Served_Qty4 AS ServedQty4,
                                             abcde.Item_Name AS Item5,
                                             abcde.Item_Description AS Desc5,
                                             tblorders.Item_Qty5 AS Qty5,
                                             abcdee.Item_Status AS Stat5,
                                             tblorders.Served_Qty5 AS ServedQty5,
                                             tblorders.Use_Case,
                                             tblorderstatus.Order_Status,
                                             tblorders.Order_Served,
                                             tblgroup.Group_Name,
                                             (ABS(tblorders.Inventory_ID1 NOT LIKE 0) +
                                             ABS(tblorders.Inventory_ID2 NOT LIKE 0) +
                                             ABS(tblorders.Inventory_ID3 NOT LIKE 0) +
                                             ABS(tblorders.Inventory_ID4 NOT LIKE 0) +
                                             ABS(tblorders.Inventory_ID5 NOT LIKE 0)
                                             ) AS ItemNumber,
                                             tblmc.MC_Fname,
                                             TIMEDIFF(DATE_FORMAT(CURRENT_TIMESTAMP, '%d %H:%i:%s'),DATE_FORMAT(tblorders.Order_Date, '%d %H:%i:%s')) AS Duration
                                      FROM tblorders
                                      LEFT JOIN tblinventory a ON a.Inventory_ID = 
                                                                tblorders.Inventory_ID1    
                                      LEFT JOIN tblinventory ab ON ab.Inventory_ID = 
                                                                tblorders.Inventory_ID2
                                      LEFT JOIN tblinventory abc ON abc.Inventory_ID = 
                                                                tblorders.Inventory_ID3  
                                      LEFT JOIN tblinventory abcd ON abcd.Inventory_ID = 
                                                                tblorders.Inventory_ID4  
                                      LEFT JOIN tblinventory abcde ON abcde.Inventory_ID = 
                                                                tblorders.Inventory_ID5  
                                      LEFT JOIN tblitemstatus aa ON aa.ItemStatus_ID = 
                                                                tblorders.Item_Status1    
                                      LEFT JOIN tblitemstatus abb ON abb.ItemStatus_ID = 
                                                                tblorders.Item_Status2
                                      LEFT JOIN tblitemstatus abcc ON abcc.ItemStatus_ID = 
                                                                tblorders.Item_Status3
                                      LEFT JOIN tblitemstatus abcdd ON abcdd.ItemStatus_ID = 
                                                                tblorders.Item_Status4 
                                      LEFT JOIN tblitemstatus abcdee ON abcdee.ItemStatus_ID = 
                                                                tblorders.Item_Status5          
                                      LEFT JOIN tblorderstatus ON tblorderstatus.OrderStatus_ID = 
                                                                  tblorders.OrderStatus_ID 
                                      LEFT JOIN tblmc ON tblmc.MC_ID = tblorders.MC_ID
                                      LEFT JOIN tblgroup ON tblgroup.Group_ID = tblorders.Group_ID
                                      WHERE tblorders.OrderStatus_ID != 4
                                      ORDER BY tblorders.OrderStatus_ID, tblorders.Order_ID DESC");
            $result->execute();

              for($i=0; $row = $result->fetch(); $i++){ ?>
                <?php if($row['Order_Status']=='On-Queue'){ ?>
                <tr>

                  <td style="border-color: black; background-color:#ffb3b3;"><?php echo $row['Order_ID'];?></td>
                   <td style="border-color: black; background-color:#ffb3b3;"><?php echo $row['Customer_Name'];?></td>
                   <td style="border-color: black; background-color:#ffb3b3;"><?php echo $row['Group_Name'];?></td>
                   <td style="border-color: black; background-color:#ffb3b3;"><?php echo $row['Order_Date'];?></td>
                  <td style="border-color: black; background-color:#ffb3b3;"><?php echo $row['ItemNumber'];?></td>
                <td style="border-color: black; background-color:#ffb3b3;"><?php echo $row['MC_Fname'];?></td>
                <td style="border-color: black; background-color:#ffb3b3;"><?php echo $row['Order_Status'];?></td>
                <td style="border-color: black; background-color:#ffb3b3;"><?php echo $row['Duration'];?></td>
              </tr>

          <?php }elseif($row['Order_Status']=='Processing'){ ?>
            <tr>

                  <td style="border-color: black; background-color:#ffe680;"><?php echo $row['Order_ID'];?></td>
                   <td style="border-color: black; background-color:#ffe680;"><?php echo $row['Customer_Name'];?></td>
                   <td style="border-color: black; background-color:#ffe680;"><?php echo $row['Group_Name'];?></td>
                   <td style="border-color: black; background-color:#ffe680;"><?php echo $row['Order_Date'];?></td>
                  <td style="border-color: black; background-color:#ffe680;"><?php echo $row['ItemNumber'];?></td>
                <td style="border-color: black; background-color:#ffe680;"><?php echo $row['MC_Fname'];?></td>
                <td style="border-color: black; background-color:#ffe680;"><?php echo $row['Order_Status'];?></td>
                <td style="border-color: black; background-color:#ffe680;"><?php echo $row['Duration'];?></td>
              </tr>


              <?php }elseif($row['Order_Status']=='Available/For Pick-Up'){ ?>
            <tr>

                  <td style="border-color: black; background-color:#99ff99;"><?php echo $row['Order_ID'];?></td>
                   <td style="border-color: black; background-color:#99ff99;"><?php echo $row['Customer_Name'];?></td>
                   <td style="border-color: black; background-color:#99ff99;"><?php echo $row['Group_Name'];?></td>
                   <td style="border-color: black; background-color:#99ff99;"><?php echo $row['Order_Date'];?></td>
                  <td style="border-color: black; background-color:#99ff99;"><?php echo $row['ItemNumber'];?></td>
                <td style="border-color: black; background-color:#99ff99;"><?php echo $row['MC_Fname'];?></td>
                <td style="border-color: black; background-color:#99ff99;"><?php echo $row['Order_Status'];?></td>
                <td style="border-color: black; background-color:#99ff99;"><?php echo $row['Duration'];?></td>
              </tr>

           <?php }} ?>

        </tbody>
      </table>

    </div>
      
    </div>



  </div>

</div>


</div>

</div>
<!--------------------------------End of Page Content-------------------------------->

</body>

<?php include '../../include/script.php';?>

</body>
</html>
