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

    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>

    <?php

      if(!(isset($_SESSION['user']))){
        echo "<script>window.onload = function() {
        $('#signin').append('<a href=\"login.php\"><h4>Log In</h4></a>');
      };</script>";

      }
      else{
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


    <!--<script src="http://code.jquery.com/jquery.js"></script>-->
    <script src="js/bootstrap.min.js"></script>

    <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> -->
    <script src="jquery.backstretch.min.js"></script>
     <script> $.backstretch([
    "home.jpg",
    "dim.jpg",
    "stylingroom.jpg"    
  ], {duration: 30000}); </script>

    <div class="container">
    <div class="jumbotron rates">
        <div id="createaccount">
            <br><br><br><br><br>
            <h1>Schedule An Appointment</h1>

            <form name="create" action="specialbook.php" class="pcenter" method="POST">
              <fieldset>

                  <label for="type"><h3>Type:</h3></label>
                  <input name="type" type="text">
                  <br>
                  <h3><label for="stylist"><h3>Desired Stylist:</h3></label>
                  <select name="stylist"> 
                    <option value="1">Joseph</option>
                    <option value="2">Liz</option>
                    <option value="3">Micaela</option>
                  </select></h3>
                  <br>


                  <label for="date"><h3>Date:</h3></label>
                  <input class="datepicker" name="date" type="text">

                  <script>

                  $('.datepicker').datepicker();

                  </script>


                  <br>

                  <h3><label for="time"><h3>Time:</h3></label>
                  <select name="time"> 
                    <option value="10:30am-11:30am">10:30am-11:30am</option>
                    <option value="11:30am-12:30am">11:30am-12:30am</option>
                    <option value="12:30pm-1:30pm">12:30pm-1:30pm</option>
                    <option value="1:30pm-2:30pm">1:30pm-2:30pm</option>
                    <option value="2:30pm-3:30pm">2:30pm-3:30pm</option>
                    <option value="3:30pm-4:30pm">3:30pm-4:30pm</option>
                    <option value="4:30pm-5:30pm">4:30pm-5:30pm</option>
                    <option value="5:30pm-6:30pm">5:30pm-6:30pm</option>
                    <option value="6:30pm-7:30pm">6:30pm-7:30pm</option>
                    <option value="7:30pm-8:30pm">7:30pm-8:30pm</option>

                  </select></h3>

                  <br>

                  <label for="comments"><h3>Special Requests (Enter up to 255 characters):</h3></label>
                  <br>

                  <div class="pcenter">
                  <h3><textarea  name="comments" cols="25" rows="5" placeholder="Enter up to 255 characters..."></textarea></h3>
                  </div>
            
                    <div class="pcenter">
                    <input type="submit" class="btn btn-lg btn-primary" role="button" name="submitappointment" value="Create Appointment">
                    </div>

                    <?php
                ini_set('display_errors', 'On');
                include 'storeddata.php';

                if(isset($_REQUEST['submitappointment'])) {

                  $mysqli = new mysqli("$host", "$db", "$pass", "$db");
if(!$mysqli || $mysqli->connect_errno){
  echo "<h3>There is a problem with the booker connection. Please email djklu31@gmail.com</h3>";
}

if(!($stmt = $mysqli->prepare("INSERT INTO appointments(name, type, sid, date1, time, comments, cid) VALUES (?,?,?,?,?,?,?)"))){
  echo "<h3>Enter all fields please</h3>";
}

if(!($stmt->bind_param("sssssss", $_SESSION['clientname'], $_POST['type'], $_POST['stylist'], $_POST['date'], $_POST['time'], $_POST['comments'], $_SESSION['cid']))){
  echo "<h3>Please enter in all fields.</h3>";
}

if(!$stmt->execute()){
  echo "<h3>That date and time has been filled. Please choose another.</h3>";
} else {

  $stmt->close();

  echo "<h3>Appointment successfully added.</h3>";

  header('Location: userdashboard.php');

}

                }
              ?>
                    <br>

                </fieldset>
              </form>
            </div>
          </div>
        </div>


  </body
</html>