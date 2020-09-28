<?php
    include('includes/DBconn.php'); 
    include('includes/header.php');

    if (!isset($_SESSION["user_email"])) {
        echo "<script>window.open('login.php','_self');</script>";
        exit;	
	}
?>

<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-4 col-xl-3"><!-- Profile Start -->
            <?php 
                include("includes/sidebar.php") 
            ?>
        </div><!-- Profile Finish -->

        <div class="col-12 col-sm-12 col-md-8 col-xl-9 mt-5 mt-md-0">
            <?php 

                if ( isset($_GET["rides"]) ){ 
                    include("rides.php");
                }
                elseif ( isset($_GET["account"]) ){ 
                        
                    include("edit_account.php"); 
                }
                elseif ( isset($_GET["password"]) ){ 
                    include("change_pass.php"); 
                }
                elseif ( isset($_GET["delete"]) ){ 
                    include("delete_account.php");
                }
                else{ 
                    include("message.php");
                }

            ?>
        </div>
    </div> 
</div>

<?php
    include('includes/footer.php'); 
?>
