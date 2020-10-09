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
  <title>MC Ordering System - Customers List</title>
  
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

<div class="main-header">
        <div class="main-header__intro-wrapper">
          <div class="main-header__welcome">
            
            <div class="main-header__welcome-title text-light">
              <strong>C</strong>ustomers
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

      <table class="table table-bordered" id="customersTable" width="100%" cellspacing="0">
              
          <thead>
                <tr>
                  <th>Personnel</th>
                  <th>CID</th>
                  <th>Group</th>
                  <th>Area</th>
                  <th>Crew</th>
                </tr>
              </thead>

            <tbody>

            <?php require_once('../../include/connectionEE.php');

              $result = $conn->prepare("SELECT Name, 
                                               Surname, 
                                               CID, 
                                               Group1,
                                               Plant, 
                                               CREW
                                        FROM emp_name
                                        WHERE Plant = 'P2' AND (Group1 LIKE '%MS1%' OR Group1 LIKE '%MS2%' OR Group1 LIKE '%T2K%' OR Group1 LIKE '%Digital%') 
                                        ORDER BY Name ASC");
              $result->execute();

              for($i=0; $row = $result->fetch(); $i++){ ?>

                <tr>
                  <td><?php echo $row['Name'];?> <?php echo $row['Surname'];?></td>
                  <td><?php echo $row['CID'];?></td>
                  <td><?php echo $row['Group1'];?></td>
                  <td><?php echo $row['Plant'];?></td>
                  <td><?php echo $row['CREW'];?></td>
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
<!--###############################End of Page Content###############################-->

  <?php include '../../include/footer.php';?> 


<!--###############################Add Modal###############################-->

<div class="modal fade" id="AddCustModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Customer</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          
            <form class="needs-validation" id="AddCustomerForm" novalidate>
              <div class="modal-body">
                              
                <br>

                  <div class="row" style="text-align:right; margin-left:10px; margin-bottom:15px;">

                    <div class=".u-full-width">

                      <label>Customer Name: </label>
                      <input type="text" id="txtAddCustomerModal" required/>
                            
                      <br><br>

                      <div class=".u-full-width">
                        <label>CID: </label>
                        <input type="number" id="txtAddCIDModal" required/>
                      </div>

                  </div>
      
                </div>

              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-teal" type="button" id="btnAddtoCustomer">Save</button>
              </div>

          </form>

        </div>

      </div>

    </div>

          </div>

    </div>

<!--###############################End of Edit Modal###############################-->



<!--###############################Edit Modal###############################-->

<div class="modal fade" id="EditCustModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Customer Details</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          
            <form>
              <div class="modal-body">
                              
                <br>

                  <div class="row" style="text-align:right; margin-left:10px; margin-bottom:15px;">

                    <div class=".u-full-width">

                      <label id="txtEditCustomerIDModal">Customer #: </label>
                            
                      <br><br>

                      <label>Customer Name: </label>
                      <input type="text" id="txtEditCustomerNameModal" required/>
                            
                      <br><br>

                      <div class=".u-full-width">
                        <label>CID: </label>
                        <input type="number" id="txtEditCIDModal" required/>
                      </div>

                  </div>
      
                </div>

              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <input class="btn btn-teal" type="submit" value="Update" id="btnEditCustomer">
              </div>

          </form>

        </div>

      </div>

    </div>

          </div>

    </div>

<!--###############################End of Edit Modal###############################-->



<!--###############################Remove Modal###############################-->

<div class="modal fade" id="RemoveCustModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this customer?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>

<form>
              <div class="modal-body">
                              
                <br>

                  <div class="row" style="text-align:left; margin-left:10px; margin-bottom:15px;">

                    <div class=".u-full-width">

                      <label>Customer #: <strong id="txtDeleteCustomerIDModal"></strong></label>

                      <br>

                      <label>Customer Name: <strong id="txtDeleteCustomerNameModal"></strong></label>
                            
                      <br>
                     
                      <label>CID: <strong id="txtDeleteCIDModal"></strong></label>
                 
                  </div>
      
                </div>

              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-teal" type="button" id="btnDeleteCustomer">Delete</button>
              </div>

          </form>

        </div>

      </div>

    </div>

          </div>

    </div>

<!--###############################End of Rmove Modal###############################-->






</body>

<?php include '../../include/script.php';?>

</body>
</html>
