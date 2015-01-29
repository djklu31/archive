<?php
ob_start();
// session_start();
// header('Content-type: text/json');
// header('Content-type: application/json');
ini_set('display_errors', 'On');
include 'storeddata.php';


$aid = $_POST['aid'];


    $mysqli = new mysqli("$host", "$db", "$pass", "$db");
  if(!$mysqli || $mysqli->connect_errno){
  echo "There is a problem. Please email djklu31@gmail.com";
}



if ($mysqli->query("DELETE FROM sunraishows WHERE id = $aid") === TRUE) {
    echo "Record deleted successfully";

} else {
    echo "Error deleting record: " . mysqli_error($mysqli);
}



?>