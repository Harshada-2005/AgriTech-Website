<?php
session_start();
if (!isset($_SESSION["farmer_id"])) {
    header("Location: login.php");
}
$currentURL =  $_SERVER['REQUEST_URI'];
$lastPart = basename($currentURL);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Agri Tech </title>
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Fontawesome CSS -->
    <link href="css/all.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-light top-nav fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="images/logo.jpeg" alt="logo" height="80px" width="250px" />
            </a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="fas fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item mx-1">
                        <a class="nav-link <?= $lastPart == 'index.php' ? 'active' : '' ?>" href="index.php">Home</a>
                    </li>
                    <li class="nav-item mx-1">


                    </li>
                    <li class="nav-item mx-1">
                        <a class="nav-link  <?= $lastPart == 'about.php' ? 'active' : '' ?>" href="about.php">About</a>
                    </li>
                    <li class="nav-item mx-1">
                        <a class="nav-link  <?= $lastPart == 'services.php' ? 'active' : '' ?>" href="services.php">Services</a>
                    </li>



                    <li class="nav-item mx-1">
                        <a class="nav-link  <?= $lastPart == 'contact.php' ? 'active' : '' ?>" href="contact.php">Contact</a>
                    </li>
                    <li class="nav-item mx-1">
                        <a class="nav-link  <?= $lastPart == 'forwroker.php' ? 'active' : '' ?>" href="forwroker.php">For
                            Worker</a>
                    </li>
                    <li class="nav-item mx-1">
                        <a class="nav-link <?= $lastPart == 'updateprofile.php' ? 'active' : '' ?>" href="updateprofile.php"> <i class="
                            fas fa-user"></i>
                            <?= $_SESSION["farmer_fullname"] ?>
                        </a>
                    </li>
                    <li class="nav-item mx-1">
                        <a class="nav-link <?= $lastPart == 'logout.php' ? 'active' : '' ?>" href="logout.php">
                            <i class="fas fa-sign-out-alt "></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Content -->