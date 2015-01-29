<?php
ob_start();
session_start();

if((!(isset($_SESSION['user'])))) {
  header('Location: index.php');
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Sun Rai</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href='http://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
    <link type="text/css" rel="stylesheet" href="style.css"/>
    <link rel="shortcut icon" href="http://www.iamsunrai.com/favicon.ico?v=2">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>

    <?php


      if((isset($_SESSION['user']))){
        echo "<script>window.onload = function() {

          var user = \"" . $_SESSION['user'] . "\";

          if(user == 'admin') {
            $('#signin').append('<a href=\"logout.php\"><h4>Log Out (Administrator)</h4></a>');

             $('#userdash').append('<a href=\"admindashboard.php\"><h4>Administrator Home</h4></a>');
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
        <img alt="brand" src="images/logo.png" width="120" height="120">
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">

        <li><a href="index.php"><h4>Home</h4></a></li>
        
        <li><a href="shows.php"><h4>Shows</h4></a></li>

        <li><a href="music.php"><h4>Music</h4></a></li>

        <li><a href="videos.php"><h4>Videos</h4></a></li>

        <li><a href="contact.php"><h4>Contact</h4></a></li>

      <ul class="nav navbar-nav pull-right">
        <li id="userdash"></li>
        <li id="signin"></li>
      </ul>



        <li class="dropdown hidden-lg hidden-md">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><h4>Social Media<span class="caret"></span></h4></a>
        <ul class="dropdown-menu" role="menu">
            <li><a href="https://www.facebook.com/iamsunrai"><h4>Facebook</h4></a></li>
            <li><a href="https://www.twitter.com/iamsunrai"><h4>Twitter</h4></a></li>
            <li><a href="https://www.youtube.com/iamsunrai"><h4>Youtube</h4></a></li>
            <li><a href="https://www.instagram.com/iamsunrai"><h4>Instagram</h4></a></li>
            <li><a href="https://play.spotify.com/artist/6UOV42aOSJ5YrbYzLIfLwr?play=true&utm_source=open.spotify.com&utm_medium=open"><h4>Spotify</h4></a></li>
            <li><a href="https://itunes.apple.com/us/artist/sun-rai/id659685994"><h4>iTunes</h4></a></li>
          </ul>
        </li>


        
      </ul>
      <!-- <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form> -->
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<!-- <script src="http://code.jquery.com/jquery.js"></script> -->
    <script src="js/bootstrap.min.js"></script>

    <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> -->
    <script src="jquery.backstretch.min.js"></script>
    
     <script> $.backstretch([
    "images/bg03.jpg",
    "images/bg05.jpg",
    "images/bg08.jpg",
    "images/bg04.jpg",
    "images/bg02.jpg",
    "images/bg01.jpg",
    "images/bg07.jpg",
    "images/bg06.jpg",  
  ], {duration: 4000}); </script>

     <div class="container">
        <br><br><br><br><br>
     </div>

    <div class="fontcolor">
    <!-- <div class="jumbotron"> -->

    <div class="row">

        <div class="col-md-1">
        </div>

        <div class="container jumbotron col-md-3">
            <h1>Admin Panel</h1>
            <br>

            <div id="centerform">

              <br>
                <a class="btn btn-xlarge btn-primary" href="adminshows.php" role="button">Edit Shows</a><br>
                <br><br>
                <a class="btn btn-xlarge btn-primary" href="adminvideos.php" role="button">Edit Videos</a><br>

              </div>
  </div>

        <div class="container jumbotron col-md-6">
          <h1>Add Shows:</h1>
          <br>

          <div id="centerform">


          <form name="addshows" action="adminshows.php" method="POST">
            <fieldset>
                  <label for="date"><h4>Date:</h4>
                  <input class="datepicker input-box" name="date" type="text"></label>

                  <script>

                  $('.datepicker').datepicker();

                  </script>
        
                  <label for="Location"><h4>Location:</h4>
                  <input id="location" class="input-box" name="location" type="text"></label>

                  <label for="Venue"><h4>Venue:</h4>
                  <input id="venue" class="input-box" name="venue" type="text"></label>

                  <input type="submit" id="submit" class="btn btn-lg btn-primary" role="button" name="addshow" value="Add Show">

            </fieldset>
          </form>
            <?php
                ini_set('display_errors', 'On');
                include 'storeddata.php';
                error_reporting(E_ALL);

            if(isset($_REQUEST['addshow'])) {

              $mysqli = new mysqli("$host", "$db", "$pass", "$db");

            if(!$mysqli || $mysqli->connect_errno){
              echo "<h3>There is a problem. Please email djklu31@gmail.com.</h3>";
            }

            if(!($stmt = $mysqli->prepare("INSERT INTO sunraishows(date1, location, venue) VALUES (?,?,?)"))){
              echo "<h3>Enter all fields</h3>";
            }

            if(!($stmt->bind_param("sss", $_POST['date'], $_POST['location'], $_POST['venue']))){
              echo "<h3>Please enter in all fields.</h3>";
            }

            if(!$stmt->execute()){
              
                echo "Execute failed. Email djklu31@gmail.com";
              
            } else {

              $stmt->close();

              header('Location: adminshows.php');
            }

          }
        ?>


          </div>

          <div id="editshows">

          <h1>Edit Existing Shows:</h1>
          <br>

          <?php
          ini_set('display_errors', 'On');
          error_reporting(E_ALL);
          include 'storeddata.php';

          $mysqli = new mysqli("$host", "$db", "$pass", "$db");

            if(!$mysqli || $mysqli->connect_errno){
              echo "<h3>There is a problem. Please email djklu31@gmail.com.</h3>";
            }

          if(!($stmt = $mysqli->prepare("SELECT s.date1, s.location, s.venue, s.id FROM sunraishows s
            ORDER BY s.date1 ASC"))){
            echo "The username has already been taken.";
          }


          if(!$stmt->execute()){
            echo "The username has already been taken.";
          } 

          $stmt->store_result();

          $checkshows = $stmt->num_rows;

          if(!$stmt->bind_result($date, $location, $venue, $aid)){
            echo "Bind failed: "; 
          }

          if($checkshows == 0){
            echo "<h2>--No Shows Yet--</h2>";
          }

          while($stmt->fetch()){
            echo "

                      <h3>Date: $date Location: $location Venue: $venue <input type=\"submit\" class=\"btn btn-lg btn-danger\" id=\"delete$aid\" role=\"button\" value=\"Delete\"></h3>

                    

                     <script>

                      $('#delete$aid').on('click', function() {

                        $.ajax({
                          url: \"delete.php\",
                          type: 'post',
                          data: {aid: $aid},
                          
                          success: function(data) {
                            console.log(\"delete\");
                            document.location.reload(true);
                          }
                          
                        });
                
                      });

                    </script>
              <br>

              ";

          }


          $stmt->close();
          ?>



          </div>

        </div>

        <div class="container centericons col-md-2 hidden-xs hidden-sm">
            <a href="https://www.facebook.com/iamsunrai"><img alt="Facebook" src="images/facebookicon.png" width="120" height="120"></a><br>
            <a href="https://www.twitter.com/iamsunrai"><img alt="Twitter" src="images/twittericon.png" width="120" height="120"></a><br>
            <a href="https://www.youtube.com/user/iamsunrai"><img alt="Youtube" src="images/youtubeicon.png" width="120" height="120"></a><br>
            <a href="http://www.instagram.com/iamsunrai"><img alt="Instagram" src="images/instagramicon.png" width="120" height="120"><br>
            <a href="https://play.spotify.com/artist/6UOV42aOSJ5YrbYzLIfLwr?play=true&utm_source=open.spotify.com&utm_medium=open"><img alt="Spotify" src="images/spotifyicon.png" width="120" height="120"></a><br>
            <a href="https://itunes.apple.com/us/artist/sun-rai/id659685994"><img alt="iTunes" src="images/itunesicon.png" width="120" height="120"></a>
        </div>

      </div>
    </div>


        

  </body>
</html>

