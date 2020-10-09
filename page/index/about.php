<?php
  session_start();
  include('../../include/conn.php');

?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>MC Ordering System - About</title>
  
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

<div class="main-header" style="height:100px;">
        <div class="main-header__intro-wrapper">
          <div class="main-header__welcome">
            
            <div class="main-header__welcome-title text-light" style="padding-bottom:50px;">
              <strong>A</strong>bout
            </div>

            <div class="main-header__welcome-subtitle text-light">
            </div>

          </div> <!--Main Header Welcome-->
        </div> <!--Main Header Intro Wrapper-->
      </div>  <!--Main Header-->
        
    <div class="container-fluid">
      <div class="row">

          <!--Main Content-->
        <div class="col-xl-8 col-sm-6 mb-3">
          <div class="cardo">
            <div class="cardo">
              <div class="documents">
                <div class="aboutpatch">

                <div class="aboutpatch-header">
                  <h1><strong>Material Control</strong> Ordering System</h1>
                </div> 

                <div class="aboutpatch-header2">
                  <h2>or <strong>MCOS</strong></h2>
                </div>

                <br>

                <div class="aboutpatch-body"> - is a website where the production can use to request for materials to be used for their tasks. 
                You do not need to go back and forth to check if the items you need is/are available. 
                By using this website, it will increase productivity since you won't need to leave your designated area just to ask for the material you need, specially if you are placed far away.
        
                <br><br><hr>

                <div class="aboutmcos">
                  <div class="row">
                    <div class="aboutpatch">
                    <div class="aboutpatch-header2"><h1>Have a<strong> Question?</strong></h1></div>
                    <div class="aboutpatch-header"><h2>We have answers!</div> 
                </div>

                <div class="col-xl-5 col-sm-6 mb-3">
                  <div class="card whitefont teal o-hidden h-100">
                    <div class="card-body">
                      <div class="card-body-icon black">
                        <i class="fa fa-fw fa-question"></i>
                      </div>

                      <div class="mr-5">
                        MCOS <strong>Manual</strong>
                      </div>
                    </div>

                    <a class="card-footer whitefont clearfix small z-1" href="trainingmanual.php">
                      <span class="float-left">
                        View Details
                      </span>

                      <span class="float-right">
                        <i class="fa fa-angle-right"></i>
                      </span>
                    </a>
                  </div>
                </div>
              </div>              
            </div>

          <br><br><hr>
        
          </div>
        </div> 
      </div>
    </div>
  </div>
</div>
          <!--Sub Content-->
          <div class="col-xl-4 col-sm-6 mb-3">

            <div class="cardo">

              <div class="card__header">
                <div class="card__header-title text-light">
                  <strong>Contact PATCH</strong>
                </div>
              </div>

              <div class="cardo">

                <div class="aboutpatch">

                  <div class="aboutpatch-header">
                    <h1>Don't be a <strong>stranger</strong></h1>
                  </div> 

                  <div class="aboutpatch-header2">
                    <h2>Just say <strong>Hello.</strong></h2>
                  </div>
                    
                  <br>

                  <div class="aboutpatch-body">Feel free to get in touch with me. I am always open to discussing new project, creative ideas or opportunities to be part of your visions.
                      
                    <br><br><hr><br>

                    <form action='../../include/contact.php' method='POST'>
                    
                      <input type="text" value="" name="contactname" placeholder="Name" required/>
                      <br><br>
                      <input type="email" value="" name="contactemail" placeholder="Email" required/>
                      <br><br>
                      <input type="text" value="" name="contactsubject" placeholder="Subject" required/>
                      <br><br>
                      <textarea placeholder="Message" name="contactmessage" required/></textarea>
                      <br><br>
                      <input class="btn btn-teal" type="submit" value="Send" name="sendemail" required/>

                    </form>

                    <br><hr>

                  </div>
                </div>    
              </div> <!--Cardo 2 Inner-->
            </div> <!--Cardo 2 Outer-->
          </div> <!--Sub Content-->
        </div> <!--Row-->
      </div> <!--Container Fluid-->
    </div> <!--Content Wrapper-->
  <!---------------------------------End of Page Content-------------------------------->

  <?php include '../../include/footer.php';?> 

</body>

<?php include '../../include/script.php';?>


</body>
</html>
