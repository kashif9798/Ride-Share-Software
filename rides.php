<?php 
	if (!isset($_SESSION["user_email"])) {
		echo "<script>window.open('login.php','_self');</script>";	
	}


	$my_rides_count				= "SELECT COUNT(id) as rides_count FROM matched_rides WHERE rider_id = '$id' || passenger_id = '$id'";

	$run_my_rides_count			= mysqli_query($con,$my_rides_count);

	$row_my_rides_count			= mysqli_fetch_array($run_my_rides_count);

	$my_rides_count   			= $row_my_rides_count["rides_count"];	


?>
<div class="container">

	<h1 class="text-center mb-5"> All Your Rides </h1>
	<?php if ($my_rides_count < 1):?>
	<div class="text-center">
		<img src="images/search/not-found.png" alt="Not Found" class="img-fluid mt-5">
		<h3 class="text-muted mt-5">No Rides Found</h3>
	</div>
	<?php else:?>
		<div class="table-responsive">
			<table class="table table-bordered table-hover">
				<thead class="thead-light">
					<tr>
						<th>Ride ID</th>
						<th>Destination</th>
						<th>Status</th>
						<th>Details</th>

					</tr>
				</thead>

				<tbody>
						<?php 
						
						$select_my_rides_id			= "SELECT ride_id,completed FROM matched_rides WHERE rider_id = '$id' || passenger_id = '$id'";

						$run_my_rides_id			= mysqli_query($con,$select_my_rides_id);
					
						while($row_my_rides_id 		= mysqli_fetch_array($run_my_rides_id)):

							$my_rides_id   			= $row_my_rides_id["ride_id"];
							
							$my_rides_completed     = $row_my_rides_id["completed"];

							$select_my_rides		= "SELECT * FROM rides WHERE id = '$my_rides_id'";

							$run_my_rides			= mysqli_query($con,$select_my_rides);

							while($row_my_rides 	= mysqli_fetch_array($run_my_rides)):

								$rider_id_my_rides	= $row_my_rides["rider_id"];

								$dest_my_rides		= $row_my_rides["destination"];

						?>
					<tr>
						<td><?php echo($my_rides_id); ?></td>
						<td><?php echo($dest_my_rides); ?></td>
						<td>
							<?php if(empty($my_rides_completed)): ?>
								<button class="btn btn-secondary">Pending</button>
							<?php else: ?>
								<button class="btn btn-primary">Completed</button>
							<?php endif;?>
						</td>
						<td><a href="ride-details.php?ride_id=<?php echo ($my_rides_id); ?>&rider_id=<?php echo ($rider_id_my_rides); ?>" class="btn btn-primary">Details</a></td>
					</tr>
							<?php endwhile; ?>
						<?php endwhile; ?>
				</tbody>

			</table>
		</div>
	<?php endif;?>


</div>