<?php
  session_start();
  include('../../include/conn.php');

?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>MC Ordering System - New Order</title>
  
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css'>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/css/dataTables.bootstrap4.css'>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css'>
  <link rel="stylesheet" href="../../include/css/style.css">

<meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  
    <?php include 'navigation.php';?>

  <!---------------------------------Page Content-------------------------------->
<div class="content-wrapper"> 

      <!--Page Header-->
      <div class="main-header">
        <div class="main-header__intro-wrapper">
          <div class="main-header__welcome">
            <div class="main-header__welcome-title text-light"><strong>New</strong> Order</div>
            <div class="main-header__welcome-subtitle text-light"></div>
          </div>
        </div>
      </div>

      <!--Product List-->
      <div class="container-fluid">
        <div class="row">
          <div class="col-xl-8 col-sm-6 mb-3">
            <div class="cardo">
              <div class="cardo">
                <div class="documents">
                  <div class="table-responsive">
                    <table class="table table-bordered border-dark" id="neworderTable" width="100%" cellspacing="0">
                  
                      <thead>
                        <tr>
                          <th>Order #</th>
                          <th>Item</th>
                          <th>Description</th>
                          <th>Status</th>
                          <th>Remarks</th>
                          <th>Photo</th>
                          <th>Actions</th>
                        </tr>
                      </thead>

                      <tbody>

                        <?php require('../../include/connection.php');
                          $result = $conn->prepare("SELECT tblinventory.Inventory_ID,
                                                           tblinventory.Item_Name,
                                                           tblinventory.Item_Description,
                                                           tblinventory.Photo_Location,
                                                           tblinventorystatus.Inventory_Status, 
                                                           tblinventory.Latest_Update,
                                                           tblinventory.Item_Remarks
                                            FROM tblinventory
                                            LEFT JOIN tblinventorystatus ON tblinventorystatus.InventoryStatus_ID =
                                                                            tblinventory.InventoryStatus_ID
                                            WHERE Item_Name NOT LIKE 'N/A'
                                            ORDER BY Item_Name");
                          $result->execute();

                        for($i=0; $row = $result->fetch(); $i++){ ?>
                          
                          <tr>
                            <td><?php echo $row['Inventory_ID'];?></td>
                            <td><?php echo $row['Item_Name'];?></td>
                            <td><?php echo $row['Item_Description'];?></td>
                            <td><?php echo $row['Inventory_Status'];?></td>
                            <td><?php echo $row['Item_Remarks'];?></td>
                            <td><img src="<?php echo '../../'.$row['Photo_Location'];?>" style="width: 100px; height:100px;" alt="<?php echo $row['Item_Name'];?>"></td>
                            <td><?php if($row['Inventory_Status'] != 'Pending'){echo '<button class="btn btn-teal" id="addtocart">Add to Cart</button>';} else{echo "Not Available";}?></td>

                          </tr>

                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!--Cart-->
          <div class="col-xl-4 col-sm-6 mb-3">
            <div class="cardo">
              <div class="card__header">
                <div class="card__header-title text-light"><strong>Cart</strong>(<strong id="cart-num">0</strong>/5)<strong id="cart-full"></strong></div>
              </div>

              <div class="cardo">
                <div class="documents">

                  <div class="table-responsive">
                    <table class="table table-bordered" id="neworderTable" width="100%" cellspacing="0">

                      <tbody>

                          <tr>

                            <td>

                              <form>

                                <br>

                                <label for="cars">Name: </label>

                                <br>

                                <select id="customer-name">

                                  <option value="0">--</option>

                                  <?php require('../../include/connectionEE.php');

                                    $result = $conn->prepare("SELECT Name, Surname, CID
                                        FROM emp_name
                                        WHERE Plant = 'P2' AND (Group1 LIKE '%MS1%' OR Group1 LIKE '%MS2%' OR Group1 LIKE '%T2K%' OR Group1 LIKE '%Digital%') 
                                        ORDER BY Name ASC");
                                    $result->execute();

                                    for($i=0; $row = $result->fetch(); $i++){ ?>

                                      <option value="<?php echo $row['CID'];?>"><strong id="CustomerID" name="CustomerID"><?php echo $row['Name'];?> <?php echo $row['Surname'];?></strong></option>
                                      <?php } ?>
                                  
                                </select>
                              <br>
                                <label>Group: <strong id="NewOrderGroup"></strong></label>
                                   
                                <br>
                                <label for="cars">To be use at: </label>
                                <br>
                                <textarea style="width:270px; height:80px;" id="txtUseCase"></textarea>
                                
                                <br><br>
                                  
                                <label for="cars">Date: </label>
                                <br>
                                <label><strong><?php 
                                  date_default_timezone_set("Asia/Manila");
                                  echo date("m/d/Y h:i:sa");
                                ?></strong></label>

                                <br><br><hr><br>

                                  <div class="col-xl-12 col-sm-6 mb-3" id="cartdata">
                                      
                                  </div>

                              <input class="btn btn-teal" type="button" value="Submit Order" name="submitorder" id="submitorder">

                                </form>
                                
                                <br>

                            </td> 
                          </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        
        </div> <!--Row-->
      </div> <!--Container Fluid-->
    </div> <!--Content Wrapper-->
  <!---------------------------------End of Page Content-------------------------------->

  <?php include '../../include/footer.php';?>

</body>

<?php include '../../include/script.php';?>


</body>
</html>
