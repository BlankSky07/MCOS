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
  <title>MC Ordering System - Counter (Processing)</title>
  
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



<!--################################Page Content################################-->



  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row" style="margin-top:20px;">    
        
        <div class="col-xl-3 col-sm-6 mb-3"><!--#########On-Queue Orders########-->
          <div class="card darkgrey o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon red">
                <i class="fa fa-fw fa-shopping-cart"></i>
              </div>

              <?php require('../../include/conn.php');
                $result = mysqli_query($conn,"SELECT OrderStatus_ID FROM tblorders WHERE OrderStatus_ID = 1");
                  $rows = mysqli_num_rows($result); 
              ?>

              <div class="mr-5">
                <strong>(<?php echo "" . $rows . "";?>)</strong> On-Queue Orders
              </div>
          
            </div>

            <a class="card-footer darkgrey clearfix small z-1" href="counter.php">
                  
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>

          <div class="col-xl-3 col-sm-6 mb-3"><!--#########Processing Orders########-->
            <div class="card darkgrey o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon red">
                  <i class="fa fa-fw fa-shopping-cart"></i>
                </div>

                <?php require('../../include/conn.php');
                  $result = mysqli_query($conn,"SELECT OrderStatus_ID FROM tblorders WHERE OrderStatus_ID = 2");
                  $rows = mysqli_num_rows($result);    
                ?>

                <div class="mr-5">
                  <strong>(<?php echo "" . $rows . "";?>)</strong> Processing Orders
                </div>
          
              </div>

              <a class="card-footer darkgrey clearfix small z-1" href="counter-processing.php">
                  
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fa fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>

          <div class="col-xl-3 col-sm-6 mb-3"><!--#########For Pick-up Orders########-->
            <div class="card darkgrey o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon red">
                  <i class="fa fa-fw fa-shopping-cart"></i>
                </div>

                <?php require('../../include/conn.php');
                  $result = mysqli_query($conn,"SELECT OrderStatus_ID FROM tblorders WHERE OrderStatus_ID = 3");
                  $rows = mysqli_num_rows($result);
                ?>

                <div class="mr-5"><strong>(<?php echo "" . $rows . "";?>)</strong> For Pick-Up Orders</div>
              
              </div>

              <a class="card-footer darkgrey clearfix small z-1" href="counter-forpickup.php">
                  
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fa fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
        </div>

        <div class="row" style="margin-left: 1px;">

          <div class="card mb-3">

            <div class="card-header">
              <i class="fa fa-table"></i> MC View
            </div>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="counterProcessingTable" width="100%" cellspacing="0">
                        
                  <thead>
                    <tr>
                      <th>Order #</th>
                      <th>Customer</th>
                      <th>Group</th>
                      <th>Order Date</th>
                      <th>Items</th>
                      <th>MC Personnel</th>
                      <th>Status</th>
                      <th>Use Case</th>
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
                                             tblgroup.Group_Name,
                                                     tblmc.MC_Lname
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
                                              WHERE tblorders.OrderStatus_ID = 2
                                              ORDER BY Order_ID DESC");
                    $result->execute();

                    for($i=0; $row = $result->fetch(); $i++){ ?>
                      
                      <tr>
                        <td id="ItemOrderID"><?php echo $row['Order_ID'];?></td>
                        <td><?php echo $row['Customer_Name'];?></td>
                        <td><?php echo $row['Group_Name'];?></td>
                        <td><?php echo $row['Order_Date'];?></td>
                        <td><table class="table table-bordered" width="100%" cellspacing="0">
                    
                          <thead>
                            <tr>
                              <th>Order#</th>
                              <th>Item</th>
                              <th>Description</th>
                              <th>Qty</th>
                              <th>Served Qty</th>
                              <th>Status</th>
                              <th>Action</th>
                            </tr>
                          </thead>

                          <tbody>
                            <tr><!-- ########################ITEM 3 ACTION####################### -->
                              <td id="ItemOrderID"><?php echo $row['Order_ID'];?></td>
                              <td><?php echo $row['Item1'];?></td><!-- ########ITEM 1 NAME####### -->
                              <td><?php echo $row['Desc1'];?></td><!-- #######ITEM 1 DESC######## -->
                              <td><?php echo $row['Qty1'];?></td><!-- ########ITEM 1 QTY######### -->
                              <td><!--#####################ITEM 1 SERVED QTY##################### -->
                                  <?php if($row['Stat1'] == 'On-Queue'){
                                            echo "Osas";
                                          } 
                                        elseif($row['Stat1'] == 'Preparing'){

                                          if($row['Item1'] != 'N/A'){
                                            echo '<input type="text" style="width:100px;" id="txtServedQty1" required/>';
                                          } 

                                          else{
                                          echo 'N/A';
                                          }  

                                        } 

                                        elseif($row['Stat1'] == 'Done'){
                                          echo $row['ServedQty1'];
                                        }

                                        else{
                                          echo 'Error';
                                        }?>
                              </td>
                              <td><!--#######################ITEM 1 STATUS###################### -->
                                <?php if($row['Item1'] == 'N/A'){
                                        echo 'N/A';
                                      } 

                                      else{
                                        echo $row['Stat1'];
                                      };?>
                              </td>
                              <td><!--#######################ITEM 1 ACTION###################### -->
                                <?php if($row['Item1'] != 'N/A'){

                                        if($row['Stat1'] == 'Preparing'){
                                          echo '<button class="btn btn-teal" type="button" id="btnDoneItem1">Done</button>';
                                        } 

                                        elseif($row['Stat1'] == 'Done'){
                                          echo "Ready";
                                        } 
                                      } 

                                      else{
                                        echo "N/A";
                                      } ?>
                              </td>
                            </tr>

                            <tr><!-- ########################ITEM 3 ACTION###################### -->
                              <td id="ItemOrderID"><?php echo $row['Order_ID'];?></td>
                              <td><?php echo $row['Item2'];?></td><!-- #######ITEM 2 NAME####### -->
                              <td><?php echo $row['Desc2'];?></td><!-- #######ITEM 2 DESC####### -->
                              <td><?php echo $row['Qty2'];?></td> <!-- ########ITEM 2 QTY####### -->
                              <td><!-- #####################ITEM 2 SERVED QTY################### -->
                                  <?php if($row['Stat2'] == 'On-Queue'){
                                            echo "Osas";
                                          } 
                                        elseif($row['Stat2'] == 'Preparing'){

                                          if($row['Item2'] != 'N/A'){
                                            echo '<input type="text" style="width:100px;" id="txtServedQty2" required/>';
                                          } 

                                          else{
                                          echo 'N/A';
                                          }  

                                        } 

                                        elseif($row['Stat2'] == 'Done'){
                                          echo $row['ServedQty2'];
                                        }

                                        else{
                                          echo 'Error';
                                        }?>
                              </td>
                              <td><!-- #######################ITEM 2 STATUS#################### -->
                                <?php if($row['Item2'] == 'N/A'){
                                        echo 'N/A';
                                      } 

                                      else{
                                        echo $row['Stat2'];
                                      };?>
                              </td>
                              <td><!-- #######################ITEM 2 ACTION##################### -->
                                <?php if($row['Item2'] != 'N/A'){

                                        if($row['Stat2'] == 'Preparing'){
                                          echo '<button class="btn btn-teal" type="button" id="btnDoneItem2">Done</button>';
                                        } 

                                        elseif($row['Stat2'] == 'Done'){
                                          echo "Ready";
                                        } 
                                      } 

                                      else{
                                        echo "N/A";
                                      } ?>
                              </td>
                            </tr>

                            <tr><!-- ########################ITEM 3 ACTION###################### -->
                              <td id="ItemOrderID"><?php echo $row['Order_ID'];?></td>
                              <td><?php echo $row['Item3'];?></td><!-- #######ITEM 3 NAME####### -->
                              <td><?php echo $row['Desc3'];?></td><!-- ######ITEM 3 DESC######## -->
                              <td><?php echo $row['Qty3'];?></td><!--  #######ITEM 3 QTY######## -->
                              <td><!-- ######################ITEM 3 SERVED QTY################## -->
                                  <?php if($row['Stat3'] == 'On-Queue'){
                                            echo "Osas";
                                          } 
                                        elseif($row['Stat3'] == 'Preparing'){

                                          if($row['Item3'] != 'N/A'){
                                            echo '<input type="text" style="width:100px;" id="txtServedQty3" required/>';
                                          } 

                                          else{
                                          echo 'N/A';
                                          }  

                                        } 

                                        elseif($row['Stat3'] == 'Done'){
                                          echo $row['ServedQty3'];
                                        }

                                        else{
                                          echo 'Error';
                                        }?>
                              </td>
                              <td><!-- #######################ITEM 3 STATUS#################### -->
                                <?php if($row['Item3'] == 'N/A'){
                                        echo 'N/A';
                                      } 

                                      else{
                                        echo $row['Stat3'];
                                      };?>
                              </td>
                              <td><!-- ########################ITEM ACTION##################### -->
                                <?php if($row['Item3'] != 'N/A'){

                                        if($row['Stat3'] == 'Preparing'){
                                          echo '<button class="btn btn-teal" type="button" id="btnDoneItem3">Done</button>';
                                        } 

                                        elseif($row['Stat3'] == 'Done'){
                                          echo "Ready";
                                        } 
                                      } 

                                      else{
                                        echo "N/A";
                                      } ?>
                              </td>
                            </tr>

                            <tr><!-- ##########################ITEM ACTION###################### -->
                              <td id="ItemOrderID"><?php echo $row['Order_ID'];?></td>
                              <td><?php echo $row['Item4'];?></td><!-- ######ITEM 4 NAME######## -->
                              <td><?php echo $row['Desc4'];?></td><!-- #######ITEM 4 DESC####### -->
                              <td><?php echo $row['Qty4'];?></td><!-- #######ITEM 4 QTY######### -->
                              <td><!-- ####################ITEM 4 SERVED QTY#################### -->
                                  <?php if($row['Stat4'] == 'On-Queue'){
                                            echo "Osas";
                                          } 
                                        elseif($row['Stat4'] == 'Preparing'){

                                          if($row['Item4'] != 'N/A'){
                                            echo '<input type="text" style="width:100px;" id="txtServedQty4" required/>';
                                          } 

                                          else{
                                          echo 'N/A';
                                          }  

                                        } 

                                        elseif($row['Stat4'] == 'Done'){
                                          echo $row['ServedQty4'];
                                        }

                                        else{
                                          echo 'Error';
                                        }?>
                              </td>
                              <td><!-- #######################ITEM 4 STATUS##################### -->
                                <?php if($row['Item4'] == 'N/A'){
                                        echo 'N/A';
                                      } 

                                      else{
                                        echo $row['Stat4'];
                                      };?>
                              </td>
                              <td><!-- ####################ITEM 4 SERVED ACTION################# -->
                                <?php if($row['Item4'] != 'N/A'){

                                        if($row['Stat4'] == 'Preparing'){
                                          echo '<button class="btn btn-teal" type="button" id="btnDoneItem4">Done</button>';
                                        } 

                                        elseif($row['Stat4'] == 'Done'){
                                          echo "Ready";
                                        } 
                                      } 

                                      else{
                                        echo "N/A";
                                      } ?>
                              </td>
                            </tr>

                            <tr><!-- #####################ITEM 4 SERVED ACTION################## -->
                              <td id="ItemOrderID"><?php echo $row['Order_ID'];?></td>
                              <td><?php echo $row['Item5'];?></td><!-- ######ITEM 5 NAME######## -->
                              <td><?php echo $row['Desc5'];?></td><!-- #######ITEM 5 DESC####### -->
                              <td><?php echo $row['Qty5'];?></td><!-- ########ITEM 5 QTY######## -->
                              <td><!-- ####################-ITEM 5 SERVED QTY################### -->
                                  <?php if($row['Stat5'] == 'On-Queue'){
                                            echo "Osas";
                                          } 
                                        elseif($row['Stat5'] == 'Preparing'){

                                          if($row['Item5'] != 'N/A'){
                                            echo '<input type="text" style="width:100px;" id="txtServedQty5" required/>';
                                          } 

                                          else{
                                          echo 'N/A';
                                          }  

                                        } 

                                        elseif($row['Stat5'] == 'Done'){
                                          echo $row['ServedQty5'];
                                        }

                                        else{
                                          echo 'Error';
                                        }?>
                              </td>
                              <td><!-- ######################-ITEM 5 STATUS##################### -->
                                <?php if($row['Item5'] == 'N/A'){
                                        echo 'N/A';
                                      } 

                                      else{
                                        echo $row['Stat5'];
                                      };?>
                              </td>
                              <td><!-- ######################-ITEM 5 ACTION##################### -->
                                <?php if($row['Item5'] != 'N/A'){

                                        if($row['Stat5'] == 'Preparing'){
                                          echo '<button class="btn btn-teal" type="button" id="btnDoneItem5">Done</button>';
                                        } 

                                        elseif($row['Stat5'] == 'Done'){
                                          echo "Ready";
                                        } 
                                      } 

                                      else{
                                        echo "N/A";
                                      } ?>
                              </td>
                            </tr>
                          </tbody>
                         </table>
                      </td>
                      <td><?php echo $row['MC_Fname'];?> <?php echo $row['MC_Lname'];?></td>
                      <td><?php echo $row['Order_Status'];?></td>
                      <td><?php echo $row['Use_Case'];?></td>
                      <td><button class="btn btn-teal" type="button" id="btnOrderPrepared">Order Prepared</button></td>
                    </tr><?php } ?>
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



<!--##############################END of Page Content#############################-->



    <?php include '../../include/footer.php';?> 

  </body>

  <?php include '../../include/script.php';?>

  </body>
  </html>
