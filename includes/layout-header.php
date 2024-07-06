<?php session_start(); ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./assets/bootstrap/css/bootstrap.min.css" />
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./assets/styles.css" />
    <style>


    </style>
    <title>Bantayan Online Bus Reservation</title>


  </head>
  <body class="bg-light">

  <!-- Just an image -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="index.php" style="font-family: 'Times New Roman', serif;">
      <img src="assets/images/bobrs3.png" style="width: 350px; height: 60px;" alt=""><b>

    </a></b>
    
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <?php
        if(isset($_SESSION["userId"]) && !empty($_SESSION["userId"])){
            ?>
            <li class="nav-item">
                <a class="nav-link" href="account.php"><i class="fa fa-user icon w3-large color:black "><b>  <?php echo $_SESSION["userFname"]?></b></a></i>
              </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php"><i class="fa fa-search"><b> Find Schedule</b></a></i>
              </li>
              
              <li class="nav-item">
                <a class="nav-link" href="logout.php"><i class="fa fa-sign-out icon w3-large "><b> Logout</b></a></i>
              </li>
            <?php
        }else{
            ?>
              <li class="nav-item">
              <a class="nav-link" href="index.php"> <i class="fa fa-home w3-large "> <b>Home</a></b></i>
              </li>
              <li class="nav-item">
              <a class="nav-link" href="register.php"> <i class="fa fa-user icon w3-large "> <b>User</a></b></i>
              </li> 
              <li class="nav-item">
                <a class="nav-link" href="./admin/index.php"> <i class="fa fa-user icon w3-large "><b> Admin</a></b></i>
              </li>
            <?php
        }
      ?>
    </ul>
  </div>
  </div>
</nav>