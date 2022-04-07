
<html>
    <head>
        <meta charset="utf-8">
        <!-- Nous chargeons les fichiers CDN de Leaflet. Le CSS AVANT le JS -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin="" />
        <style type="text/css">
            #map{ /* la carte DOIT avoir une hauteur sinon elle n'apparaît pas */
                height:600px;
            }
        </style>
        <title>Meilleurs lieux</title>
             <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

		<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>
	<script type="text/javascript">
            // On initialise la latitude et la longitude de Paris (centre de la carte)
			
			//var test = 48.852969;
            //var lat = test;
            //var lon = 2.349903;
			
            var macarte = null;
            // Fonction d'initialisation de la carte
		  
		  
		  
		  
           function initMap(lat , lon) {
				//windows.location.reload();
                // Créer l'objet "macarte" et l'insèrer dans l'élément HTML qui a l'ID "map"
				//var lat = 45.4514555004189;
				//var lon = 4.3818751;	
                macarte = L.map('map').setView([lat, lon], 11);
                // Leaflet ne récupère pas les cartes (tiles) sur un serveur par défaut. Nous devons lui préciser où nous souhaitons les récupérer. Ici, openstreetmap.fr
                L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
                    // Il est toujours bien de laisser le lien vers la source des données
                    attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
                    minZoom: 10,
                    maxZoom: 20
					
                }).addTo(macarte);				
            }	 
			function petit_point(lat , lon){
				var marker = L.marker([lat, lon]).addTo(macarte);
				}

        </script>
			
    </head>
    <body>
	<form>
    <a href="index.php">
        <input type="button" value="Revenir en arrière">
    </a>
    </form>
	<form method="POST" action=""> 
     Nom de la ville : <input type="text" name="recherche"  required>
     <input type="SUBMIT" value="Search!"> 
     </form>
	
        <div id="map">
	    <!-- Ici s'affichera la carte -->
		</div>

        <!-- Fichiers Javascript -->
        

<?php 
header("Content-Type: text/html; charset=utf-8");

error_reporting(1);
session_start();
  // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
  if(!isset($_SESSION["username"])){
    header("Location: login.php");
    exit(); 
  }

require('config.php');
$recherche = @stripslashes($_REQUEST['recherche']); 
$result = mysqli_query($conn, "SELECT `COL 1`, `COL 2`, `COL 5` FROM `lieu` WHERE `COL 16`='$recherche'");

if (!mysqli_num_rows($result) == 0) {

//echo $result;

echo "Meilleurs lieux de $recherche :";
echo "<br>";



// On affiche chaque requête une à une
for ($i=0 ; $i < $result->num_rows ; $i++) {
  $row = $result->fetch_assoc() ;
  $prenom = $row['COL 5'] ;
  $long = $row['COL 1'] ;
  $lat = $row['COL 2'] ;
  echo '<p>'.$prenom.'</p>'."\r\n" ;
  //echo '<p>'.$lat.'</p>'."\r\n" ;
  //echo '<p>'.$long.'</p>'."\r\n" ;
  echo '<input type="SUBMIT" value="Search!"  onclick="petit_point('.$lat.' ,'.$long.')"  > ';
  echo '<a href="https://www.google.fr/search?q='.$prenom.'" " target="_blank">En savoir plus</a>';
  
}
echo '<script>initMap('.$lat.' ,'.$long.');</script>';
}
else{
    echo '<script> document.getElementById("map").style.height=0;</script>';
    if($recherche !='')
    echo "Nom de ville incorrect";
}

?>
		
    </body>
</html>
