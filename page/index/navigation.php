<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    
  <a class="navbar-brand" href="index.php"><strong> MC </strong> Ordering System</a>
    
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  
  <div class="collapse navbar-collapse" id="navbarResponsive">
    <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
      <li class="nav-item">
        <a class="nav-link" href="../../index.php">
          <i class="fa fa-fw fa-home"></i>
          <span class="nav-link-text"><strong>H</strong>ome</span>
        </a>
      </li>
        <hr>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
        <a class="nav-link" href="../../page/index/neworder.php">
          <i class="fa fa-fw fa-file"></i>
          <span class="nav-link-text"><strong>N</strong>ew Order</span>
        </a>
      </li>
      <hr>
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
        <a class="nav-link" href="../../page/index/about.php">
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
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-fw fa-bell"></i>
          
          <span class="d-lg-none">Alerts
            <span class="badge badge-pill badge-warning">6 New</span>
          </span>
          
          <span class="indicator text-warning d-none d-lg-block">
            <i class="fa fa-fw fa-circle"></i>
          </span>
        </a>

        <div class="dropdown-menu" aria-labelledby="alertsDropdown"  style="margin-left: -140px;">
        
        <h6 class="dropdown-header">New Alerts:</h6>
        <div class="dropdown-divider"></div>


        <?php require('../../include/connection.php');

            $result = $conn->prepare("SELECT tblupdates.Update_ID,
                                             tblupdates.Order_ID, 
                                             tblupdates.OrderStatus_ID, DATE_FORMAT(tblorders.Order_Date, '%T') AS Daito,
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





  <!---------------------------------Login Modal-------------------------------->

<div class="modal fade" id="LoginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">LOGIN</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          
            <form method="POST" action="../../include/login.php">
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

<!---------------------------------End of Login Modal-------------------------------->