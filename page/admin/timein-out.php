<?php
  session_start();
  include('../../include/conn.php');

?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>MC Ordering System - Time IN/OUT</title>
  
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

      <div class="main-header">
        <div class="main-header__intro-wrapper">
          <div class="main-header__welcome">
            
            <div class="main-header__welcome-title text-light">
              <strong>Time</strong> IN/OUT
            </div>

            <div class="main-header__welcome-subtitle text-light">
            </div>

          </div> <!--Main Header Welcome-->
        </div> <!--Main Header Intro Wrapper-->
      </div>  <!--Main Header-->



    <form>

    <br>

              
      <div class=".u-full-width" style="text-align:center;" id="Uvuwewewe">

        <label style="font-size:80px;">CID:</label>
        <input type="text" id="txtMCStatusCID" style="width:500px; height:70px; font-size:70px;"> 
        <br><br>
      <div id="Attend">
      </div>
      </div>
    

                  
      
      

          </form>

    </div> <!--Content Wrapper-->
  <!---------------------------------End of Page Content-------------------------------->

  <?php include '../../include/footer.php';?> 

</body>

<?php include '../../include/script.php';?>


</body>
</html>
s