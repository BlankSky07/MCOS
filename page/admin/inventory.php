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
  <title>MC Ordering System - Inventory</title>
  
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

<div class="main-header" style="height:100px;">
        <div class="main-header__intro-wrapper">
          <div class="main-header__welcome">
            
            <div class="main-header__welcome-title text-light" style="padding-bottom:50px;">
              <strong>I</strong>nventory
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

      <table class="table table-bordered" id="inventoryTable" width="100%" cellspacing="0">
              
          <thead>
            <tr>
              <th>Order #</th>
              <th>Item</th>
              <th>Description</th>
              <th>Status</th>
              <th>Remarks</th>
              <th>Photo</th>
              <th>Quantity</th>
              <th>Actions</th>
            </tr>
          </thead>

        <tbody>

          <?php require_once('../../include/connection.php');

            $result = $conn->prepare("SELECT tblinventory.Inventory_ID,
                                             tblinventory.Item_Name,
                                             tblinventory.Item_Description,
                                             tblinventory.Item_Qty,
                                             tblinventorystatus.Inventory_Status, 
                                             tblinventory.Latest_Update,
                                             tblinventory.Photo_Location,
                                             tblinventory.Item_Remarks
                                      FROM tblinventory
                                      LEFT JOIN tblinventorystatus ON tblinventorystatus.InventoryStatus_ID =
                                                                      tblinventory.InventoryStatus_ID
                                      WHERE Item_Name NOT LIKE 'N/A'
                                      ORDER BY Item_Name");
            $result->execute();

            for($i=0; $row = $result->fetch(); $i++){ ?>
              <tr>
                <td id="txtInventoryIDTable"><?php echo $row['Inventory_ID'];?></td>
                <td id="txtItemNameTable"><?php echo $row['Item_Name'];?></td>
                <td id="txtItemDescTable"><?php echo $row['Item_Description'];?></td>
                <td id="txtItemStatusTable"><?php echo $row['Inventory_Status'];?></td>
                <td id="txtItemRemarksTable"><?php echo $row['Item_Remarks'];?></td>
                <td><img src="<?php echo '../../'.$row['Photo_Location'];?>" style="width: 100px; height:100px;" alt="<?php echo $row['Item_Name'];?>"></td>
                <td id="txtItemQtyTable"><?php echo $row['Item_Qty'];?></td>
                <td>
                  <i class="fa fa-fw fa-plus" style="color:black;" data-toggle="modal" data-target="#AddProdModal"></i>
                  <i class="fa fa-fw fa-edit" style="color:black;" data-toggle="modal" data-target="#EditProdModal"></i>
                  <i class="fa fa-fw fa-trash" style="color:black;" data-toggle="modal" data-target="#RemoveProdModal"></i>
                </td>
              </tr>

            <?php } ?>
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









</div>
<!--------------------------------End of Page Content-------------------------------->

  <?php include '../../include/footer.php';?> 


<!---------------------------------Add Modal-------------------------------->

<div class="modal fade" id="AddProdModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Item to Inventory</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          
            <form>

              <div class="modal-body">
                              
                <br>

                  <div class="row" style="text-align:left; margin-left:10px; margin-bottom:15px;">

                    <div class=".u-full-width">

                      <div class=".u-full-width">
                        <label>Item Name:</label>
                        <br>
                        <input type="text" value="" id="txtItemNameModal" required/>
                      </div>
                            
                      <br>

                      <div class=".u-full-width">
                        <label>Item Description:</label>
                        <br>
                        <input type="text" value="" id="txtItemDescModal" required/>
                      </div>

                      <div class=".u-full-width">
                        <label>Item Quantity:</label>
                        <br>
                        <input type="number" value="" id="txtItemQtyModal" required/>
                      </div>

                      <br>
                      <label>Browse Photo:</label>
                      <br>
                      <input type="file" name="image" id="file" required/>
                      <br><br>

                  </div>
      
                </div>

              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-teal" type="button" id="btnAddtoInventory">Save</button>
              </div>

          </form>

        </div>

      </div>

    </div>

          </div>

    </div>

<!---------------------------------Add of Edit Modal-------------------------------->



<!---------------------------------Edit Modal-------------------------------->

<div class="modal fade" id="EditProdModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Item</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          
            <form>
              <div class="modal-body">
                              
                <br>

                  <div class="row" style="text-align:left;margin-left:10px; margin-bottom:15px;">

                    <div class=".u-full-width">

                      <label>Inventory #:<strong id="txtEditInventoryIDModal"></strong></label>

                      <hr>

                      <label>Item Name:</label>
                      <br>

                      <input type="text" id="txtEditItemNameModal" required/>
                            
                      <br><br>

                      <label>Description:</label>
                      <br>

                      <input type="text" id="txtEditItemDescModal" required/>
                      <br><br>
                      <div class=".u-full-width">
                        <label>Item Quantity:</label>
                        <br>
                        <input type="number" value="" id="txtEditItemQtyModal" required/>
                      </div>

                      <br>
                      <label>Browse Photo:</label>
                      <br>
                      <input type="file" name="image" id="editfile" required/>
                      <br><br>

                      <label>Status:</label>
                      <br>

                      <select id="txtEditItemStatusModal">
                        <option value="1">Pending</option>
                        <option value="2">Available</option>
                        <option value="3">Not Available</option>
                      </select>

                      <br><br>

                      <label>Remarks:</label>
                      <br>
                      <textarea id="txtEditItemRemarksModal"></textarea>

                  </div>
      
                </div>

              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-teal" type="button" id="btnEditInventory">Update</button>
              </div>

          </form>

        </div>

      </div>

    </div>

          </div>

    </div>

<!---------------------------------End of Edit Modal-------------------------------->



<!---------------------------------Delete Modal-------------------------------->

<div class="modal fade" id="RemoveProdModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this item?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          
              <form>
              <div class="modal-body">
                              
                <br>

                  <div class="row" style="text-align:left; margin-left:10px; margin-bottom:15px;">

                    <div class=".u-full-width">

                      <label>Inventory #: <strong id="txtDeleteInventoryIDModal"></strong></label>

                      <br>

                      <label>Item Name: <strong id="txtDeleteItemNameModal"></strong></label>
                            
                      <br>
                     
                      <label>Description: <strong id="txtDeleteItemDescModal"></strong></label>
                 
                  </div>
      
                </div>

              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-teal" type="button" id="btnDeleteInventory">Delete</button>
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
