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

        var date = new Date();
    console.log(date.getDay());
    console.log(date.getHours());

    var dayofweek = date.getDay();
    var time = date.getHours();

    if ((dayofweek>=1 && dayofweek<=7) && (time>=10 && time<=21)) {
      document.getElementById('status').innerHTML = '<p>Open</p>';
    }
    
    else {
      document.getElementById('status').innerHTML = '<p>Closed</p>';
    }

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
        var date = new Date();
    console.log(date.getDay());
    console.log(date.getHours());

    var dayofweek = date.getDay();
    var time = date.getHours();

    if ((dayofweek>=1 && dayofweek<=7) && (time>=10 && time<=21)) {
      document.getElementById('status').innerHTML = '<p>Open</p>';
    }
    
    else {
      document.getElementById('status').innerHTML = '<p>Closed</p>';
    }

      };</script>";
      }
    ?>

    <!--<script>
    window.onload = function() {
    var date = new Date();
    console.log(date.getDay());
    console.log(date.getHours());

    var dayofweek = date.getDay();
    var time = date.getHours();

    if ((dayofweek>=1 && dayofweek<=7) && (time>=10 && time<=21)) {
      document.getElementById('status').innerHTML = '<p>Open</p>';
    }
    
    else {
      document.getElementById('status').innerHTML = '<p>Closed</p>';
    }

    }

    </script>-->

      <style>
      #map-canvas {
        width: 500px;
        height: 400px;
      }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <script>
      function initialize() {
        var mapCanvas = document.getElementById('map-canvas');
        var mapOptions = {
          center: new google.maps.LatLng(47.552, -122.277),
          zoom: 16,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var map = new google.maps.Map(mapCanvas, mapOptions)
        var myLatlng = new google.maps.LatLng(47.552,-122.277);
        var marker = new google.maps.Marker({
         position: myLatlng,
          map: map,
  title:"Former About.com Headquarters"
});
      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>

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
      </ul>
      <!-- <form class="navbar-form navbar-left" role="search">
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
		 <script> $.backstretch("contact.jpg"); </script>

     <div class="container">
    <br><br>
  </div>

     <div class="container contactcontainer">
    <div class="jumbotron">

        <h2>Hours:</h2>
        <p>Monday through Saturday, 10am to 9pm</p>
        <h3>Status:</h3>
        <div id="status"></div>

        <h2>Location:</h2>
        <p>5520 Rainier Ave S. Seattle WA 98118</p>

        <h2>Email:</h2>
        <p>djklu31@gmail.com</p><br>

        <h2>Google Maps:</h2>
        <!-- <div class="map-canvas" id="map-canvas"></div>
    </div>
  </div> -->

  <div data-role="content" class="map_content" data-theme="a">
            <div class="map_content">
                <div class="map_canvas" id="map-canvas"></div>
            </div>
        </div>

	</body>
</html>