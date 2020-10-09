<!-- ############################################ -->
<!-- ############################################ -->
<!-- ############################################ -->
<!-- ############################################ -->
<!-- ############################################ -->
<!-- ############################################ -->
<!-- ############################################ -->
<!-- ############################################ -->


<?php
  session_start();
  include('include/conn.php');
?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>MC Ordering System</title>
  
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css'>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/css/dataTables.bootstrap4.css'>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css'>
  <link rel="stylesheet" href="include/css/style.css">

<meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  
  <!--###############################Navigation###############################-->

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    
  <a class="navbar-brand" href="index.php"><strong> MC </strong> Ordering System</a>
    
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  
  <div class="collapse navbar-collapse" id="navbarResponsive">
    <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
      <li class="nav-item">
        <a class="nav-link" href="index.php">
          <i class="fa fa-fw fa-home"></i>
          <span class="nav-link-text"><strong>H</strong>ome</span>
        </a>
      </li>
        <hr>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
        <a class="nav-link" href="page/index/neworder.php">
          <i class="fa fa-fw fa-file"></i>
          <span class="nav-link-text"><strong>N</strong>ew Order</span>
        </a>
      </li>
      <hr>
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
        <a class="nav-link" href="page/index/about.php">
          <i class="fa fa-fw fa-info"></i>
          <span class="nav-link-text"><strong>A</strong>bout</span>
        </a>
      </li>
       <hr>
    </ul>

    <ul class="navbar-nav sidenav-toggler">
      <li class="nav-item">
        <a class="nav-link text-center" id="sidenavToggler">
          <i class="fa fa-fw fa-angle-left"></i>
        </a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown Responsive">
        <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-fw fa-bell"></i>
          
          <span class="d-lg-none">Alerts
            <span class="badge badge-pill badge-warning">6 New</span>
          </span>
          
          <span class="indicator text-warning d-none d-lg-block">
            <i class="fa fa-fw fa-circle"></i>
          </span>
        </a>

        <div class="dropdown-menu" aria-labelledby="alertsDropdown" style="margin-left: -140px;">
        
        <h6 class="dropdown-header">New Alerts:</h6>
        <div class="dropdown-divider"></div>


        <?php require('include/connection.php');

            $result = $conn->prepare("SELECT tblupdates.Update_ID,
                                             tblupdates.Order_ID, 
                                             tblupdates.OrderStatus_ID,DATE_FORMAT(tblorders.Order_Date, '%T') AS Daito, 
                                             tblorders.Order_Date
                                      FROM tblupdates
                                      LEFT JOIN tblorders ON tblorders.Order_ID = 
                                                                tblupdates.Order_ID
                                      WHERE tblupdates.OrderStatus_ID != 1                      
                                      ORDER BY tblupdates.Update_ID DESC
                                      LIMIT 5");
            $result->execute();

              for($i=0; $row = $result->fetch(); $i++){ ?>
          
            <a class="dropdown-item" href="#">
              <span class="text-success">
                <strong>
                    <i class="fa fa-long-arrow-up fa-fw"></i>Status Update
                </strong>
              </span>

              <span class="small float-right text-muted"><?php echo $row['Daito'];?></span>
              <div class="dropdown-message">
                <?php if($row['OrderStatus_ID'] == 2){
                        echo "Your Order #" . $row['Order_ID'] . " is being processed.";
                      }

                      elseif($row['OrderStatus_ID'] == 3){
                        echo "Your Order #" . $row['Order_ID'] . " is available for pickup.";
                      }

                      elseif($row['OrderStatus_ID'] == 4){
                        echo "Your Order #" . $row['Order_ID'] . " is delivered.";
                      }

                      else{
                        echo "N/A";
                      } ?></div>
            </a>

          <div class="dropdown-divider"></div>

          <?php } ?>

          </div>

        </li>

        <li class="nav-item" style="color:white;">
          <a class="nav-link" data-toggle="modal" data-target="#LoginModal">
            <i class="fa fa-fw fa-sign-in" style="color:white;"></i>Login</a>
        </li>

      </ul>

    </div>

  </nav>

  <!--###############################End of Navigation###############################-->









  <!--###############################Page Content###############################-->

<div class="content-wrapper">
 <div class="main-header">
      <div class="main-header__intro-wrapper">
        <div class="main-header__welcome">
          <div class="main-header__welcome-subtitle text-light">Welcome to</div>
          <div class="main-header__welcome-title text-light"><strong>Material Control</strong> Ordering System</strong></div>
          <div class="main-header__welcome-subtitle text-light">

          </div>
        </div>
        
        <div class="quickview">

<?php
    require_once('include/connection.php');

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
            <img class="document__img" src="<?php echo ''.$row['MC_Photo'];?>" alt="<?php echo $row['MC_Fname'];?>">
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
        
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card darkgrey o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon red">
          <i class="fa fa-fw fa-shopping-cart"></i>
          </div>

          <?php
            ob_start();
            system('ipconfig/all');
            $mycom=ob_get_contents(); 
            ob_clean(); 
            $findme = "Physical";
            $pmac = strpos($mycom, $findme); 
            $mac=substr($mycom,($pmac+36),17);

                require('include/conn.php');

                $result = mysqli_query($conn,"SELECT OrderStatus_ID 
                                              FROM tblorders 
                                              WHERE OrderStatus_ID = 1 
                                              AND Customer_PCName='$mac'");
                $rows = mysqli_num_rows($result);
                     
              ?>

          <div class="mr-5"><strong>(<?php echo "" . $rows . "";?>)</strong> On-Queue Orders</div>
      
      
      </div>

      <a class="card-footer darkgrey clearfix small z-1" href="page/index/onqueue-orders.php">
              
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
              <div class="card-body-icon yellow">
                <i class="fa fa-fw fa-shopping-cart"></i>
              </div>
              <?php
                ob_start();
            system('ipconfig/all');
            $mycom=ob_get_contents(); 
            ob_clean(); 
            $findme = "Physical";
            $pmac = strpos($mycom, $findme); 
            $mac=substr($mycom,($pmac+36),17);

                require('include/conn.php');

                $result = mysqli_query($conn,"SELECT OrderStatus_ID 
                                              FROM tblorders 
                                              WHERE OrderStatus_ID = 2 
                                              AND Customer_PCName='$mac'");
                $rows = mysqli_num_rows($result);
                     
              ?>

          <div class="mr-5"><strong>(<?php echo "" . $rows . "";?>)</strong> Processing Orders</div>
      
            </div>
            <a class="card-footer darkgrey clearfix small z-1" href="page/index/processing-orders.php">
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
              <div class="card-body-icon green">
                <i class="fa fa-fw fa-shopping-cart"></i>
              </div>
              <?php
                ob_start();
            system('ipconfig/all');
            $mycom=ob_get_contents(); 
            ob_clean(); 
            $findme = "Physical";
            $pmac = strpos($mycom, $findme); 
            $mac=substr($mycom,($pmac+36),17);

                require('include/conn.php');

                $result = mysqli_query($conn,"SELECT OrderStatus_ID 
                                              FROM tblorders 
                                              WHERE OrderStatus_ID = 3 
                                              AND Customer_PCName='$mac'");
                $rows = mysqli_num_rows($result);
                     
              ?>

          <div class="mr-5"><strong>(<?php echo "" . $rows . "";?>)</strong> For Pickup</div>
      
            </div>
            <a class="card-footer darkgrey clearfix small z-1" href="page/index/forpickup-orders.php">
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
              <div class="card-body-icon blue">
                <i class="fa fa-fw fa-shopping-cart"></i>
              </div>
              <?php
                ob_start();
                system('ipconfig/all');
                $mycom=ob_get_contents(); 
                ob_clean(); 
                $findme = "Physical";
                $pmac = strpos($mycom, $findme); 
                $mac=substr($mycom,($pmac+36),17);

                require('include/conn.php');

                $result = mysqli_query($conn,"SELECT OrderStatus_ID 
                                              FROM tblorders 
                                              WHERE OrderStatus_ID = 4 
                                              AND Customer_PCName='$mac'");
                $rows = mysqli_num_rows($result);
                     
              ?>

          <div class="mr-5"><strong>(<?php echo "" . $rows . "";?>)</strong> Completed Orders</div>
      
            </div>
            <a class="card-footer darkgrey clearfix small z-1" href="page/index/completed-orders.php">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>

</div>

<br><hr><br>



<div class="row">

<div class="col-xl-8 col-sm-6 mb-3">

<div class="cardo">

  <div class="cardo">

    <div class="documents">

            <div class="aboutpatch">
        <div class="aboutpatch-body"> 

        <div class="ordernow">
          <div class="row">
            <div class="aboutpatch">
            <div class="aboutpatch-header2"><h1>Need <strong>Something?</strong></h1></div>
            <div class="aboutpatch-header"><h2>Order NOW!</div> 
        </div>

            <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card whitefont black o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon teal">
                <i class="fa fa-fw fa-file"></i>
              </div>
             


          <div class="mr-5">New <strong>Order</strong></div>
      
            </div>
            <a class="card-footer whitefont clearfix small z-1" href="page/index/neworder.php">
              <span class="float-left">Order HERE</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>

         <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card whitefont teal o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon black">
                <i class="fa fa-fw fa-search"></i>
              </div>
             
          <div class="mr-5">View <strong>Order</strong></div>
      
            </div>
            <a class="card-footer whitefont clearfix small z-1" href="page/index/all-orders.php">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>

          </div></div>


        </div>

      </div> 
      
    </div>

  </div>

</div>
</div>

<div class="col-xl-4 col-sm-6 mb-3">

<div class="cardo">

  <div class="cardo">

      <div class="aboutpatch">
        <div class="aboutpatch-header"><h1>Have a <strong>Question?</strong></h1></div> 
        <div class="aboutpatch-header2"><h3>We have<strong> Answers!</strong></h3></div>
        <div class="aboutpatch-body">
          <h5>Our beloved MC Team will answer you as soon as possible. </h5>
          <h3><strong> MC Local: #2881 </strong></h3>
        </div>
      </div>    

    </div>
  </div>
</div>


</div>

  </div>

</div>
</div>

  <!--###############################End of Page Content###############################-->

  <?php include 'include/footer.php';?> 


<!--###############################Login Modal###############################-->

<div class="modal fade" id="LoginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">LOGIN</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          
            <form method="POST" action="include/login.php">
              <div class="modal-body">
                              
                <br>

                  <div class="row" style="text-align:right; margin-left:10px; margin-bottom:15px;">

                    <div class=".u-full-width">

                      <label>Username:</label>
                      <input type="text" value="<?php if (isset($_COOKIE["user"])){echo $_COOKIE["user"];}?>" name="uname">
                            
                      <br><br>

                      <div class=".u-full-width">
                        <label>Password:</label>
                        <input type="password" value="<?php if (isset($_COOKIE["pass"])){echo $_COOKIE["pass"];}?>" name="pword">
                      </div>

                  </div>
      
                </div>

              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <input class="btn btn-teal" type="submit" value="Login" name="login">
              </div>

          </form>

        </div>

      </div>

    </div>

          </div>

    </div>

<!--###############################End of Login Modal###############################-->

</body>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.5/umd/popper.js'></script>
<script src='https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/js/dataTables.bootstrap4.js'>
</script><script  src="include/js/script.js"></script>

</body>
</html>
