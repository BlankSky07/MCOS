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
  <title>MC Ordering System - Admin Dashboard</title>
  
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

<!--###############################Page Content###############################-->
<div class="content-wrapper">

<?php

  include('../../include/conn.php');
  $query=mysqli_query($conn,"SELECT * FROM tbluser WHERE User_ID='".$_SESSION['id']."'");
  $row=mysqli_fetch_assoc($query);

?>

 <div class="main-header">
      <div class="main-header__intro-wrapper">
        <div class="main-header__welcome">
          <div class="main-header__welcome-subtitle text-light">Welcome to</div>
          <div class="main-header__welcome-title text-light"><strong>MC Ordering System, </strong><?php echo $row['User_Fname']; ?>.</div>
          <div class="main-header__welcome-subtitle text-light">

          </div>
        </div>
        
        <div class="quickview">

<?php
    require('../../include/connection.php');

    $result = $conn->prepare("SELECT tblmc.MC_ID,
                                     tblmc.MC_CID,
                                     tblmc.MC_Fname,
                                     tblmc.MC_Lname,
                                     tblmcstatus.Status,
                                     tblmc.MC_Photo
                              FROM tblmc
                              LEFT JOIN tblmcstatus ON tblmcstatus.MCStatus_ID = 
                                                       tblmc.MCStatus_ID
                              WHERE tblmc.MCStatus_ID = 1 LIMIT 5");
    $result->execute(); 

    for($i=0; $row = $result->fetch(); $i++){





  ?>
          <div class="quickview__item">
            <img class="document__img" src="<?php echo '../../'.$row['MC_Photo'];?>" alt="<?php echo $row['MC_Fname'];?>">
            <div class="quickview__item-total"><?php echo $row['MC_Fname'];?></div>
            <div class="quickview__item-description">
              <i class="far fa-calendar-alt"></i>
              <span class="text-light"><?php echo $row['Status'];?></span>
            </div>
          </div>
  
  <?php } ?>

        </div>
      </div>
    </div>



<div class="container-fluid">

<div class="row">

<div class="col-xl-6 col-sm-6 mb-3">

<div class="cardo">

   <div class="card__header">

    <div class="card__header-title text-light"><strong>Today's Order List</strong>
      <a href="orders.php" class="card__header-link text-bold">View All</a>
    </div>
      
  </div>

  <div class="cardo">

    <div class="documents">

      <div class="table-responsive">

      <table class="table table-bordered" id="DBordersTable" width="100%" cellspacing="0">
              
          <thead>
            <tr>
              <th>Order #</th>
              <th>Order Date</th>
              <th>Customer</th>
              <th>Group</th>
              <th>No. of Items</th>
              <th>Status</th>
            </tr>
          </thead>

        <tbody>

          <?php require('../../include/connection.php');

            $result = $conn->prepare("SELECT tblorders.Order_ID,
                                             tblorders.Customer_Name,
                                             tblorders.Order_Date,
                                             (ABS(tblorders.Inventory_ID1 NOT LIKE 0) +
                                             ABS(tblorders.Inventory_ID2 NOT LIKE 0) +
                                             ABS(tblorders.Inventory_ID3 NOT LIKE 0) +
                                             ABS(tblorders.Inventory_ID4 NOT LIKE 0) +
                                             ABS(tblorders.Inventory_ID5 NOT LIKE 0)
                                             ) AS ItemNumber,
                                             tblinventory.Item_Description,
                                             tblorders.Use_Case,
                                             tblorderstatus.Order_Status,
                                             tblgroup.Group_Name,
                                             tblorders.Order_Served
                                      FROM tblorders
                                      LEFT JOIN tblinventory ON tblinventory.Inventory_ID = 
                                                                tblorders.Inventory_ID1
                                      LEFT JOIN tblorderstatus ON tblorderstatus.OrderStatus_ID = 
                                                                  tblorders.OrderStatus_ID 
                                      LEFT JOIN tblgroup ON tblgroup.Group_ID = tblorders.Group_ID    
                                      WHERE Date(Order_Date) = Current_Date()
                                      AND tblorders.OrderStatus_ID = 1
                                      GROUP BY tblorders.Customer_Name, tblorders.Order_ID");
            $result->execute();

              for($i=0; $row = $result->fetch(); $i++){ ?>
                
                <tr>
                  <td><?php echo $row['Order_ID'];?></td>
                  <td><?php echo $row['Order_Date'];?></td>
                  <td><?php echo $row['Customer_Name'];?></td>
                  <td><?php echo $row['Group_Name'];?></td>
                  <td><?php echo $row['ItemNumber'];?></td>
                  <td><?php echo $row['Order_Status'];?></td>
                </tr>

          <?php } ?>

        </tbody>
      </table>

    </div>
      
    </div>



  </div>

</div>
</div>






  

<div class="col-xl-6 col-sm-6 mb-3">

<div class="cardo">

   <div class="card__header">

    <div class="card__header-title text-light"><strong>Today's Completed Order</strong>
      <a href="orders.php" class="card__header-link text-bold">View All</a>
    </div>
      
  </div>

  <div class="cardo">

    <div class="documents">

      <div class="table-responsive">

      <table class="table table-bordered" id="DBcompletedTable" width="100%" cellspacing="0">
              
          <thead>
            <tr>
              <th>Order #</th>
              <th>Order Date</th>
              <th>Customer</th>
              <th>Group</th>
              <th>No. of Items</th>
              <th>MC Personnel</th>
              <th>Status</th>
            </tr>
          </thead>

        <tbody>

          <?php require('../../include/connection.php');

            $result = $conn->prepare("SELECT tblorders.Order_ID,
                                             tblorders.Customer_Name,
                                             tblorders.Order_Date,
                                             (ABS(tblorders.Inventory_ID1 NOT LIKE 0) +
                                              ABS(tblorders.Inventory_ID2 NOT LIKE 0) +
                                              ABS(tblorders.Inventory_ID3 NOT LIKE 0) +
                                              ABS(tblorders.Inventory_ID4 NOT LIKE 0) +
                                              ABS(tblorders.Inventory_ID5 NOT LIKE 0)
                                             ) AS ItemNumber,
                                             tblinventory.Item_Description,
                                             tblorders.Use_Case,
                                             tblorderstatus.Order_Status,
                                             tblorders.Order_Served,
                                             tblgroup.Group_Name,
                                             tblmc.MC_Fname
                                      FROM tblorders
                                      LEFT JOIN tblinventory ON tblinventory.Inventory_ID = 
                                                                tblorders.Inventory_ID1
                                      LEFT JOIN tblorderstatus ON tblorderstatus.OrderStatus_ID = 
                                                                  tblorders.OrderStatus_ID 
                                      LEFT JOIN tblmc ON tblmc.MC_ID = tblorders.MC_ID
                                      LEFT JOIN tblgroup ON tblgroup.Group_ID = tblorders.Group_ID 
                                      WHERE Date(Order_Date) = Current_Date()
                                      AND tblorders.OrderStatus_ID = 4
                                      GROUP BY tblorders.Customer_Name, tblorders.Order_ID");
            $result->execute();

              for($i=0; $row = $result->fetch(); $i++){ ?>
                
                <tr>
                  <td><?php echo $row['Order_ID'];?></td>
                  <td><?php echo $row['Order_Date'];?></td>
                  <td><?php echo $row['Customer_Name'];?></td>
                  <td><?php echo $row['Group_Name'];?></td>
                  <td><?php echo $row['ItemNumber'];?></td>
                  <td><?php echo $row['MC_Fname'];?></td>
                  <td><?php echo $row['Order_Status'];?></td>
                </tr>

          <?php } ?>

        </tbody>
      </table>
    </div>
      
      </div>
    </div>
  </div>
</div>

</div>


<div class="cardo">

   <div class="card__header">

    <div class="card__header-title text-light"><strong>Pending Item List</strong>
      <a href="inventory.php" class="card__header-link text-bold">View All</a>
    </div>
      
  </div>

  <div class="cardo">

    <div class="documents">

      <div class="table-responsive">

      <table class="table table-bordered" id="DBpendingTable" width="100%" cellspacing="0">
              
          <thead>
            <tr>
              <th>Order #</th>
              <th>Item</th>
              <th>Description</th>
              <th>Status</th>
              <th>Remarks</th>
            </tr>
          </thead>

        <tbody>

          <?php
                  require_once('../../include/connection.php');


                  $result = $conn->prepare("SELECT tblinventory.Inventory_ID,
                                                   tblinventory.Item_Name,
                                                   tblinventory.Item_Description,
                                                   tblinventorystatus.Inventory_Status, 
                                                   tblinventory.Latest_Update,
                                                   tblinventory.Item_Remarks
                                            FROM tblinventory
                                            LEFT JOIN tblinventorystatus ON tblinventorystatus.InventoryStatus_ID =
                                                                            tblinventory.InventoryStatus_ID
                                            WHERE Item_Name NOT LIKE 'N/A' AND Inventory_Status LIKE '%Pending%'
                                            ORDER BY Item_Name");
                  $result->execute();

                  for($i=0; $row = $result->fetch(); $i++){

                  ?>
                <tr>
                  <td id="txtInventoryIDTable"><?php echo $row['Inventory_ID'];?></td>
                  <td id="txtItemNameTable"><?php echo $row['Item_Name'];?></td>
                  <td id="txtItemDescTable"><?php echo $row['Item_Description'];?></td>
                  <td id="txtItemStatusTable"><?php echo $row['Inventory_Status'];?></td>
                  <td id="txtItemRemarksTable"><?php echo $row['Item_Remarks'];?></td>
                </tr>

                   <?php } ?>

        </tbody>
      </table>

    </div>
      
    </div>

  </div>

</div>

</div>



  </div>

</div>

</div>
<!--###############################End of Page Content###############################-->

  <?php include '../../include/footer.php';?> 

</body>

<?php include '../../include/script.php';?>

</body>
</html>
