<?php
// Page d'accueil/////////////////////////////////////////////////////////////////////////


  // Initialiser la session
  session_start();
  // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
  if(!isset($_SESSION["username"])){
    header("Location: login.php");
    exit(); 
  }
?>
<!DOCTYPE html>
<html>
  <head>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="dist/style.css" />
  <title>Accueil</title>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
  </head>
  <body>
     <img style="margin:auto;text-align:center;display:block"
     src="logo.png"
    >
    <div class="sucess">
    <h1>Bienvenue sur UniqueTrip <?php echo $_SESSION['username']; ?>!</h1>
    
	<html>
   
   <body>
      <button onclick="window.location.href = 'profil.php';">Mon profil</button>
   </body><br>
   <br>	

	
	<button onclick="window.location.href = 'bestlieumap.php';">Meilleurs lieux à voir</button>
   <br>	
   <br>	
	<button onclick="window.location.href = 'dist/preptravel.php';">Itinéraire</button>
   <br>
   <br>	

   	<button onclick="window.location.href = 'dist/historique.php';">Historique de trajets</button>
   <br>
      <br>	


      <button onclick="window.location.href = 'logout.php';">Déconnexion</button>
   <br>	
	   <br>	

	
    
    </div>
  </body>
</html>