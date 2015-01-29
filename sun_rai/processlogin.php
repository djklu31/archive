<?php
ob_start();
session_start();

ini_set('display_errors', 'On');
include 'storeddata.php';



if(isset($_POST['username']) && $_POST['username'] == 0){


$mysqli = new mysqli("$host", "$db", "$pass", "$db");
if(!$mysqli || $mysqli->connect_errno){
  echo "There is a problem. Please email djklu31@gmail.com.";
}

  $username = $mysqli->real_escape_string($_POST['username']);
  $password = $_POST['password'];


if(!($stmt = $mysqli->prepare("SELECT user, pass FROM sunraiadmin s WHERE s.user = ?"))){
  echo "<h3>No User Found</h3>";
}


if(!($stmt->bind_param("s", $username))){

}

if(!$stmt->execute()){
  echo "<h3>No User Found</h3>";
} 

$stmt->store_result();

$checkuser = $stmt->num_rows;

if(!$stmt->bind_result($dbpass, $dbname)){
  echo "Bind failed: "; 
}


while($stmt->fetch()){

}


$stmt->close();



if(($dbpass == $password) && ($checkuser > 0)){
  $_SESSION['user']=$_POST['username'];

  echo "<h3>Login Successful</h3>";

} else {
  echo "<br>";
  echo "<h3>Password is incorrect<h3>";
}

}





?> 