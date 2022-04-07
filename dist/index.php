<html>
<head>
      <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mon itinéraire</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
    <style>
        .map {
            position: relative;
            width: 100%;
            height: 100%;
        }
    </style>
  
 <!-- <script type="text/javascript" src=script.js> </script>-->
  <link rel="stylesheet" href="./style.css">
</head>
<body>
<form>
    <a href="../index.php">
        <input type="button" value="Revenir à l'accueil">
    </a>
</form>
<b>Mon itinéraire</b>
<span id="attente">Nous cherchons le trajet le plus optimal <img src="chargement.gif" alt="this slowpoke moves" ></span>
<br>
  <div id="map" class="map"></div>
  
<br />
<hr/>


<!-- partial -->
 <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>
   <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

    <script src="leaflet-routing-machine-3.2.12\dist\leaflet-routing-machine.js"></script>

  <script  src="route.js"></script>
  <form>
    <a href="preptravel.php">
        <input type="button" value="Nouveau trajet">
    </a>
</form>

  

<?php
//error_reporting(1);
session_start();
if(!isset($_SESSION["username"])){
  header("Location: login.php");
  exit(); 
}
  $user = $_SESSION['username'];

  $ville = $_SESSION['totalcolumns'];
  $hotel = $_SESSION['hotel'];
  $choice1 = $_SESSION['l1'];
  $choice2 = $_SESSION['l2'];
  $choice3 = $_SESSION['l3'];
  $choice4 = $_SESSION['l4'];

  echo "<br>";
  
 


require('config.php');

$resulthot = mysqli_query($conn, "SELECT `COL 1`, `COL 2`, `COL 5` FROM `hosting_zip` WHERE `COL 5`='$hotel'");
$row = $resulthot->fetch_assoc(); 
$nameh = $row['COL 5'] ;
$hlong = $row['COL 1'] ;
$hlat = $row['COL 2'] ;
echo "<h3>Votre hôtel est : ",$nameh,"</h3>";

echo " Voici les lieux du trajets : <br>";

$items = array();

if($choice1 !='' && $choice2 != '' && $choice3 != '' && $choice4 !=''){

      $result = mysqli_query($conn, "SELECT `COL 3`, `COL 5` FROM `lieu` WHERE `COL 16`='$ville' AND ( `COL 4`='$choice1' or `COL 4`='$choice2' or `COL 4`='$choice3' or `COL 4`='$choice4' ) GROUP by `COL 4` ORDER BY rand() LIMIT 4;");
    // On affiche chaque recette une à une

    for ($i=0 ; $i < $result->num_rows ; $i++) {
      $row = $result->fetch_assoc() ;
      $lieu = $row['COL 5'] ;
      $id = $row['COL 3'] ;
      
      $items[] = $id;
    }
}
else{


if($choice1!='')
{
  $result = mysqli_query($conn, "SELECT `COL 3`, `COL 5` FROM `lieu` WHERE `COL 16`='$ville' AND `COL 4`='$choice1' ORDER BY rand() LIMIT 4;");
    // On affiche chaque recette une à une

    for ($i=0 ; $i < $result->num_rows ; $i++) {
      $row = $result->fetch_assoc() ;
      $lieu = $row['COL 5'] ;
      $id = $row['COL 3'] ;
      
      $items[] = $id;
    }
}
    

if($choice2!='')
{
   $result = mysqli_query($conn, "SELECT `COL 3`,  `COL 5` FROM `lieu` WHERE `COL 16`='$ville' AND `COL 4`='$choice2' ORDER BY rand() LIMIT 4;");
    // On affiche chaque recette une à une

    for ($i=0 ; $i <$result->num_rows ; $i++) {
      $row = $result->fetch_assoc() ;
      $lieu = $row['COL 5'] ;
      $id = $row['COL 3'] ;
      
      $items[] = $id;
    }

}
   
if($choice3!=''){
    $result = mysqli_query($conn, "SELECT `COL 3`,  `COL 5` FROM `lieu` WHERE `COL 16`='$ville' AND `COL 4`='$choice3' ORDER BY rand() LIMIT 4;");
    // On affiche chaque recette une à une

    for ($i=0 ; $i <$result->num_rows ; $i++) {
      $row = $result->fetch_assoc() ;
      $lieu = $row['COL 5'] ;
      $id = $row['COL 3'] ;
      
      $items[] = $id;
    }
}
  

if($choice4!=''){
      $result = mysqli_query($conn, "SELECT `COL 3`,  `COL 5` FROM `lieu` WHERE `COL 16`='$ville' AND `COL 4`='$choice4' ORDER BY rand() LIMIT 4;");
      // On affiche chaque recette une à une

      for ($i=0 ; $i < $result->num_rows ; $i++) {
        $row = $result->fetch_assoc() ;
        $lieu = $row['COL 5'] ;
        $id = $row['COL 3'] ;
        
        $items[] = $id;
      }
    }


}

