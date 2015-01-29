<?php
ob_start();
session_start();
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

<script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> <script src="jquery.backstretch.min.js"></script>
    
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
            <h1>Contact</h1>
            <br>
            <h3>Booking Inquiries:</h3>
            <div class="mail"><h4>Jonathan Adelman<br>
            Paradigm Agency<br></h4>
            <h5><a href="music-newyork@paradigmagency.com">music-newyork@paradigmagency.com</a></h5></div>
            <br>
            <h3>Other Inquiries:</h3>
            <div class="mail"><h4>Frank McDonough<br>
            McDonough Management<br></h4>
            <h3><a href="frank@mcdman.com">frank@mcdman.com</a></h3></div>

            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            

            <h3>Site created by Kenny Lu</h3>
            <div class="mail"><h3><a href="lukennyc@gmail.com">Email Me</a></h3></div>

            <br><br>

            <h3>Administrator:</h3>

            <div id="centerform">

              <fieldset>
                <label for="username"><h4>Username:</h4></label>
                <input id="username" class="input-box" name="username" type="text">
                <br>

                <label for="password"><h4>Password:</h4></label>
                <input id="password" class="input-box" name="password" type="password">
                <br>

                <input type="submit" id="submit" class="btn btn-lg btn-primary" role="button" name="login" value="Log In">

                <div id="errors"></div>

                <script>
                $('#submit').on('click', function() {

                  var username = $('input#username').val();
                  var password = $('input#password').val();

                  console.log('ajax');

                  $.ajax({
                    url: "processlogin.php",
                    type: 'post',
                    data: {username: username, password: password},

                    success: function(data) {
                      $('#errors').html(data);


                      if(data == "<h3>Login Successful</h3> "){
                    window.location.replace("admindashboard.php");
                  }
                    }

                  });

                });

                </script>



                </fieldset>

              </div>
  </div>

        <div class="col-md-6">
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