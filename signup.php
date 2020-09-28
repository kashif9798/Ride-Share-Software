<?php
    include('includes/DBconn.php'); 
    include('includes/header.php'); 

    if ( isset($_POST["signup_submit"]) )
    {
      $user_name          = $_POST["signup_name"];
      $user_email         = $_POST["signup_email"];
      $user_pass          = $_POST["signup_pass"];
      $user_contact       = $_POST["signup_contact"];
      $user_img           = $_FILES["signup_image"]["name"];
      $temp_img           = $_FILES["signup_image"]["tmp_name"];
      move_uploaded_file($temp_img, "images/user/$user_img");

      $check_email  = "SELECT COUNT(id) as checkEmail FROM users WHERE user_email = '$user_email'";
      $run_email    = mysqli_query($con,$check_email);
      $row_email    = mysqli_fetch_array($run_email);
      $count_email  = $row_email["checkEmail"];

      if ($count_email > 0 ){
        echo "<script>window.open('signup.php?emailCheck=1','_self');</script>";	
      }else{
        $insert_user = "INSERT INTO users (user_name,user_email,user_password,user_contact,user_img) VALUES ('$user_name','$user_email','$user_pass','$user_contact','$user_img')";

        $run_user = mysqli_query($con,$insert_user);
      }

      if ($run_user) {
        $_SESSION["user_email"] = $user_email;
        echo "<script>window.open('account.php','_self');</script>";	
      }else{
        echo "<script>alert('Sign up Failed, Please contact administrator')</script>";
      } 

    }
?>


<div class="container mt-5">
  <div class="row">
    <div class="offset-0 col-12 offset-md-3 col-md-6">
      <form method="post" enctype="multipart/form-data" class="card b-r-25 z-depth-2">
        <div class="card-body">
          <div class="card-title">
            <h2 class="text-center">Sign up</h2>
            <?php if( isset($_GET['emailCheck']) && $_GET['emailCheck'] == '1' ): ?>
              <div class="text-danger">
                * The Email last given already exist
              </div>
            <?php endif; ?>
          </div>
          <div class="form-group">
            <label for="signup-name">Name</label>
            <input type="text" id="signup-name" class="form-control b-r-25" name="signup_name" required>
          </div>

          <div class="form-group">
            <label for="signup-email">Email</label>
            <input type="email" id="signup-email" class="form-control b-r-25" name="signup_email" required>
          </div>
          

          <div class="form-group">
            <label for="signup-pass-input">Password</label>
            <div class="input-group mb-3">
              <input type="password" id="signup-pass-input" class="form-control b-r-25" name="signup_pass" required>
              <div class="input-group-append">
                <button id="signup-pass-btn" class="btn btn-primary b-r-25"> <i class="fas fa-eye"></i> </button>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="signup-confirm-pass-input">Confirm Password</label>
            <div class="input-group mb-3">
              <input type="password" id="signup-confirm-pass-input" class="form-control b-r-25" name="signup_confirm_pass" required>
              <div class="input-group-append">
                <button id="signup-confirm-pass-btn" class="btn btn-primary b-r-25"> <i class="fas fa-eye"></i> </button>
              </div>
            </div>
            <div class="invalid-feedback signup-invalid-passwords">
              Passwords do not match
            </div>
          </div>

          <div class="form-group">
            <label for="signup-contact">Contact Number</label>
            <input type="text" id="signup-contact" class="form-control b-r-25" name="signup_contact" pattern="[0-9]+" required>
          </div>

          <div class="form-group">
            <label for="signup-image">Upload your Profile Picture</label>
            <input type="file" id="signup-image" class="form-control-file" name="signup_image" required>
          </div>

          <button type="submit" name="signup_submit" id="signup_submit" class="btn btn-primary btn-lg mt-4 btn-block b-r-25">Sign up</button>
          <a href="login.php" class="float-right mt-4">Already have an account? Login here!</a>
        </div>
          
        

      </form>
    </div>
  </div>
</div>




<?php
    include('includes/footer.php'); 
?>