unset($_SESSION['totalcolumns']);
unset($_SESSION['hotel']);
unset($_SESSION['l1']);
unset($_SESSION['l2']);
unset($_SESSION['l3']);
unset($_SESSION['l4']);
//print_r($items);
shuffle($items);


if(isset($items[0])){
  $dest1 = $items[0];
}
if(isset($items[1])){
  $dest2 = $items[1];
}
if(isset($items[2])){
  $dest3 = $items[2];
}
if(isset($items[3])){
  $dest4 = $items[3];
}


echo '<br/>';

if(isset($dest1) && isset($dest2) && isset($dest3) && isset($dest4)){

  $lieu1 = mysqli_query($conn, "SELECT `COL 1`, `COL 2`, `COL 5` FROM `lieu` WHERE `COL 3`='$dest1'");

  $row = $lieu1->fetch_assoc() ;
  $place = $row['COL 5'] ;
  $long = $row['COL 1'] ;
  $lat = $row['COL 2'] ;
  echo '<p>'.$place.'</p>'."\r\n" ;
  echo '<p>'.$lat.'</p>'."\r\n" ;
  echo '<p>'.$long.'</p>'."\r\n" ;
    echo '<a href="https://www.google.fr/search?q='.$place.'" " target="_blank">En savoir plus</a>';

  $lieu2 = mysqli_query($conn, "SELECT `COL 1`, `COL 2`, `COL 5` FROM `lieu` WHERE `COL 3`='$dest2'");

  $row2 = $lieu2->fetch_assoc() ;
  $place2 = $row2['COL 5'] ;
  $long2 = $row2['COL 1'] ;
  $lat2 = $row2['COL 2'] ;
  echo '<p>'.$place2.'</p>'."\r\n" ;
  echo '<p>'.$lat2.'</p>'."\r\n" ;
  echo '<p>'.$long2.'</p>'."\r\n" ; 
      echo '<a href="https://www.google.fr/search?q='.$place2.'" " target="_blank">En savoir plus</a>';

  
  $lieu3 = mysqli_query($conn, "SELECT `COL 1`, `COL 2`, `COL 5` FROM `lieu` WHERE `COL 3`='$dest3'");

  $row3 = $lieu3->fetch_assoc() ;
  $place3 = $row3['COL 5'] ;
  $long3 = $row3['COL 1'] ;
  $lat3 = $row3['COL 2'] ;
  echo '<p>'.$place3.'</p>'."\r\n" ;
  echo '<p>'.$lat3.'</p>'."\r\n" ;
  echo '<p>'.$long3.'</p>'."\r\n" ; 
      echo '<a href="https://www.google.fr/search?q='.$place3.'" " target="_blank">En savoir plus</a>';


  $lieu4 = mysqli_query($conn, "SELECT `COL 1`, `COL 2`, `COL 5` FROM `lieu` WHERE `COL 3`='$dest4'");

  $row4 = $lieu4->fetch_assoc() ;
  $place4 = $row4['COL 5'] ;
  $long4 = $row4['COL 1'] ;
  $lat4 = $row4['COL 2'] ;
  echo '<p>'.$place4.'</p>'."\r\n" ;
  echo '<p>'.$lat4.'</p>'."\r\n" ;
  echo '<p>'.$long4.'</p>'."\r\n" ;
      echo '<a href="https://www.google.fr/search?q='.$place4.'" " target="_blank">En savoir plus</a>';
 
 echo "4 seul truc";
//echo' <script> route(4.836805,45.7706367003766,45.7611224257888,4.82780404621101,45.7692983003768,4.8320143,45.7538031778718,4.81935922201298,45.7685962073952,4.83253044198038)</script>';
  echo '<script>route('.$hlong.','.$hlat.','.$lat.','.$long.','.$lat2.','.$long2.','.$lat3.','.$long3.','.$lat4.','.$long4.');</script>';
 // echo '<script></script>';
 $query1 = "INSERT INTO `usertravel`(`username`, `ville`, `hname`, `hlong`, `hlat`, `n1`, `lat1`, `long1`,`n2`, `lat2`, `long2`, `n3`, `lat3`, `long3`, `n4`, `lat4`, `long4`) VALUES ('$user','$ville','$nameh','$hlong','$hlat','$place','$lat','$long','$place2','$lat2','$long2','$place3','$lat3','$long3','$place4','$lat4','$long4');";
  $res1 = mysqli_query($conn, $query1);
}

