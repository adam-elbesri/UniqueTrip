<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css" />
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>
<?php
require('config.php');

  // Initialiser la session
  session_start();
  // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
  if(!isset($_SESSION["username"])){
    header("Location: login.php");
    exit(); 
  }


$user = $_SESSION['username'];

  


?>
<form class="box" action="" method="post" >
    <h1>Préparer votre voyage <?php echo $_SESSION['username']; ?></h1>


	<p>Ville de départ :</p>
 <form action="prep2.php" id="formulaire" >
        <input type="text" class="box-input" name="city" placeholder="Nom" required /><br>
        <input type="submit" value="Envoyer" />
</form>



<br/>
<?php
//error_reporting(1);
if(isset($_REQUEST['city'])){
    $recherche2 = stripslashes($_REQUEST['city']); 
    $_SESSION['totalcolumns'] = $recherche2;
    if($recherche2){
          
      header("Location: prep2.php");

    }
}

//echo $recherche2;

?>

</div>
</body>
</html>