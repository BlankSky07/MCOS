<?php
  session_start();
  include('../../include/conn.php');

?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>MC Ordering System - All Orders</title>
  
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

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  
  <?php include 'navigation.php';?>

<!--------------------------------Page Content-------------------------------->
<div class="content-wrapper">

<div class="main-header">
        <div class="main-header__intro-wrapper">
          <div class="main-header__welcome">
            
            <div class="main-header__welcome-title text-light">
              <strong>All</strong> Orders
            </div>

            <div class="main-header__welcome-subtitle text-light">
            </div>

          </div> <!--Main Header Welcome-->
        </div> <!--Main Header Intro Wrapper-->
      </div>  <!--Main Header-->

   <div class="container-fluid">


<div class="edit">

<div class="cardo">

  <div class="cardo">

    <div class="documents">

      <div class="table-responsive">

      <table class="table table-bordered" id="allOrdersIndexTable" width="100%" cellspacing="0">
              
          <thead>
            <tr>
              <th>Order #</th>
              <th>Customer</th>
              <th>Group</th>
              <th>Order Date</th>
              <th>Items</th>
              <th>MC</th>
              <th>Status</th>
              <th>Served Date</th>
              <th>Actions</th>
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
                                             tblmc.MC_Fname,
                                             tblgroup.Group_Name
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
                                      LEFT JOIN tblgroup ON tblgroup.Group_ID = tblorders.Group_ID");
            $result->execute();

              for($i=0; $row = $result->fetch(); $i++){ ?>

                <tr>
                  <td><?php echo $row['Order_ID'];?></td>
                   <td><?php echo $row['Customer_Name'];?></td>
                   <td><?php echo $row['Group_Name'];?></td>
                   <td><?php echo $row['Order_Date'];?></td>
                  <td><table class="table table-bordered" width="100%" cellspacing="0">
              
                    <thead>
                      <tr>
                        <th>Item</th>
                        <th>Description</th>
                        <th>Qty</th>
                        <th>Status</th>
                      </tr>
                    </thead>

                  <tbody>

                    <?php 
                    if($row['Item1'] != 'N/A' && 
                       $row['Item2'] == 'N/A' && 
                       $row['Item3'] == 'N/A' &&
                       $row['Item4'] == 'N/A' && 
                       $row['Item5'] == 'N/A'){
                    ?>

                    <tr>
                      <td><?php echo $row['Item1'];?></td>
                      <td><?php echo $row['Desc1'];?></td>
                      <td><?php echo $row['Qty1'];?></td>
                      <td><?php if($row['Item1'] != 'N/A'){echo $row['Stat1'];} else{echo "N/A";}?></td>
                    </tr>

                    <?php 

                    }

                    elseif($row['Item1'] != 'N/A' && 
                           $row['Item2'] != 'N/A' && 
                           $row['Item3'] == 'N/A' &&
                           $row['Item4'] == 'N/A' && 
                           $row['Item5'] == 'N/A'){
                    ?>

                    <tr>
                      <td><?php echo $row['Item1'];?></td>
                      <td><?php echo $row['Desc1'];?></td>
                      <td><?php echo $row['Qty1'];?></td>
                      <td><?php if($row['Item1'] != 'N/A'){echo $row['Stat1'];} else{echo "N/A";}?></td>
                    </tr>

                    <tr>
                      <td><?php echo $row['Item2'];?></td>
                      <td><?php echo $row['Desc2'];?></td>
                      <td><?php echo $row['Qty2'];?></td>
                      <td><?php if($row['Item2'] != 'N/A'){echo $row['Stat2'];} else{echo "N/A";}?></td>
                    </tr>

                    <?php 

                    }

                    elseif($row['Item1'] != 'N/A' && 
                           $row['Item2'] != 'N/A' && 
                           $row['Item3'] != 'N/A' &&
                           $row['Item4'] == 'N/A' && 
                           $row['Item5'] == 'N/A'){
                    ?>

                    <tr>
                      <td><?php echo $row['Item1'];?></td>
                      <td><?php echo $row['Desc1'];?></td>
                      <td><?php echo $row['Qty1'];?></td>
                      <td><?php if($row['Item1'] != 'N/A'){echo $row['Stat1'];} else{echo "N/A";}?></td>
                    </tr>

                    <tr>
                      <td><?php echo $row['Item2'];?></td>
                      <td><?php echo $row['Desc2'];?></td>
                      <td><?php echo $row['Qty2'];?></td>
                      <td><?php if($row['Item2'] != 'N/A'){echo $row['Stat2'];} else{echo "N/A";}?></td>
                    </tr>

                    <tr>
                      <td><?php echo $row['Item3'];?></td>
                      <td><?php echo $row['Desc3'];?></td>
                      <td><?php echo $row['Qty3'];?></td>
                      <td><?php if($row['Item3'] != 'N/A'){echo $row['Stat3'];} else{echo "N/A";}?></td>
                    </tr>

                    <?php 

                    } 

                    elseif($row['Item1'] != 'N/A' && 
                           $row['Item2'] != 'N/A' && 
                           $row['Item3'] != 'N/A' &&
                           $row['Item4'] != 'N/A' && 
                           $row['Item5'] == 'N/A'){
                    ?>

                    <tr>
                      <td><?php echo $row['Item1'];?></td>
                      <td><?php echo $row['Desc1'];?></td>
                      <td><?php echo $row['Qty1'];?></td>
                      <td><?php if($row['Item1'] != 'N/A'){echo $row['Stat1'];} else{echo "N/A";}?></td>
                    </tr>

                    <tr>
                      <td><?php echo $row['Item2'];?></td>
                      <td><?php echo $row['Desc2'];?></td>
                      <td><?php echo $row['Qty2'];?></td>
                      <td><?php if($row['Item2'] != 'N/A'){echo $row['Stat2'];} else{echo "N/A";}?></td>
                    </tr>

                    <tr>
                      <td><?php echo $row['Item3'];?></td>
                      <td><?php echo $row['Desc3'];?></td>
                      <td><?php echo $row['Qty3'];?></td>
                      <td><?php if($row['Item3'] != 'N/A'){echo $row['Stat3'];} else{echo "N/A";}?></td>
                    </tr>

                    <tr>
                      <td><?php echo $row['Item4'];?></td>
                      <td><?php echo $row['Desc4'];?></td>
                      <td><?php echo $row['Qty4'];?></td>
                      <td><?php if($row['Item4'] != 'N/A'){echo $row['Stat4'];} else{echo "N/A";}?></td>
                    </tr>

                    <?php 

                    } 

                    elseif($row['Item1'] != 'N/A' && 
                           $row['Item2'] != 'N/A' && 
                           $row['Item3'] != 'N/A' &&
                           $row['Item4'] != 'N/A' && 
                           $row['Item5'] != 'N/A'){
                    ?>

                    <tr>
                      <td><?php echo $row['Item1'];?></td>
                      <td><?php echo $row['Desc1'];?></td>
                      <td><?php echo $row['Qty1'];?></td>
                      <td><?php if($row['Item1'] != 'N/A'){echo $row['Stat1'];} else{echo "N/A";}?></td>
                    </tr>

                    <tr>
                      <td><?php echo $row['Item2'];?></td>
                      <td><?php echo $row['Desc2'];?></td>
                      <td><?php echo $row['Qty2'];?></td>
                      <td><?php if($row['Item2'] != 'N/A'){echo $row['Stat2'];} else{echo "N/A";}?></td>
                    </tr>

                    <tr>
                      <td><?php echo $row['Item3'];?></td>
                      <td><?php echo $row['Desc3'];?></td>
                      <td><?php echo $row['Qty3'];?></td>
                      <td><?php if($row['Item3'] != 'N/A'){echo $row['Stat3'];} else{echo "N/A";}?></td>
                    </tr>

                    <tr>
                      <td><?php echo $row['Item4'];?></td>
                      <td><?php echo $row['Desc4'];?></td>
                      <td><?php echo $row['Qty4'];?></td>
                      <td><?php if($row['Item4'] != 'N/A'){echo $row['Stat4'];} else{echo "N/A";}?></td>
                    </tr>

                    <tr>
                      <td><?php echo $row['Item5'];?></td>
                      <td><?php echo $row['Desc5'];?></td>
                      <td><?php echo $row['Qty5'];?></td>
                      <td><?php if($row['Item5'] != 'N/A'){echo $row['Stat5'];} else{echo "N/A";}?></td>
                    </tr>

                    <?php 

                    } 

                    ?>    
                    
                  </tbody>
                </table></td>
                <td><?php echo $row['MC_Fname'];?></td>
                <td><?php echo $row['Order_Status'];?></td>
                <td><?php echo $row['Order_Served'];?></td>
                  <?php 

                  if ($row['Order_Status'] == "On-Queue") { 

                    $icon = 'fa fa-fw fa-times';
                  }

                  else{

                    $icon = '';

                  }

                    ?>
                  
                  <td>
                    <i class="<?php echo $icon; ?>" style="color:black;" data-toggle="modal" data-target="#CancelOrderModal"></i>
                  </td>
                
              </tr>

          <?php } ?>

        </tbody>
      </table>

    </div>
      
    </div>
