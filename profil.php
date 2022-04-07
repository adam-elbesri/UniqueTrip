<?php 
// Formulaire de profil/////////////////////////////////////////////////////////////////////////
session_start();
  // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
  if(!isset($_SESSION["username"])){
    header("Location: login.php");
    exit(); 
  }
require('config.php');

$user = $_SESSION['username'];

$info = mysqli_query($conn, "SELECT * FROM `infouser` WHERE username='$user'")
?>
<html lang="en">
<head>
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    
</head>
<body>
<form>
    <a href="index.php">
        <input type="button" value="Revenir en arrière">
    </a>
    </form>
<?php while($row = mysqli_fetch_assoc($info)){ ?>
    <div style="color:white;padding: 30px 25px 10px 25px;margin: 30px auto;width: 360px;background-color: Grey;text-align: center;font-size:20px;border-radius : 30px 30px / 30px 30px;">
        <div style="background-color: #393737;margin: 20px;border: solid 20px #393737;text-align: center;">
            <h4 style="margin: 2px;">Information du Compte</h4> 
            <hr>
            <div style="text-align: center;">
                <label for="create" style="margin-left:40px;"></label> <br>
				
                Utilisateur   :  <input type="text" class="input-members-2" value="<?php echo $row['username']; ?>" name="create" readonly style="background-color: #393737;color: #4DB98A;text-align: center;"> <br>
                
                Prénom        :  <input type="text" class="input-members-2" value="<?php echo $row['firstname']; ?>" name="create" readonly style="background-color: #393737;color: #4DB98A;text-align: center;"> <br>
                Nom           :  <input type="text" class="input-members-2" value="<?php echo $row['lastname']; ?>" name="create" readonly style="background-color: #393737;color: #4DB98A;text-align: center;"> <br>
				Anniversaire :  <input type="text" class="input-members-2" value="<?php echo $row['birthday']; ?>" name="create" readonly style="background-color: #393737;color: #4DB98A;text-align: center;"> <br>
				Téléphone     :  <input type="text" class="input-members-2" value="<?php echo $row['phone']; ?>" name="create" readonly style="background-color: #393737;color: #4DB98A;text-align: center;"> <br>
				Activité      :  <input type="text" class="input-members-2" value="<?php echo $row['activities']; ?>" name="create" readonly style="background-color: #393737;color: #4DB98A;text-align: center;"> <br>
				Physique      :  <input type="text" class="input-members-2" value="<?php echo $row['physical']; ?>" name="create" readonly style="background-color: #393737;color: #4DB98A;text-align: center;"> <br>
				Alimentation  :  <input type="text" class="input-members-2" value="<?php echo $row['alimentation']; ?>" name="create" readonly style="background-color: #393737;color: #4DB98A;text-align: center;"> <br>
            </div>
            <?php if (! empty($message)) { ?> <p class="errorMessage" style="background-color:#e66262;border:#AA4502 1px solid;color:#FFFFFF;padding:5px 10px;border-radius:3px;"><?php echo $message; ?></p> <?php }?>
        </div>
    </div>
<?php } ?>
</body>
    
</html>