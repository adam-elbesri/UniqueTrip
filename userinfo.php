<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css" />
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>
<?php

// Informations du profil/////////////////////////////////////////////////////////////////////////

require('config.php');

  // Initialiser la session
  session_start();
  // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
  if(!isset($_SESSION["username"])){
    header("Location: login2.php");
    exit(); 
  }


$user = $_SESSION['username'];

  
if (isset($_REQUEST['firstname'], $_REQUEST['lastname'], $_REQUEST['birthday'],$_REQUEST['phonenumber'],$_REQUEST['activities'],$_REQUEST['physical'],$_REQUEST['alimentation'])){
  
  $firstname = stripslashes($_REQUEST['firstname']);
  $firstname = mysqli_real_escape_string($conn, $firstname); 
  
  $lastname = stripslashes($_REQUEST['lastname']);
  $lastname = mysqli_real_escape_string($conn, $lastname);
  
  $birthday = stripslashes($_REQUEST['birthday']);
  $birthday = mysqli_real_escape_string($conn, $birthday);
  
  $phonenumber = stripslashes($_REQUEST['phonenumber']);
  $phonenumber = mysqli_real_escape_string($conn, $phonenumber);
  
  $activities = stripslashes($_REQUEST['activities']);
  $activities = mysqli_real_escape_string($conn, $activities);
  
  $physical = stripslashes($_REQUEST['physical']);
  $physical = mysqli_real_escape_string($conn, $physical);
  
  $alimentation = stripslashes($_REQUEST['alimentation']);
  $alimentation = mysqli_real_escape_string($conn, $alimentation);
  
  
  //requéte SQL + mot de passe crypté
    $query = "INSERT into `infouser` (username, firstname, lastname, birthday, phone, activities, physical, alimentation)
              VALUES ('$user', '$firstname', '$lastname', '$birthday', '$phonenumber', '$activities', '$physical', '$alimentation')";
  // Exécuter la requête sur la base de données
    $res = mysqli_query($conn, $query);
    if($res){
       
             header("Location: index.php");
       
    }
}else{

?>
<form class="box" action="" method="post">
    <h1>Bienvenue sur UniqueTrip <?php echo $_SESSION['username']; ?>!</h1>
	<p>Nom :</p>
  <input type="text" class="box-input" name="firstname" placeholder="Nom" required /><br>
  <p>Prenom :</p>
  <input type="text" class="box-input2" name="lastname" placeholder="Prenom" required /><br>
  <p>Anniversaire :</p>
  <input type="date" class="box-input3" name="birthday" placeholder="anniversaire" required /><br>
  <p>numéro de télephone :</p>
  <input type="text" class="box-input4" name="phonenumber" placeholder="Numéro de télephone" required /><br>
  <p>votre type d'activité :</p>
  <select name="activities" multiple="yes" size="3">

	<option>Road Trip </option>
	<option>voyage tranquille</option>
	<option>détente</option>

</select><br>

<p>votre niveau physique :</p>
<select name="physical" size="3">

	<option>élevé</option>
	<option>moyen</option>
	<option>faible</option>


</select><br>

<p>alimentation favorite :</p>
<select name="alimentation" size="3">

	<option>réstaurant</option>
	<option>fast food</option>
	<option>snack</option>

</select><br>
    
    <input type="submit" name="submit" value="Valider" class="box-button" />
    
</form>
<?php } ?>
</body>
</html>