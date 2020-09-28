<?php 
	if (!isset($_SESSION["user_email"])) {
		echo "<script>window.open('login.php','_self');</script>";	
	}

	if ( isset($_POST["update_account"]) )
    {
      $e_name          = $_POST["e_name"];
      $e_email         = $_POST["e_email"];
      $e_contact       = $_POST["e_contact"];
      $e_img           = $_FILES["e_img"]["name"];
      $e_temp_img      = $_FILES["e_img"]["tmp_name"];
      move_uploaded_file($e_temp_img, "images/user/$e_img");

	  $update_user 		= "UPDATE users SET user_name='$e_name',user_email='$e_email',user_contact='$e_contact',user_img='$e_img' WHERE id = '$id'";
      $run_update_user 	= mysqli_query($con,$update_user);

      if ($run_update_user) {
		echo "<script>alert('Account Information Updated Successfully. Please Login Back Again :)')</script>";
		session_destroy();
		echo "<script>window.open('login.php','_self');</script>";	
      }else{
        echo "<script>alert('Account Information Updation Failed, Please Contact Administrator')</script>";
      } 

    }

?>
<div class="container">

	<h1 class="text-center mb-5"> Edit Your Account </h1>
	<form method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label>Name:</label>
			<input type="text" class="form-control b-r-25" name="e_name" value="<?php echo($name); ?>" required></input>
		</div>

		<div class="form-group">
			<label>Email:</label>
			<input type="email" class="form-control b-r-25" name="e_email" value="<?php echo($email); ?>" required></input>
		</div>

		<div class="form-group">
			<label>Contact:</label>
			<input type="text" class="form-control b-r-25" name="e_contact" pattern="[0-9]+" value="<?php echo($contact); ?>" required></input>
		</div>
		<div class="clearfix">
			<div class="form-group float-left">
				<label>Image:</label>
				<input type="file" class="form-control-file " name="e_img" required></input>
			</div>
			<img class="float-right img_edit_account z-depth-2" src="images/user/<?php echo($img); ?>" alt="Your Image">
		</div>

		<div class="text-center mt-5">
			<button type="submit" name="update_account" class="btn btn-block b-r-25 btn-lg btn-primary">
				<i class="fas fa-sync-alt"></i> Update
			</button>
		</div>

	</form>

</div>