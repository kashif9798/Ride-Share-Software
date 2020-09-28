<?php
    include('includes/DBconn.php'); 
    include('includes/header.php'); 

    if ( isset($_POST["login_submit"]) )
    {
      $user_email         = mysqli_real_escape_string($con,$_POST["login_email"]);
      $user_pass          = mysqli_real_escape_string($con,$_POST["login_pass"]);

      $check_email  = "SELECT COUNT(id) as checkEmail FROM users WHERE user_email = '$user_email' AND user_password = '$user_pass' ";
      $run_email    = mysqli_query($con,$check_email);
      $row_email    = mysqli_fetch_array($run_email);
      $count_email  = $row_email["checkEmail"];

      if ($count_email > 0 ){
        $_SESSION["user_email"] = $user_email;
        echo "<script>window.open('account.php','_self');</script>";	
      }else{
        echo "<script>alert('Wrong email or password, Please try again :)')</script>";
      } 

    }
?>


<div class="container mt-5">
  <div class="row">
    <div class="offset-0 col-12 offset-md-3 col-md-6">
      <form method="post" class="card b-r-25 z-depth-2">
        <div class="card-body">
          <div class="card-title">
            <h2 class="text-center">Log in</h2>
          </div>

          <div class="form-group">
            <label for="login-email">Email</label>
            <input type="email" id="login-email" class="form-control b-r-25" name="login_email">
          </div>

          <div class="form-group">
            <label for="login-pass-input">Password</label>
            <div class="input-group mb-3">
              <input type="password" id="login-pass-input" class="form-control b-r-25" name="login_pass">
              <div class="input-group-append">
                <button id="login-pass-btn" class="btn btn-primary b-r-25"> <i class="fas fa-eye"></i> </button>
              </div>
            </div>
          </div>

          <button type="submit" name="login_submit" class="btn btn-primary btn-lg mt-4 btn-block b-r-25">Log in</button>
          <a href="signup.php" class="float-right mt-4">Don't have an account? Register here!</a>
        </div>
      </form>
    </div>
  </div>
</div>




<?php
    include('includes/footer.php'); 
?>