if(isset($dest1) && isset($dest2) && isset($dest3) && !isset($dest4)){

  $lieu1 = mysqli_query($conn, "SELECT `COL 1`, `COL 2`, `COL 5` FROM `lieu` WHERE `COL 3`='$dest1'");

  $row = $lieu1->fetch_assoc() ;
  $place = $row['COL 5'] ;
  $long = $row['COL 1'] ;
  $lat = $row['COL 2'] ;
  echo '<p>'.$place.'</p>'."\r\n" ;
  echo '<p>'.$lat.'</p>'."\r\n" ;
  echo '<p>'.$long.'</p>'."\r\n" ;
      echo '<a href="https://www.google.fr/search?q='.$place.'" " target="_blank">En savoir plus</a>';


  $lieu2 = mysqli_query($conn, "SELECT `COL 1`, `COL 2`, `COL 5` FROM `lieu` WHERE `COL 3`='$dest2'");

  $row2 = $lieu2->fetch_assoc() ;
  $place2 = $row2['COL 5'] ;
  $long2 = $row2['COL 1'] ;
  $lat2 = $row2['COL 2'] ;
  echo '<p>'.$place2.'</p>'."\r\n" ;
  echo '<p>'.$lat2.'</p>'."\r\n" ;
  echo '<p>'.$long2.'</p>'."\r\n" ; 
      echo '<a href="https://www.google.fr/search?q='.$place2.'" " target="_blank">En savoir plus</a>';

  
  $lieu3 = mysqli_query($conn, "SELECT `COL 1`, `COL 2`, `COL 5` FROM `lieu` WHERE `COL 3`='$dest3'");

  $row3 = $lieu3->fetch_assoc() ;
  $place3 = $row3['COL 5'] ;
  $long3 = $row3['COL 1'] ;
  $lat3 = $row3['COL 2'] ;
  echo '<p>'.$place3.'</p>'."\r\n" ;
  echo '<p>'.$lat3.'</p>'."\r\n" ;
  echo '<p>'.$long3.'</p>'."\r\n" ; 
      echo '<a href="https://www.google.fr/search?q='.$place3.'" " target="_blank">En savoir plus</a>';

 echo "3seul truc";
//echo' <script> route(4.836805,45.7706367003766,45.7611224257888,4.82780404621101,45.7692983003768,4.8320143,45.7538031778718,4.81935922201298,45.7685962073952,4.83253044198038)</script>';
  echo '<script>route3('.$hlong.','.$hlat.','.$lat.','.$long.','.$lat2.','.$long2.','.$lat3.','.$long3.');</script>';
 // echo '<script></script>';
}


if(isset($dest1) && isset($dest2) && !isset($dest3) && !isset($dest4)){

  $lieu1 = mysqli_query($conn, "SELECT `COL 1`, `COL 2`, `COL 5` FROM `lieu` WHERE `COL 3`='$dest1'");

  $row = $lieu1->fetch_assoc() ;
  $place = $row['COL 5'] ;
  $long = $row['COL 1'] ;
  $lat = $row['COL 2'] ;
  echo '<p>'.$place.'</p>'."\r\n" ;
  echo '<p>'.$lat.'</p>'."\r\n" ;
  echo '<p>'.$long.'</p>'."\r\n" ;
      echo '<a href="https://www.google.fr/search?q='.$place.'" " target="_blank">En savoir plus</a>';


  $lieu2 = mysqli_query($conn, "SELECT `COL 1`, `COL 2`, `COL 5` FROM `lieu` WHERE `COL 3`='$dest2'");

  $row2 = $lieu2->fetch_assoc() ;
  $place2 = $row2['COL 5'] ;
  $long2 = $row2['COL 1'] ;
  $lat2 = $row2['COL 2'] ;
  echo '<p>'.$place2.'</p>'."\r\n" ;
  echo '<p>'.$lat2.'</p>'."\r\n" ;
  echo '<p>'.$long2.'</p>'."\r\n" ; 
      echo '<a href="https://www.google.fr/search?q='.$place2.'" " target="_blank">En savoir plus</a>';

   echo "2 seul truc";

//echo' <script> route(4.836805,45.7706367003766,45.7611224257888,4.82780404621101,45.7692983003768,4.8320143,45.7538031778718,4.81935922201298,45.7685962073952,4.83253044198038)</script>';
  echo '<script>route2('.$hlong.','.$hlat.','.$lat.','.$long.','.$lat2.','.$long2.');</script>';
 // echo '<script></script>';
}

