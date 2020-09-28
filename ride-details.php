<?php
    include('includes/DBconn.php'); 
    include('includes/header.php'); 
    if (!isset($_SESSION["user_email"])) {
      echo "<script>window.open('login.php','_self');</script>";	
    }

    if (isset($_POST["completed_ride"]) && isset($_GET["ride_id"]) && isset($_GET["rider_id"])) {
     
        $ride_id_completed                    = $_GET["ride_id"];
        $rider_id_completed                   = $_GET["rider_id"];

        $completed_ride     = "UPDATE matched_rides SET completed = 1 WHERE ride_id = '$ride_id_completed' AND rider_id = '$rider_id_completed' AND passenger_id='$id'";

        $run_completed      = mysqli_query($con,$completed_ride);

        if($run_completed){
            echo "<script>alert('Rides successfully updated to being completed')</script>";
        }else{
            echo "<script>alert('Rides updation failed, please contact administration')</script>";
        }
        
    }

    if(isset($_GET["ride_id"]) && isset($_GET["rider_id"]) && isset($_GET["save_ride"]) && $_GET["save_ride"] == 1 ){
        $ride_id                    = $_GET["ride_id"];
        $rider_id                   = $_GET["rider_id"];

        $check_ride_insert          = "SELECT COUNT(id) as checkInsetId,completed FROM matched_rides WHERE ride_id = '$ride_id' AND rider_id = '$rider_id' AND passenger_id='$id'";

        $run_check_ride_insert      = mysqli_query($con,$check_ride_insert);

        $row_check_ride_insert      = mysqli_fetch_array($run_check_ride_insert);

        $check_ride_count           = $row_check_ride_insert["checkInsetId"];

        if ($check_ride_count < 1) {
        
            $matched_ride_insert    = "INSERT INTO matched_rides (ride_id,rider_id,passenger_id) VALUES ('$ride_id','$rider_id','$id');";

            mysqli_query($con,$matched_ride_insert);
        }

    }

    if(isset($_GET["ride_id"]) && isset($_GET["rider_id"])){
        $ride_id_details            = $_GET["ride_id"];
        $rider_id_details           = $_GET["rider_id"];

        $matched_rider              = "SELECT user_name,user_contact,user_img FROM users WHERE id = '$rider_id_details'";

        $run_matched_rider          = mysqli_query($con,$matched_rider);

        $row_matched_rider          = mysqli_fetch_array($run_matched_rider);

        $matched_rider_name         = $row_matched_rider["user_name"];
        $matched_rider_contact      = $row_matched_rider["user_contact"];
        $matched_rider_img          = $row_matched_rider["user_img"];

        $match_ride                 = "SELECT * FROM rides WHERE id = '$ride_id_details'";

        $run_match_ride             = mysqli_query($con,$match_ride);

        $row_match_ride             = mysqli_fetch_array($run_match_ride);

        $start_match_ride           = $row_match_ride["start"];
        $destination_match_ride     = $row_match_ride["destination"];
        $date_ride_match_ride       = $row_match_ride["date_ride"];
        $time_ride_match_ride       = $row_match_ride["time_ride"];
        $seats_match_ride           = $row_match_ride["seats"];

        $completed_check_ride_select       = "SELECT completed FROM matched_rides WHERE ride_id = '$ride_id_details' AND rider_id = '$rider_id_details'";

        $run_check_ride             = mysqli_query($con,$completed_check_ride_select);

        $row_check_ride             = mysqli_fetch_array($run_check_ride);

        $completed_check_ride       = $row_check_ride["completed"];

    }
    


?>

