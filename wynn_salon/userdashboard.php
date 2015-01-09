<?php
ob_start();
session_start();

if(!(isset($_SESSION['user']))){
  header('Location: index.php');
}


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
     <script> $.backstretch([
    "home.jpg",
    "dim.jpg",
    "stylingroom.jpg"    
  ], {duration: 30000}); </script>

  <div class="container">
        <br><br><br><br><br>
     </div>

     <div class="container">
    <div class="jumbotron stylisttitle">
        <?php
          echo "<h1>Welcome " . $_SESSION['clientname'] . "!</h1>";
        ?>
    </div>
  </div>


     <div class="container">
    <div class="jumbotron stylistcontainer">
        <h2>Scheduled Appointments:</h2>
        <?php

ini_set('display_errors', 'On');
include 'storeddata.php';


$count = 1;

$mysqli = new mysqli("$host", "$db", "$pass", "$db");
if(!$mysqli || $mysqli->connect_errno){
  echo "There is a problem. Please email djklu31@gmail.com";
}

  $username = $mysqli->real_escape_string($_SESSION['user']);

if(!($stmt = $mysqli->prepare("SELECT a.date1, a.time, a.type, s.name, c.email, c.phone_number, a.comments, a.id FROM clients c
  INNER JOIN appointments a ON c.id = a.cid INNER JOIN
  stylists s ON a.sid = s.id
  WHERE c.username = ?"))){
  echo "The username has already been taken.";
}


if(!($stmt->bind_param("s", $username))){
  echo "Please enter in all fields.";
}

if(!$stmt->execute()){
  echo "The username has already been taken.";
} 

$stmt->store_result();

$checkuser = $stmt->num_rows;

if(!$stmt->bind_result($date, $time, $type, $sname, $email, $phonenumber, $comments, $aid)){
  echo "Bind failed: "; 
}

if($checkuser == 0){
  echo "<h2>--none--</h2>";
}

while($stmt->fetch()){
  echo "<h3>Appointment $count</h3>
    
        <div id \"appointments\" class=\"row\">
        <div class=\"col-md-8\" id=\"dashboard\">
            <h3>Date: $date</h3>
            <h3>Time: $time</h3>
            <h3>Type: $type</h3>
            <h3>Stylist: $sname</h3>
            <h3>Email: $email</h3>
            <h3>Phone Number: $phonenumber</h3>
            <h3>Comments: <div id=\"wrap\">$comments</div></h3>
        </div>
        <div class=\"col-md-4 pcenter\">
            <br><br><br><br><br>
            

            <p class=\"pcenter\"><input type=\"submit\" class=\"btn btn-lg btn-danger\" id=\"delete$aid\" role=\"button\" value=\"Delete\"></p>



            <script>

            $('#delete$aid').on('click', function() {

              $.ajax({
                url: \"delete.php\",
                type: 'post',
                dataType: 'json',
                data: {aid: $aid},
                
                success: function(data) {
                  document.location.reload(true);
                }
                
              });

                  document.location.reload(true);
                  document.location.reload(true);
      
            });

            </script>

        </div>
    </div>
    <br>

    ";

    $count++;
}


$stmt->close();
?>

    </div>
  </div>


  </body>
</html>



