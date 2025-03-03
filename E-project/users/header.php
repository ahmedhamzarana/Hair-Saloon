<?php

include('config.php');
session_start();


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>HairCut - Hair Salon HTML Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Oswald:wght@600&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-secondary navbar-dark sticky-top py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
        <a href="index.html" class="navbar-brand ms-4 ms-lg-0">
            <h1 class="mb-0 text-primary text-uppercase"><i class="fa fa-cut me-3"></i>HairCut</h1>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="index.php" class="nav-item nav-link active">Home</a>
                <a href="about.html" class="nav-item nav-link">About</a>
                <a href="service.html" class="nav-item nav-link">Service</a>
                <a href="contact.php" class="nav-item nav-link">Contact Us</a>
                <div class="nav-item dropdown">
                   
                </div>
                <?php if (!isset($_SESSION['i'])) {


                ?>
                    <a href="signin.php" class="nav-item nav-link">Login</a>
                    <a href="signup.php" class="nav-item nav-link">Signup</a>
                <?php
                } else {
                ?>
                    <a href="" class="nav-item nav-link"><?php echo $_SESSION['n'] ?></a>
                    <a href="logout.php" class="nav-item nav-link">Logout</a>
                <?php
                }
                ?>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->