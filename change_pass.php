<?php 
	if (!isset($_SESSION["user_email"])) {
		echo "<script>window.open('login.php','_self');</script>";	
	}

	if ( isset($_POST["update_password"]) )
    {
	  $e_old_pass          = $_POST["e_old_pass"];
	  
	  if($password !== $e_old_pass)
	  {
		echo "<script>window.open('account.php?password&invalid','_self');</script>";
	  }else{ 
	  	$e_new_pass         = $_POST["e_pass"];
	  
		$update_user_pass 		= "UPDATE users SET user_password='$e_new_pass' WHERE id = '$id'";
		$run_update_user_pass 	= mysqli_query($con,$update_user_pass);
	  }

      if ($run_update_user_pass) {
		echo "<script>alert('Password successfully updated. Please Login Back Again :)')</script>";
		session_destroy();
		echo "<script>window.open('login.php','_self');</script>";	
      }else{
        echo "<script>alert('Password Updation Failed, Please Contact Administrator')</script>";
      } 

    }

?>
<div class="container">

	<h1 class="text-center mb-5"> Change Your Password </h1>
	<form method="post">
		
		<div class="form-group">
            <label for="signup-pass-input">Old Password</label>
            <div class="input-group mb-3">
              <input type="password" id="login-pass-input" class="form-control b-r-25" name="e_old_pass" required>
              <div class="input-group-append">
                <button id="login-pass-btn" class="btn btn-primary b-r-25"> <i class="fas fa-eye"></i> </button>
              </div>
			</div>
			<?php if(isset($_GET['invalid'])): ?>
				<div class="text-danger">
					Invalid Old Password, Please try again 
				</div>
			<?php endif; ?>
          </div>


          <div class="form-group">
            <label for="signup-pass-input">New Password</label>
            <div class="input-group mb-3">
              <input type="password" id="signup-pass-input" class="form-control b-r-25" name="e_pass" required>
              <div class="input-group-append">
                <button id="signup-pass-btn" class="btn btn-primary b-r-25"> <i class="fas fa-eye"></i> </button>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="signup-confirm-pass-input">New Confirm Password</label>
            <div class="input-group mb-3">
              <input type="password" id="signup-confirm-pass-input" class="form-control b-r-25" name="e_confirm_pass" required>
              <div class="input-group-append">
                <button id="signup-confirm-pass-btn" class="btn btn-primary b-r-25"> <i class="fas fa-eye"></i> </button>
              </div>
            </div>
            <div class="invalid-feedback signup-invalid-passwords">
              Passwords do not match
            </div>
          </div>

		<div class="text-center mt-5">
			<button type="submit" id="signup_submit" name="update_password" class="btn btn-block btn-lg b-r-25 btn-primary">
				<i class="fas fa-sync-alt"></i> Update Password
			</button>
		</div>

	</form>

</div>