<?php
    // defining dev_mode that will specifiy if we are in developmental mode or not
    define('DEV_MODE', true);
    // the below variable will solve the cache js and css problem in developmental mode
    $ver = DEV_MODE ? time() : '1.0';

    if (isset($_SESSION["user_email"])) {
        $session_user_email = $_SESSION["user_email"];
        $user_select    = "SELECT * FROM users WHERE user_email = '$session_user_email'";
        $run_user       = mysqli_query($con,$user_select);
        $row_user       = mysqli_fetch_array($run_user);
        $id             = $row_user["id"];
        $name           = $row_user["user_name"];
        $email          = $row_user["user_email"];
        $password       = $row_user["user_password"];
        $contact        = $row_user["user_contact"];
        $img            = $row_user["user_img"];
    } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/logo/ico.png" type="image/ico">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/fontawesome/css/all.min.css">
    <link href='//fonts.googleapis.com/css?family=Montserrat:,extra-light,light,100,200,300,400,500,600,700,800' 
rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="./css/bundle.css?ver=<?php echo ($ver); ?>">
    <title>SafeRide Share</title>
</head>
<body>

    <header>
        <div class="nav-container">
            <nav class="navbar navbar-expand-lg navbar-info bg-light">
                <div class="container">
                    <a class="navbar-brand" href="index.php">
                    <img src="images/logo/logo.png" alt="logo" class="logo" loading="lazy" width="50" height="auto">
                    <span class="logo-txt h4 text-dark">SafeRide Share</span>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars "></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto text-info">
                            <li class="nav-item">
                                <a class="nav-link" href="findride.php"><i class="fas fa-search"></i>   Find a ride </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="offerride.php"><i class="fas fa-plus"></i>  Offer a ride</a>
                            </li>
                            <?php if (isset($_SESSION["user_email"])): ?>
                            <li class="nav-item ">
                                <a class="nav-link" href="account.php" tabindex="-1" aria-disabled="false"><i class="fas fa-user-circle"></i> Account</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="logout.php" tabindex="-1" aria-disabled="false"></i><i class="fas fa-sign-out-alt"></i> Log Out</a>
                            </li>
                            <?php endif; ?>
                            <?php if (!isset($_SESSION["user_email"])): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="signup.php" tabindex="-1" aria-disabled="false"><i class="fas fa-user-plus"></i>  Sign up</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="login.php" tabindex="-1" aria-disabled="false"><i class="fas fa-sign-in-alt"></i>  Log in</a>
                            </li>
                            <?php endif; ?>
                            <?php if (isset($_SESSION["user_email"])): ?>
                            <li class="nav-item">
                                <a href="account.php" class="nav-link">
                                    <img src="images/user/<?php echo($img); ?>" alt="" class="rounded-circle-img-header">
                                </a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>


