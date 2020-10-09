<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    
  <a class="navbar-brand" href="admin.php"><strong>MC </strong> Ordering System</a>
    
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
    
  <div class="collapse navbar-collapse" id="navbarResponsive">
    <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
      <li class="nav-item">
        <a class="nav-link" href="admin.php">
          <i class="fa fa-fw fa-dashboard"></i>
          <span class="nav-link-text">Dashboard</span>
        </a>
      </li>
<hr>
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
        
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
          <i class="fa fa-fw fa-sitemap"></i>
          <span class="nav-link-text">Inventory</span>
        </a>

        <ul class="sidenav-second-level collapse" id="collapseComponents">
          <li>
            <a href="inventory.php">Inventory</a>
          </li>
          <hr>
          <li>
            <a href="orders.php">Orders</a>
          </li>
        </ul>

      </li>
<hr>

      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
        <a class="nav-link" href="counter.php">
          <i class="fa fa-fw fa-file"></i>
          <span class="nav-link-text">Counter</span>
        </a>
      </li>

<hr>
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
        <a class="nav-link" href="about.php">
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

<div class="dropdown-menu" aria-labelledby="alertsDropdown"  style="margin-left: -120px;">
        
        <h6 class="dropdown-header">New Alerts:</h6>
        <div class="dropdown-divider"></div>


        <?php require('../../include/connection.php');

            $result = $conn->prepare("SELECT tblupdates.Update_ID,tblupdates.Order_ID, tblupdates.OrderStatus_ID, DATE_FORMAT(tblorders.Order_Date, '%T') AS Daito,tblorderstatus.Order_Status
                                      FROM tblupdates
                                      LEFT JOIN tblorders ON tblorders.Order_ID = 
                                                                tblupdates.Order_ID
                                      LEFT JOIN tblorderstatus ON tblorderstatus.OrderStatus_ID = 
                                                                tblupdates.OrderStatus_ID
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
              <div class="dropdown-message"><?php echo "Order #" . $row['Order_ID'] . " is " . $row['Order_Status'] . ".";?></div>
            </a>

          <div class="dropdown-divider"></div>

          <?php } ?>

          </div>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="mainscreenview.php">
            <i class="fa fa-fw fa-tv"></i>Mainscreen View</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="timein-out.php">
            <i class="fa fa-fw fa-clock-o"></i>Time IN/OUT</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="managepersonnel.php">
            <i class="fa fa-fw fa-user"></i>Manage Personnel</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>

      </ul>
    </div>
  </nav>



  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-teal" href="../../index.php">Logout</a>
      </div>

    </div>
  </div>
</div>