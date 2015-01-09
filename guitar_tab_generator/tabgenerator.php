<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en"
>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link type="text/css" rel="stylesheet" href="style.css"/>
    <script type="text/javascript">
                function openWin(url)
                {
                    window.open(url, "mywin", "menubar=0, resizable=0, width=800, height=1000")
                }
    </script>
	<title>Guitar Tab Generator</title>
</head>

<body>
	<h3>Generate a Guitar Tab<br>
  Search for a Guitar Tab!</h3>
		<form action="tabgenerator.php" method="POST">
			<fieldset>
				<div>
					<p>Artist:
						<input type="text" id="artist" name="artist">
					</p>
				</div>
				<div>
					<p>Song Name:
						<input type="text" id="song" name="song">
					</p>
				</div>
				<div>
					<p>Maximum Tabs on Page:
						<select name="perpage">
							<option value ='50'>50</option>
							<option value ='100'>100</option>
							<option value ='250'>250</option>
							<option value ='500'>500</option>
						</select><br>
					</p>
				</div>
			</fieldset>
							<input type="submit" name="search" value="Submit">
	</form>

  <script src="http://code.jquery.com/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>
</html>

<?php
libxml_use_internal_errors(true);

if(isset($_REQUEST['search'])){

echo "Please wait a few moments for the tabs to load...";
echo "<br>";

$artist = str_replace(" ", "+", $_POST['artist']);
$song = str_replace(" ", "+", $_POST['song']);
$perpage = (int)$_POST['perpage'];

$startcount = 0;
$endcount = $perpage;
$resultcount = 0;
$sitepage = 1;
$pagecount = 0;

$store = array("artist" => $artist, "song" => $song, "perpage" => $perpage, "startcount" => $startcount, "endcount" => $endcount, "resultcount" => $resultcount, "sitepage" => $sitepage, "pagecount" => $pagecount);

$_SESSION['store'] = $store;

gettabs();
}

function gettabs(){
	$artistrequest = $_SESSION['store']['artist'];
	$songrequest = $_SESSION['store']['song'];

  $sitepage = $_SESSION['store']['sitepage'];

	$starcount = $_SESSION['store']['startcount'];
	$endcount = $_SESSION['store']['endcount'];
	$resultcount = $_SESSION['store']['resultcount'];
  $perpage = $_SESSION['store']['perpage'];
  $pagecount = $_SESSION['store']['pagecount'];


	$searchvalues = $artistrequest . "+" . $songrequest;
  //the first xml request below is just to figure out how many pages of tabs are available for this artist or song.
  //also, it'll check to see if any tabs exist or not. 
	$url = "http://app.ultimate-guitar.com/search.php?search_type=title&page=$sitepage&iphone=1&value=$searchvalues";

	$xml = simplexml_load_file($url);

  $pagecount = (int)$xml['pages'];

	$resultsback = (int)$xml['count'];

  $_SESSION['store']['pagecount'] = $pagecount;

  $_SESSION['store']['resultcount'] = $resultsback;

  if($resultsback == 0){
    echo "No tabs found.";
  }
  else if($resultsback > 0){
    $urlarray = array();

  for($x=1; $x<=$pagecount; $x++){
    $urlarray[$x] = "http://app.ultimate-guitar.com/search.php?search_type=title&page=$x&iphone=1&value=$searchvalues";
  }

  processtabs($urlarray);
  }
}

function processtabs($urlarray){
$page = $_SESSION['store']['pagecount'];
$start = $_SESSION['store']['startcount'];
$finish = $_SESSION['store']['endcount'];
$perpage = $_SESSION['store']['perpage'];
$totalcount = 0;
$storedata = array();
$taburlarray = array();

for($x=1; $x<=$page; $x++){
  $xml = simplexml_load_file($urlarray[$x]);
  $resultsonpage = (int)$xml['count'];

  if($resultsonpage > 0) {
    $totalcount = $totalcount + $resultsonpage;
  }

  for($y=0; $y<$resultsonpage; $y++){
    $artist = $xml->result[$y]['artist'];
    $song = $xml->result[$y]['name'];
    $type = $xml->result[$y]['type'];
    $version = $xml->result[$y]['version'];
    $tabrating = $xml->result[$y]['rating'];
    $url = $xml->result[$y]['url'];

    $storedata[$y] = "<div>   Artist: $artist</div><div>   Song: $song</div><div>   Type: $type</div><div>   Version: $version</div><div>   Tab Rating: $tabrating</div>";
    $taburlarray[$y] = $url;
  }

}
$_SESSION['store']['resultcount'] = $totalcount;

printurls($storedata, $taburlarray);
}

function printurls($storedata, $taburlarray){
$start = $_SESSION['store']['startcount'];
$perpage = $_SESSION['store']['perpage'];
$totalcount = $_SESSION['store']['resultcount'];
$resultsprint = $_SESSION['store']['perpage'];

if($totalcount < $perpage)
{
    $resultsprint = $totalcount;
}

for($x=0; $x<$resultsprint; $x++){

  echo "<br>";
  //echo "<a href=$taburlarray[$x]>Tab #</a>" . ($x+1);

  if($storedata[$x] == ""){
    break;
  }
  else{
  echo $storedata[$x];
  echo "<input type=\"submit\" name=\"tab$x\" formaction=\"" . $taburlarray[$x] . "\" onclick=\"javascript:openWin('" . $taburlarray[$x] . "')\" value=\"Get Tab\">";
  echo "<br>";
  }

}
}
?>
