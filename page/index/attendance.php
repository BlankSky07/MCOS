<div class="modal fade" id="AttendModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">LOGIN</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          
            <form method="POST" action="include/attendance.php">

              <div class="modal-body">
                              
                <br>

                  <div class="row" style="margin-left:10px; margin-bottom:15px;">

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