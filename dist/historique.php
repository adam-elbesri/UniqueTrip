<html>
<head>
  <meta charset="utf-8" />
  <title>Historique</title>
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>
<form method="post" action="">
    <a href="../index.php">
        <input type="button" value="Revenir en arrière" name ="test">
    </a>
</form>
<h1>Votre historique</h1>
  

<?php
//error_reporting(1);

function redirect( $statusCode = 303)
{
   header("Location: histo.php", true, $statusCode);
   
}
if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['someAction']))
  {
    redirect();
  }


error_reporting(1);
session_start();
if(!isset($_SESSION["username"])){
  header("Location: login.php");
  exit(); 
}
require('config.php');

$user = $_SESSION['username'];

$result = mysqli_query($conn, "SELECT `date`, `ville`, `hname` FROM `usertravel` WHERE `username`='$user'");

// On affiche chaque requêtte une à une
for ($i=0 ; $i < $result->num_rows ; $i++) {
  $row = $result->fetch_assoc() ;
  $date = $row['date'] ;
  $ville = $row['ville'] ;
  $hotel = $row['hname'] ;
  //echo '<p> DATE : '.$date.'</p>'."\r\n" ;
  echo '<p> VILLE : '.$ville.'</p>'."\r\n" ;
  echo '<p> HOTEL : '.$hotel.'</p>'."\r\n" ;
  
 // echo'<input type="text" class="input-members-2" value="'.$ville.'" name="create" readonly > <br>';
  
  //echo '<input type="SUBMIT" value="Search!" > ';
  //echo '<p>------------------------------------------------------------</p>';
  ?>
  <form method="post" action="">
  </select> 
  </table>
  
  <p>
  
      
      <input type="text" class="input-members-2" value="<?php echo $date; ?>" name="create" readonly >
      </p>

      <input type="submit" value="Revoir" name="someAction" />
  
  </form>

<?php



  $name = @$_POST['create'];
  $_SESSION['date1'] = $name;

  //echo '<a href="https://www.google.fr/search?q='.$prenom.'" " target="_blank">Lien GOOGLE</a>';
  
}
$test10 = $_SESSION['date1'];

$_SESSION['final'] = $test10;


  unset($_SESSION['date1']);
?>

</body>
</html>