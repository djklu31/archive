<?php
ob_start();
session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>WYNN Salon and Spa</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link type="text/css" rel="stylesheet" href="style.css"/>
		<link href='http://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
    <?php

      if(!(isset($_SESSION['user']))){
        echo "<script>window.onload = function() {
        $('#signin').append('<a href=\"login.php\"><h4>Log In</h4></a>');
      };</script>";

      }
      else {
        echo "<script>window.onload = function() {

          var user = \"" . $_SESSION['user'] . "\";

          if(user == 'admin') {
            $('#signin').append('<a href=\"logout.php\"><h4>Log Out (Administrator)</h4></a>');

             $('#userdash').append('<a href=\"admindashboard.php\"><h4>Administrator Home</h4></a>');
          }
          else {
        $('#signin').append('<a href=\"logout.php\"><h4>Log Out (" . $_SESSION['user'] . ")</h4></a>');

        $('#userdash').append('<a href=\"userdashboard.php\"><h4>User Home</h4></a>');
      }
      
      };</script>";
      }
    ?>
	</head>
	<body>

<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">
      	<img alt="brand" src="logo.png">
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="index.php"><h4>Home</h4><span class="sr-only">(current)</span></a></li>
        <li><a href="aboutus.php"><h4>Rates</h4></a></li>
        <li><a href="stylists.php"><h4>Stylists</h4></a></li>
        <li><a href="specialoffers.php"><h4>Special Offers</h4></a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><h4>Social Media<span class="caret"></span></h4></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="http://www.yelp.com/biz/modern-salon-pacifica"><h5>Yelp</h5></a></li>
            <li><a href="https://www.facebook.com/ModernSalon"><h5>Facebook</h5></a></li>
            <li><a href="http://instagram.com/modernsalon"><h5>Instagram</h5></a></li>
          </ul>
         <li><a href="contact.php"><h4>Contact</h4></a></li>
         <li class="active"><a href="bookappt.php"><h4>Book Appointment</h4></a></li>
        </li>
      </ul>      <!-- <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form> -->
      <ul class="nav navbar-nav navbar-right">
        <li id="userdash"></li>
        <li id="signin"></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>



		<script src="http://code.jquery.com/jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> <script src="jquery.backstretch.min.js"></script>
		 <script> $.backstretch("stylingroom.jpg"); </script>

    <div class="container">
    <br><br><br><br><br><br>
  </div>

     <div class="container">
    <div class="jumbotron specialoffercontainer">
        <br>
        <h1>Special Offer</h1>
        <h3>For a limited time, we are offering 20% for valid coupons.</h3>
        <h3>Just tell them Kenny sent you when you checkout after your service.</h3>

        

    </div>
  </div>

	</body>
</html>