<div class="container mt-5">
    <div class="row">    
        <div class="offset-sm-0 col-sm-12 col-md-5">
            <div class="text-center">
                <h2 class="mb-4">Rider's Info</h2>
                <img src="images/user/<?php echo($matched_rider_img); ?>" alt="" class="details-img rounded-circle">
            </div>
            <?php if ($_GET["rider_id"] == $id): ?>
                <button  class="btn btn-primary btn-block btn-lg mb-3 mt-4">It's You !</button>
            <?php else: ?>
                <a href="account.php?show_message_id=<?php echo($_GET["rider_id"]); ?>&first_message=1" class="btn btn-primary btn-block btn-lg mb-3 mt-4">Message</a>
            <?php endif; ?>
            <div class="clearfix">
                <span class="details-rider-info float-left ml-4 ml-md-1 ml-lg-4"><i class="fas fa-user text-primary pr-3"></i><?php echo($matched_rider_name); ?></span>
                <span class="details-rider-info float-right mr-4 mr-md-1 mr-lg-4"><i class="fas fa-phone-alt text-primary pr-3"></i><?php echo($matched_rider_contact); ?></span>
            </div>
        </div>
            
        <div class="offset-sm-0 col-sm-12 offset-md-1 col-md-6 mt-5 mt-md-0">
            <h2 class="mb-4 text-center">Ride's Info</h2>
            <div class="d-block mb-4 border-bottom">
                <h4 class="ride-info--headline d-inline text-left">Leaving from: </h4>
                <p class="ride-info--para d-inline"> <?php echo($start_match_ride); ?></p>
            </div>
            <div class="d-block mb-4 border-bottom">
                <h4 class="ride-info--headline d-inline text-left">Going to : </h4>
                <p class="ride-info--para d-inline"> <?php echo($destination_match_ride); ?></p>
            </div>
            <div class="d-block mb-4 border-bottom">
                <h4 class="ride-info--headline d-inline text-left">Time of departure: </h4>
                <p class="ride-info--para d-inline ml-5"> <?php echo($time_ride_match_ride); ?></p>
            </div>
            <div class="d-block mb-4 border-bottom">
                <h4 class="ride-info--headline d-inline text-left">Date of departure: </h4>
                <p class="ride-info--para d-inline ml-5"> <?php echo($date_ride_match_ride); ?></p>
            </div>
            <div class="d-block mb-4 border-bottom">
                <h4 class="ride-info--headline d-inline text-left">Seats Available: </h4>
                <p class="ride-info--para d-inline ml-5 pl-5"> <?php echo($seats_match_ride); ?></p>
            </div>
        </div>

        <div class="w-100"></div>

            <div class="col-12 mt-5">
                <?php if(empty($completed_check_ride)): ?>
                    <form method="post">
                        <input type="submit" class="btn btn-outline-primary btn-lg btn-block" name="completed_ride" value="Click Here to Complete The Ride">
                    </form>
                <?php else: ?>
                    <button class="btn btn-primary btn-lg btn-block">Ride Completed</button>
                <?php endif; ?>
            </div>

        <div class="w-100"></div>

        <div class="col-12 details-map">
            <h2 class="mb-4 text-center">Map Route</h2>
            <input type="hidden" id="start-map" name="start_map" value="<?php echo($start_match_ride); ?>">
            <input type="hidden" id="destination-map" name="destination_map" value="<?php echo($destination_match_ride); ?>">
            <div id="map"></div>
        </div>
        
    </div>
</div>


<!-- maps links below two -->
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<!-- <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTbYZF_kDxKNopcvej6oh-eVs1z9Xq2J0&callback=initMap&libraries=places&v=weekly"
    defer
></script> -->
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTbYZF_kDxKNopcvej6oh-eVs1z9Xq2J0&callback=initMap&libraries=&v=weekly"
    defer
></script>

<script>
      "use strict";

      function initMap() {
        const directionsService = new google.maps.DirectionsService();
        const directionsRenderer = new google.maps.DirectionsRenderer();
        const map = new google.maps.Map(document.getElementById("map"));
        directionsRenderer.setMap(map);
        DisplayRoute(directionsService, directionsRenderer);
      }

      function DisplayRoute(directionsService, directionsRenderer) {

        directionsService.route(
          {
            origin: document.getElementById("start-map").value,
            destination: document.getElementById("destination-map").value,
            travelMode: google.maps.TravelMode.DRIVING
          },
          (response, status) => {
            if (status === "OK") {
              directionsRenderer.setDirections(response);
            } else {
              window.alert("Directions request failed due to " + status);
            }
          }
        );
      }
</script>
<?php
    include('includes/footer.php'); 
?>
