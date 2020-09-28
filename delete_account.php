<?php 
	if (!isset($_SESSION["user_email"])) {
		echo "<script>window.open('login.php','_self');</script>";	
	}
?>
<div class="container">

	<h1 class="text-center mb-5"> Delete Your Account </h1>

	<h2 class="text-center"> Do you really have to go ? <img src="images/emoji/puppy-eyes.png" class="puppy-eyes" alt="puppy eyes emoji"></h2>

	<form class="mt-5 row" method="post">
		<button type="submit" name="yes" onclick="return confirm('Are you sure?')" class="btn btn-outline-danger col btn-delete"> Yes, I do </button>
		<button type="submit" name="no" class="btn btn-outline-primary col btn-delete"> No, I don't </button>
	</form>

</div>
<?php


	if (isset($_POST["yes"])) 
	{
		
		$delete_user = "DELETE FROM users WHERE id = '$id'";

		$run_delete_user = mysqli_query($con,$delete_user);

		if ($run_delete_user) 
		{
			session_destroy();
			echo "
				<script>
					alert('Successfully deleted your Account, good bye... :( ');
					window.open('index.php','_self');
				</script>
			";
		}
	
	}

	if (isset($_POST["no"]))
	{
		echo "<script>window.open('index.php','_self');</script>";	
	} 
?>