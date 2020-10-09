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
  <title>MC Ordering System - Manage Personnel</title>
  
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

<!--####################################Page Content##################################-->
<div class="content-wrapper">

<div class="main-header">
        <div class="main-header__intro-wrapper">
          <div class="main-header__welcome">
            
            <div class="main-header__welcome-title text-light">
              <strong>Manage</strong> Personnel
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

      <table class="table table-bordered" id="manageTable" width="100%" cellspacing="0">
              
          <thead>
            <tr>
              <th>MC #</th>
              <th>Photo</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>MC</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>

        <tbody>

          <?php
                  require_once('../../include/connection.php');


                  $result = $conn->prepare("SELECT tblmc.MC_ID,
                                                   tblmc.MC_CID,
                                                   tblmc.MC_Fname,
                                                   tblmc.MC_Lname,
                                                   tblmc.MCStatus_ID,
                                                   tblmcstatus.Status,
                                                   tblmc.MC_Photo
                                            FROM tblmc
                                            LEFT JOIN tblmcstatus ON tblmcstatus.MCStatus_ID =
                                                                            tblmc.MCStatus_ID");
                  $result->execute();

                  for($i=0; $row = $result->fetch(); $i++){

                  ?>
                <tr>
                  <td id="txtMCIDTable"><?php echo $row['MC_ID'];?></td>
                  <td><img src="<?php echo '../../'.$row['MC_Photo'];?>" style="width: 100px; height:100px;" alt="<?php echo $row['MC_Fname'];?>"></td>
                  <td id="txtMCFNameTable"><?php echo $row['MC_Fname'];?></td>
                  <td id="txtMCLNameTable"><?php echo $row['MC_Lname'];?></td>
                  <td id="txtCIDTable"><?php echo $row['MC_CID'];?></td>
                  <td><?php echo $row['Status'];?></td>
                  <td>
                    <i class="fa fa-fw fa-plus" style="color:black;" data-toggle="modal" data-target="#AddMCModal"></i>
                    <i class="fa fa-fw fa-edit" style="color:black;" data-toggle="modal" data-target="#EditMCModal"></i>
                    <i class="fa fa-fw fa-trash" style="color:black;" data-toggle="modal" data-target="#RemoveMCModal"></i>
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
<!--#########################End of Page Content#####################################-->

  <?php include '../../include/footer.php';?> 


<!--########################Add Modal########################-->

<div class="modal fade" id="AddMCModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add MC Personnel</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          
            <form>

              <div class="modal-body">
                              
                <br>

                  <div class="row" style="text-align:left; margin-left:10px; margin-bottom:15px;">

                    <div class=".u-full-width">

                      <br>
                      <label>Browse Photo:</label>
                      <br>
                      <input type="file" name="image" id="AddMCPhoto" required/>
                      <br><br>

                      <div class=".u-full-width">
                        <label>First Name:</label>
                        <br>
                        <input type="text" id="txtFNameModal" required/>
                      </div>
                            
                      <br>

                      <div class=".u-full-width">
                        <label>Last Name:</label>
                        <br>
                        <input type="text" id="txtLNameModal" required/>
                      </div>
                            
                      <br>

                      <div class=".u-full-width">
                        <label>CID:</label>
                        <br>
                        <input type="text" id="txtCIDModal" required/>
                      </div>

                  </div>
      
                </div>

              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-teal" type="button" id="btnAddMC">Save</button>
              </div>

          </form>

        </div>

      </div>

    </div>

          </div>

    </div>

<!--########################Add of Edit Modal########################-->



<!--########################Edit Modal########################-->

<div class="modal fade" id="EditMCModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit MC Personnel Details</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          
            <form>
              <div class="modal-body">
                              
                <br>

                  <div class="row" style="text-align:left;margin-left:10px; margin-bottom:15px;">

                    <div class=".u-full-width">

                      <label>MC ID: <strong id="txtEditMCID"></strong></label>

                      <br>
                      <label>Browse Photo:</label>
                      <br>
                      <input type="file" name="image" id="EditMCPhoto" required/>
                      <br><br>

                      <div class=".u-full-width">
                        <label>First Name:</label>
                        <br>
                        <input type="text" id="txtEditMCFNameModal" required/>
                      </div>
                            
                      <br>

                      <div class=".u-full-width">
                        <label>Last Name:</label>
                        <br>
                        <input type="text" id="txtEditMCLNameModal" required/>
                      </div>
                            
                      <br>

                      <div class=".u-full-width">
                        <label>CID:</label>
                        <br>
                        <input type="text" id="txtEditMCCIDModal" required/>
                      </div>

                  </div>
      
                </div>

              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-teal" type="button" id="btnEditMC">Update</button>
              </div>

          </form>

        </div>

      </div>

    </div>

          </div>

    </div>

<!--########################End of Edit Modal########################-->



<!--########################Delete Modal########################-->

<div class="modal fade" id="RemoveMCModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

                      <label>MC ID: <strong id="txtDeleteMCIDModal"></strong></label>

                      <br>

                      <label>First Name: <strong id="txtDeleteMCFnameModal"></strong></label>
                            
                      <br>
                     
                      <label>Last Name: <strong id="txtDeleteMCLnameModal"></strong></label>

                      <br>
                     
                      <label>CID: <strong id="txtDeleteMCCIDModal"></strong></label>
                 
                  </div>
      
                </div>

              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-teal" type="button" id="btnDeleteMC">Delete</button>
              </div>

          </form>


        </div>

      </div>

    </div>

          </div>

    </div>

<!--#############################End of Rmove Modal############################-->






</body>

<?php include '../../include/script.php';?>

</body>
</html>
