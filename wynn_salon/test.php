     <!--  <?php

ini_set('display_errors', 'On');
include 'storeddata.php';


if(isset($_REQUEST['login'])){




$mysqli = new mysqli("$host", "$db", "$pass", "$db");
if(!$mysqli || $mysqli->connect_errno){
  echo "There is a problem. Please email djklu31@gmail.com";
}

  $username = $mysqli->real_escape_string($_POST['username']);
  $password = $_POST['password'];


if(!($stmt = $mysqli->prepare("SELECT pass, name, id FROM clients c WHERE c.username = ?"))){
  echo "<h3>No User Found</h3>";
}


if(!($stmt->bind_param("s", $username))){

}

if(!$stmt->execute()){
  echo "<h3>No User Found</h3>";
} 

$stmt->store_result();

$checkuser = $stmt->num_rows;

if(!$stmt->bind_result($dbpass, $dbname, $cid)){
  echo "Bind failed: "; 
}


while($stmt->fetch()){

}


$stmt->close();



if(($dbpass == $password) && ($checkuser > 0)){
  $_SESSION['user']=$_POST['username'];
  $_SESSION['clientname']=$dbname;
  $_SESSION['cid']=$cid;

  header('Location: admindashboard.php');

} else {
  echo "<br>";
  echo "<h3>Password is incorrect<h3>";
}

}





?> -->
