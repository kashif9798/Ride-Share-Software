<?php
    include('includes/DBconn.php'); 
    include('includes/header.php'); 
    if (!isset($_SESSION["user_email"])) {
      echo "<script>window.open('login.php','_self');</script>";	
    }
    if(isset($_GET["start"]) && isset($_GET["destination"]) && isset($_GET["date"])){
        $passenger_leaving  = $_GET["start"];
        $passenger_going    = $_GET["destination"];
        $passenger_date     = $_GET["date"];

        $search_ride = "SELECT * FROM rides WHERE start LIKE '%$passenger_leaving%' AND destination LIKE '%$passenger_going%' AND date_ride LIKE '%$passenger_date%'";

        $run_search = mysqli_query($con,$search_ride);

        // query for ride found or not
        $search_ride_found = "SELECT COUNT(id) as rides_found FROM rides WHERE start LIKE '%$passenger_leaving%' AND destination LIKE '%$passenger_going%' AND date_ride LIKE '%$passenger_date%'";

        $run_search_found = mysqli_query($con,$search_ride_found);

        $row_rides_found = mysqli_fetch_array($run_search_found);

        $rides_found_search = $row_rides_found["rides_found"];

    }

?>


<div class="container mt-5">
    <?php if ($rides_found_search < 1):?>
        <div class="text-center">
            <img src="images/search/not-found.png" alt="Not Found" class="img-fluid mt-5">
            <h3 class="text-muted mt-5">No Rides Found</h3>
            <a href="findride.php" class="btn btn-outline-primary btn-sm">Try searching again with a different date or place</a>
        </div>

    <?php else:?>

    <div class="table-responsive">
        <table class="table table-borderless">
            
    <?php
        $i = 0;
        while($row_search = mysqli_fetch_array($run_search)){

            $id_ride        = $row_search ["id"];
            $rider_id       = $row_search ["rider_id"];
            $start          = $row_search ["start"];
            $destination    = $row_search ["destination"];
            $date_ride      = $row_search ["date_ride"];
            $time_ride      = $row_search ["time_ride"];
            $seats          = $row_search ["seats"];

            $rider_select           = "SELECT user_name,user_img FROM users WHERE id = '$rider_id'";
            $run_rider_select       = mysqli_query($con,$rider_select);
            $row_rider_select       = mysqli_fetch_array($run_rider_select);
            $name_rider_select      = $row_rider_select["user_name"];
            $img_rider_select       = $row_rider_select["user_img"];
            $i++;
    ?>
               
                <tbody class="border-bottom">
                    <tr>
                        <td colspan="4" class="text-center">
                            <img src="images/user/<?php echo($img_rider_select); ?>" alt="" class="search-rider-img <?php echo($i!== 1 ? 'mt-search-ride' : '') ?> rounded-circle">
                            <span class="rider-name-search">
                                Rider Name: <b><?php echo($name_rider_select); ?></b>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Leaving from</th>
                        <th>Going to</th>
                        <th>Time & Date</th>
                        <th>Seats Available</th>
                    </tr>
                    <tr>
                        <td><?php echo ($start); ?></td>
                        <td><?php echo ($destination); ?></td>
                        <td class="text-center"><?php echo ($time_ride); ?> <?php echo ($date_ride); ?></td>
                        <td class="text-center"><?php echo ($seats); ?></td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <a href="ride-details.php?ride_id=<?php echo ($id_ride); ?>&rider_id=<?php echo ($rider_id); ?>&save_ride=1" class="btn btn-lg btn-block btn-primary">
                                Confirm ride with <?php echo($name_rider_select); ?>
                            </a>
                        </td>
                    </tr>
                </tbody>
    <?php
        }
    ?>
            
        </table>
    </div>
    <?php endif;?>
</div>
<?php
    include('includes/footer.php'); 
?>