<div class="card-footer small text-muted">Updated today at <?php 
          date_default_timezone_set("Asia/Manila");
          echo date("h:i:sa");
          ?>
        </div>


  </div>

</div>
</div>


</div>



</div>
<!--------------------------------End of Page Content-------------------------------->

  <?php include '../../include/footer.php';?>


<!---------------------------------Remove Modal-------------------------------->

<div class="modal fade" id="CancelOrderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to cancel this item?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          
              <form>
              <div class="modal-body">
                              
                <br>

                  <div class="row" style="text-align:left; margin-left:10px; margin-bottom:15px;">

                    <div class=".u-full-width">

                      <label>Order #: <strong id="txtOrderIDModal"></strong></label>

                      <br><br>

                      <label>Item Name: <strong id="txtItemNameModal"></strong></label>
                            
                      <br><br>

                      <div class=".u-full-width">
                        <label>Description:<strong id="txtItemDescModal"></strong></label>
                      </div>

                  </div>
      
                </div>

              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-secondary" type="button" id="btnCancelOrder">Yes</button>
              </div>

          </form>


        </div>

      </div>

    </div>

          </div>

    </div>

<!---------------------------------End of Rmove Modal-------------------------------->


</body>

<?php include '../../include/script.php';?>

</body>
</html>
