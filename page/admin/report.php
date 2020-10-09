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
  <title>MC Ordering System - Reports</title>
  
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css'>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/css/dataTables.bootstrap4.css'>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css'>
  <link rel="stylesheet" href="../../include/css/style.css">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
  
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  
  <?php include 'navigation.php';?>



  <!--------------------------------Page Content-------------------------------->



  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row" style="margin-top:20px;">    
        
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card darkgrey o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon red">
                <i class="fa fa-fw fa-shopping-cart"></i>
              </div>

              <div class="mr-5">
                Item Served
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

        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card darkgrey o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon red">
                <i class="fa fa-fw fa-shopping-cart"></i>
              </div>

            

              <div class="mr-5">
                MC Served Items
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

      </div>

      <div class="row" style="margin-left: 1px;">

        <div class="card mb-3">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="counterForPickUpTable" width="100%" cellspacing="0">
                    
                <thead>
                  <tr>
                    <th>Item</th>
                    <th>No. of Item Served</th>
                    <th>Order Date</th>
                  </tr>
                </thead>

                <tbody>

                <?php require('../../include/connection.php');

                $PCNamae = gethostname();

                $result = $conn->prepare("SELECT tblorders.Order_ID, 
                                                 SUM(tblorders.Item_Qty1 + 
                                                     tblorders.Item_Qty2 + 
                                                     tblorders.Item_Qty3 + 
                                                     tblorders.Item_Qty4 + 
                                                     tblorders.Item_Qty5) AS TotalQTY,
                                                     a.Item_Name AS Item1,
                                                     ab.Item_Name AS Item2,
                                                     abc.Item_Name AS Item3,
                                                     abcd.Item_Name AS Item4,
                                                     abcde.Item_Name AS Item5,
                                                     tblorders.Order_Date 
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
                                          GROUP BY Item1");
                $result->execute();

                  for($i=0; $row = $result->fetch(); $i++){ ?>
                    
                     <td id="ItemOrderID"><?php echo $row['Item1'];?></td>
                      <td><?php echo $row['TotalQTY'];?></td>
                      <td><?php echo $row['Order_Date'];?></td></td>
                      
                  </tr> <?php } ?>
                </tbody>
              </table>
            </div>
          </div>

          <div class="card-footer small text-muted">Updated today at <?php 
            date_default_timezone_set("Asia/Manila");
            echo date("h:i:sa");?>
          </div>

        </div>
      </div>
    </div>
  </div>



  <!--------------------------------End of Page Content-------------------------------->



  <?php include '../../include/footer.php';?> 

</body>

<?php include '../../include/script.php';?>

</body>
</html>