if(isset($dest1) && !isset($dest2) && !isset($dest3) && !isset($dest4)){

  $lieu1 = mysqli_query($conn, "SELECT `COL 1`, `COL 2`, `COL 5` FROM `lieu` WHERE `COL 3`='$dest1'");

  $row = $lieu1->fetch_assoc() ;
  $place = $row['COL 5'] ;
  $long = $row['COL 1'] ;
  $lat = $row['COL 2'] ;
  echo '<p>'.$place.'</p>'."\r\n" ;
  echo '<p>'.$lat.'</p>'."\r\n" ;
  echo '<p>'.$long.'</p>'."\r\n" ;
      echo '<a href="https://www.google.fr/search?q='.$place.'" " target="_blank">En savoir plus</a>';


  echo "1 seul truc";

//echo' <script> route(4.836805,45.7706367003766,45.7611224257888,4.82780404621101,45.7692983003768,4.8320143,45.7538031778718,4.81935922201298,45.7685962073952,4.83253044198038)</script>';
  echo '<script>route1('.$hlong.','.$hlat.','.$lat.','.$long.');</script>';
 // echo '<script></script>';
}

//$query1 = "INSERT INTO `usertravel`(`username`, `ville`, `hname`, `hlong`, `hlat`, `n1`, `lat1`, `long1`,`n2`, `lat2`, `long2`, `n3`, `lat3`, `long3`, `n4`, `lat4`, `long4`) VALUES ('$user','$ville','$nameh','$hlong','$hlat','$place','$lat','$long','$place2','$lat2','$long2','$place3','$lat3','$long3','$place4','$lat4','$long4');";
  //$res1 = mysqli_query($conn, $query1);






/*

$result = mysqli_query($conn, "SELECT `COL 1`, `COL 2`, `COL 5` FROM `lieu` WHERE `COL 16`='$ville' ORDER BY rand() LIMIT 0,5;");
// On affiche chaque recette une à une
$items = array();
$names = array();
for ($i=1 ; $i < $result->num_rows ; $i++) {
  $row = $result->fetch_assoc() ;
  $lieu = $row['COL 5'] ;
  $long = $row['COL 1'] ;
  $lat = $row['COL 2'] ;
  echo '<p>'.$lieu.'</p>'."\r\n" ;
  echo '<p>'.$lat.'</p>'."\r\n" ;
  echo '<p>'.$long.'</p>'."\r\n" ;

  //$items[] = $lieu;
  $names[] = $lieu;
  $items[] = $long;
  $items[] = $lat;
  
}


$dep1 = $items[0];
$dep2 = $items[1];
$lat1 = $items[2];
$long1 = $items[3];
$lat2 = $items[4];
$long2 = $items[5];
$lat3 = $items[6];
$long3 = $items[7];
echo '<script>begin_routing('.$hlong.','.$hlat.','.$dep2.','.$dep1.','.$long1.','.$lat1.','.$long2.','.$lat2.','.$long3.','.$lat3.');</script>';

$query = "INSERT INTO `trajets`(`lieu1`, `long1`, `lat1`, `lieu2`, `long2`, `lat2`, `lieu3`, `long3`, `lat3`, `lieu4`, `long4`, `lat4`) VALUES ('.$dep2.','.$dep1.','.$long1.','.$lat1.','.$long2.','.$lat2.','.$long3.','.$lat3.','.$dep2.','.$dep1.','[value-11]','[value-12]');";
$res = mysqli_query($conn, $query);


unset($_SESSION['totalcolumns']);
unset($_SESSION['hotel']);
unset($_SESSION['l1']);
unset($_SESSION['l2']);
unset($_SESSION['l3']);
unset($_SESSION['l4']);

*/
?>

</body>
</html>