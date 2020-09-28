<?php 
	if (!isset($_SESSION["user_email"])) {
		echo "<script>window.open('login.php','_self');</script>";	
	}
?>
<div class="card bg-light text-dark z-depth-3">

	<img src="images/user/<?php echo($img); ?>" class="img-fluid card-img-top" alt="Account profile image">

	<div class="card-body">

		<h5 class="card-title text-center"><?php echo($name); ?></h5>
		<p class="card-text text-center"><i class="fas fa-phone-alt"></i> &nbsp <?php echo($contact); ?></p>

		<ul class="nav nav-pills flex-column">

			<li class="nav-item links_card <?php echo( !isset($_GET['rides']) && !isset($_GET['account'])  && !isset($_GET['password']) && !isset($_GET['delete']) ? 'bg-primary' : ''); ?>">
				<a href="account.php?messsages" class="nav-link nav-link-custom-account <?php echo( !isset($_GET['rides']) && !isset($_GET['account'])  && !isset($_GET['password']) && !isset($_GET['delete']) ? 'text-white' : ''); ?>">
					<i class="fas fa-envelope"></i> Messages
				</a>
			</li>

			<li class="nav-item links_card mt-1 <?php echo( isset($_GET['rides'])  ? 'bg-primary' : ''); ?>">
				<a href="account.php?rides" class="nav-link nav-link-custom-account <?php echo( isset($_GET['rides'])  ? 'text-white' : ''); ?>">
					<i class="fas fa-car"></i> My Rides
				</a>
			</li>

			<li class="nav-item links_card mt-1 <?php echo( isset($_GET['account'])  ? 'bg-primary' : ''); ?>">
				<a href="account.php?account" class="nav-link nav-link-custom-account <?php echo( isset($_GET['account'])  ? 'text-white' : ''); ?>">
					<i class="fas fa-user-edit"></i> Edit Account
				</a>
			</li>

			<li class="nav-item links_card mt-1 <?php echo( isset($_GET['password'])  ? 'bg-primary' : ''); ?>">
				<a href="account.php?password" class="nav-link nav-link-custom-account <?php echo( isset($_GET['password'])  ? 'text-white' : ''); ?>">
					<i class="fas fa-key"></i> Change Password
				</a>
			</li>

			<li class="nav-item links_card mt-1 <?php echo( isset($_GET['delete'])  ? 'bg-primary' : ''); ?>">
				<a href="account.php?delete" class="nav-link nav-link-custom-account <?php echo( isset($_GET['delete'])  ? 'text-white' : ''); ?>">
					<i class="fas fa-trash"></i> Delete Account
				</a>
			</li>

         <li class="nav-item links_card mt-1">
            <a href="logout.php" class="nav-link nav-link-custom-account">
               <i class="fas fa-sign-out-alt"></i> Log Out
            </a>
         </li>

		</ul>
	</div>
</div>
