<?php 
	if (!isset($_SESSION["user_email"])) {
		echo "<script>window.open('login.php','_self');</script>";	
	}
	if( isset($_GET["show_message_id"]) && isset($_GET["first_message"]) ){
		$first_message_rider_id		= $_GET["show_message_id"];
		$first_message_insert		= "INSERT INTO messages (rider_id,passenger_id,sent_by) VALUES('$first_message_rider_id','$id','$id')";
		$run_first_message_insert	= mysqli_query($con,$first_message_insert);
		
	}
	if(isset($_POST["messenger-sender-btn"])){
		$messenger_rider_id		= $_GET["show_message_id"];		
		$messenger_sender_input = $_POST["messenger_sender_input"];
		$messenger_insert		= "INSERT INTO messages (rider_id,passenger_id,sent_by,message) VALUES('$messenger_rider_id','$id','$id','$messenger_sender_input')";
		$run_messenger_insert	= mysqli_query($con,$messenger_insert);
		
	}

?>


<div class="container-fluid">
	<div class="row">
		<div class="contacts col-3">
			<h4 class="text-center heading-contacts mt-3 mb-4">Contacts</h4>
			<?php
				$select_counts_contacts = "SELECT COUNT(id) as count_contacts FROM messages WHERE rider_id = $id || passenger_id = $id";
				$run_counts_contacts	= mysqli_query($con,$select_counts_contacts);
				$row_counts_contacts 	= mysqli_fetch_array($run_counts_contacts);
				$count_contacted		= $row_counts_contacts["count_contacts"];
				
				if ($count_contacted < 1){
			?>

				<p class="text-center">No Contacts Found </p>

			<?php
				}else{
					// $select_contacts 	 = "SELECT DISTINCT rider_id,passenger_id FROM messages WHERE rider_id = '$id' OR passenger_id = '$id'" ;
					$select_contacts 	 = "SELECT * FROM (
						SELECT
							CASE WHEN rider_id <= passenger_id THEN rider_id ELSE passenger_id END AS rider_id,
							CASE WHEN rider_id <= passenger_id THEN passenger_id ELSE rider_id END AS passenger_id
						FROM
						messages
					) Ordered
					WHERE 
						rider_id = '$id' OR passenger_id = '$id'
					GROUP BY
						rider_id, passenger_id
					" ;
					$run_contacts	 	 = mysqli_query($con,$select_contacts);
					while ($row_contacts = mysqli_fetch_array($run_contacts)): 

						$rider_id_contacts 		= $row_contacts["rider_id"];
						$passenger_id_contacts	= $row_contacts["passenger_id"];

						if($rider_id_contacts != $id){
							$contacted_user_id = $rider_id_contacts;
						}
						elseif($passenger_id_contacts != $id){
							$contacted_user_id = $passenger_id_contacts;
						}

						$show_contacted 	= "SELECT user_name,user_img FROM users WHERE id = $contacted_user_id";
						$run_show_contacted	= mysqli_query($con,$show_contacted);
						$row_show_contacted = mysqli_fetch_array($run_show_contacted);

						$contacted_username = $row_show_contacted["user_name"];
						$contacted_userimg = $row_show_contacted["user_img"];
			?>
						<a href="account.php?show_message_id=<?php echo($contacted_user_id); ?>" class="contacts-link">
							<div class="contact <?php echo ($_GET['show_message_id'] == $contacted_user_id  ? 'contact-active' : ''); ?>">
								<img
								src="images/user/<?php echo($contacted_userimg); ?>"
								alt=""
								class="contact-img"
								/>

								<span class="d-none d-xl-inline"><?php echo($contacted_username); ?></span>
							</div>
						</a>
			<?php 
					endwhile;
				}
			?>

			
		</div>

		<!-- messaging section -->
		<div class="messaging col-9">

		<?php
			if (isset($_GET['show_message_id'])):
				$messaged_selected_contact = $_GET['show_message_id'];	
		?>
			<nav class="navbar navbar-light messaging-top">
				<div class="w-100">
						<?php 
							$message_top 			= "SELECT user_name,user_img FROM users WHERE id = $messaged_selected_contact";
							$run_message_top		= mysqli_query($con,$message_top);
							$row_message_top 		= mysqli_fetch_array($run_message_top);

							$message_top_username 	= $row_message_top["user_name"];
							$message_top_userimg 	= $row_message_top["user_img"]; 
						?>
						<img
							src="images/user/<?php echo($message_top_userimg); ?>"
							alt="" class="messaging-top-img"
						/>
						<span class="text-dark ml-3"><?php echo ($message_top_username); ?></span>
					</a>
			</nav>

			<div class="messaging-box">

			<?php
				$messages_box 	 		 = "SELECT sent_by,message FROM messages WHERE (rider_id = $id AND passenger_id = $messaged_selected_contact) OR (rider_id = $messaged_selected_contact AND passenger_id = $id)";
				$run_messages_box 	 	 = mysqli_query($con,$messages_box );
				while ($row_messages_box = mysqli_fetch_array($run_messages_box)): 

					$sent_by_message_box		= $row_messages_box["sent_by"];
					$message_message_box		= $row_messages_box["message"];

					if($sent_by_message_box == $messaged_selected_contact && !empty($message_message_box)):
			?>
						<div class="clearfix">
							<div class="reciever">
								<?php echo($message_message_box); ?>
							</div>
						</div>	

			<?php 	
					endif; 
					if($sent_by_message_box == $id && !empty($message_message_box)):
			?>
						<div class="clearfix">
							<div class="sender">
								<?php echo($message_message_box); ?>
							</div>
						</div>
			<?php
					endif; 	
			?>

			<?php endwhile; ?>
			</div>

			<form method="post" class="messenger-sender">
				<input type="text" class="form-control b-r-25" required name="messenger_sender_input" id="messenger-sender-input" />
				<button type="submit" name="messenger-sender-btn" class="btn btn-primary messenger-sender-btn">send</button>
			</form>
		
		<?php else: ?>

			<h6 class="text-center no-select-contact">Kindly select a contact to see the messaging section</h6>

		<?php endif; ?>
		</div>

	</div>

</div>