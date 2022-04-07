<html>
<head>
  <meta charset="utf-8" />
  <title>Mon itinéraire</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<!-- Load Leaflet from CDN -->
	<meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />

  <!-- original CSS of the routing-machine, for reference/ not used here -->
  <!-- link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" / -->
  
	<!-- Load Leaflet from CDN -->
	  

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
  
    
  <style>
    .map {
      
      width : 100%;
      height : 500px;
    }
  </style>
  
  <!--<script type="text/javascript" src="script.js"> </script>-->
  <link rel="stylesheet" href="./style.css">
</head>
<body>
<form>
    <a href="../index.php">
        <input type="button" value="Revenir à l'accueil">
    </a>
</form>
<b>Mon itinéraire</b>
  <div id="map" class="map"></div>
  
<br />
<hr/>



<!-- partial -->
 <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>
  <script src="leaflet-routing-machine-3.2.12\dist\leaflet-routing-machine.js"></script>
    <script src="script.js"></script>
  
  

  

<?php
error_reporting(1);
session_start();
if(!isset($_SESSION["username"])){
  header("Location: login.php");
  exit(); 
}
  $user = $_SESSION['username'];
  $final = $_SESSION['final'];

  
 


require('config.php');

$resulthot = mysqli_query($conn, "SELECT `ville`,`hname`, `hlong`, `hlat`,`n1`,`lat1`, `long1`,`n2`,`lat2`, `long2`,`n3`,`lat3`, `long3`,`n4`,`lat4`, `long4` FROM `usertravel` WHERE `date`='$final'");
$row = $resulthot->fetch_assoc(); 
$ville = $row['ville'] ;
$hname = $row['hname'] ;
$hlong = $row['hlong'] ;
$hlat = $row['hlat'] ;
$lat1 = $row['lat1'] ;
$long1 = $row['long1'] ;
$lat2 = $row['lat2'] ;
$long2 = $row['long2'] ;
$lat3 = $row['lat3'] ;
$long3 = $row['long3'] ;
$lat4 = $row['lat4'] ;
$long4 = $row['long4'] ;
$n1 = $row['n1'] ;
$n2 = $row['n2'] ;
$n3 = $row['n3'] ;
$n4 = $row['n4'] ;

echo '<script>begin_routing('.$hlat.','.$hlong.','.$lat1.','.$long1.','.$lat2.','.$long2.','.$lat3.','.$long3.','.$lat4.','.$long4.');</script>';

  unset($_SESSION['final']);


echo '<h3>Ville : '.$ville.'</h3>';

echo '<h3>Hôtel : '.$hname.'</h3>';

echo '<h3>Lieu 1 : '.$n1.'</h3>';

echo '<h3>Lieu 2 : '.$n2.'</h3>';

echo '<h3>Lieu 3 : '.$n3.'</h3>';

echo '<h3>Lieu 4 : '.$n4.'</h3>';

?>

</body>
</html>