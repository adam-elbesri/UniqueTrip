<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css" />
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>

<div id="formulaire" style="display:block">

<?php

session_start();
function redirect( $statusCode = 303)
{
   header("Location: index.php", true, $statusCode);
   
}
if(!isset($_SESSION["username"])){
  header("Location: login.php");
  exit(); 
}
if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['someAction']))
  {
    redirect();
  }


$recherche2 = $_SESSION['totalcolumns'];






 ?>
 <h1> Séléctionnez votre hôtel : </h1>
 


<form method="post" action="">
<select required name="hotel"> 
<option value="" >-- Choisissez -- </option> 
<?php
require('config.php');
$result = mysqli_query($conn ,"SELECT `COL 5` FROM `hosting_zip` WHERE `COL 22`='$recherche2' ");
while ($donnees = mysqli_fetch_array($result))
{
//Liste déroulante 
$row = $result->fetch_assoc() ;
  $lieu = $row['COL 5'] ;
echo'<option value ="'.$lieu.'">'.$lieu.'</option>'; 
}
?> 
</select> 
</table>

<p>

    Cochez vos lieux favoris : <br />
    <input type="checkbox" name="lieu1" value="ruins" id="monument historique" /> <label for="monument historique">Monuments historiques</label> <br />
    <input type="checkbox" name="lieu2" value="memorial" id="memorial"/> <label for="memorial">Mémorial</label> <br />
    <input type="checkbox" name="lieu3" value="place_of_worship" id="place_of_worship"/> <label for="place_of_workship">Monuments religieux</label> <br />
    <input type="checkbox" name="lieu4" value="castle" id="castle"/> <label for="castle">Châteaux</label> <br />
    </p>




    <input type="submit" value="Envoyer" name="someAction" />

</form></div>


<?php 

$result = mysqli_query($conn ,"SELECT `COL 5` FROM `lieu` WHERE `COL 16`='$recherche2' ");
if(mysqli_num_rows($result) == 0 ){

//echo "fausse ville";
echo "<script> document.getElementById('formulaire').innerHTML='Nom de ville incorrect';</script>";
echo " Veuillez réessayer avec une nouvelle ville ";
echo "<a href = 'preptravel.php'>Itinéraire</a>";
}
?>
<?php



$name = @$_POST['hotel'];
$_SESSION['hotel'] = $name;

$name1 = @$_POST['lieu1'];
$_SESSION['l1'] = $name1;

$name2 = @$_POST['lieu2'];
$_SESSION['l2'] = $name2;

$name3 = @$_POST['lieu3'];
$_SESSION['l3'] = $name3;

$name4 = @$_POST['lieu4'];
$_SESSION['l4'] = $name4;

echo $_SESSION['hotel'];
  echo'<br/>';
  echo $_SESSION['l1'];
  echo'<br/>';
  echo $_SESSION['l2'];
  echo'<br/>';
  echo $_SESSION['l3'];
  echo'<br/>';
  echo $_SESSION['l4'];
  
  
  

?>
</body>
</html>