<?php

session_start();

include ('./models/config.php');



if (isset($_POST['submit'])) {

  $email = $_POST["email"];
  $username = $_POST['username'];
  $password = $_POST["password"];

  // Vérifier si l'e-mail existe déjà
  $stmt = $connexion->prepare("SELECT email FROM users WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $stmt->store_result();

  if ($stmt->num_rows > 0) {
    echo '<script language="javascript">
      document.write("<br><h3 style=color:red>Cet email est déjà utilisé, veuillez en choisir un autre s\'il vous plaît !</h3>");
  
      setTimeout(function() {
        window.location.href = "https://miramas-écologie.fr/inscription/Titre-pro-s-inscrire.php";
      }, 4000);
    </script>';
    return;
  }

  // Vérifier si le nom d'utilisateur existe déjà
  $stmt = $connexion->prepare("SELECT username FROM users WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $stmt->store_result();

  if ($stmt->num_rows > 0) {
    echo '<script language="javascript">
      document.write("<br><h3 style=color:red>Ce nom d\'utilisateur est déjà utilisé, veuillez en choisir un autre s\'il vous plaît !</h3>");
  
      setTimeout(function() {
        window.location.href = "https://miramas-écologie.fr/inscription/Titre-pro-s-inscrire.php";
      }, 4000);
    </script>';

    return;
    
  }

  // Hash du mot de passe
  $passwordHash = password_hash($password, PASSWORD_BCRYPT);

  //   // l'envoi vers la bdd

  if (empty($_POST['email'])|| empty($_POST['password'])|| empty($_POST['username'])){

     header("Location: https://miramas-écologie.fr/inscription/Titre-pro-s-inscrire.php");

    return;

   } elseif (strlen($_POST['password']) > 255 || strlen($_POST['username'])>255 || strlen($_POST['email']) > 255) {

    header("Location: https://miramas-écologie.fr/inscription/Titre-pro-s-inscrire.php");

    return;
    
  } 
  
  // Génération d'une clé de confirmation aléatoire
  $longueurKey = "15";
  $key="";
  
  for($i=1; $i<$longueurKey; $i++){
      $key .= mt_rand(0,9);
  }

  $stmt = $connexion->prepare("INSERT INTO users (username, email, password, confirmkey) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("ssss", $username, $email, $passwordHash, $key);
  $stmt->execute();

  // Configuration des en-têtes pour l'e-mail de confirmation
   

$headers .= "MIME-Version: 1.0\r\n";
$headers = "From: https://miramas-écologie.fr\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
$headers .= "Content-Transfer-Encoding: 8bit\r\n";

  // Construction du message d'e-mail de confirmation
 
$message = '
<html>
<body>
<div align="center">
<p>Bonjour ,<br>
Félicitations et Merci de vous être inscrit sur notre site. Nous sommes ravis de vous accueillir parmi nous.<br>
Veuillez cliquer sur le lien ci-dessous pour confirmer votre adresse e-mail : <br></p>
<a href="https://miramas-écologie.fr/confirmation?username='.urlencode($username).'&key='.$key.'">Confirmez votre compte !</a>
<p>Si vous avez des questions ou des préoccupations, notre équipe est là pour vous aider.<br>
Cordialement,<br>
Miramas-écologie</p>
</div>
</body>     
</html>
';
      
if (mail($email, "Confirmation de compte", $message, $headers)) {
// Affiche un message de succès indiquant qu'un e-mail de vérification a été envoyé et redirige vers une autre page après 5 secondes
    
 echo '<script language="javascript">
        document.write("<br><h3 style=\'color:green\'>Un e-mail avec un lien de vérification vous a été envoyé afin de terminer votre inscription. Merci.</h3><br>");
        setTimeout(function() {
         // window.location.href = "https://miramas-écologie.fr/connexion";
         window.location.href = "http://localhost/miramas-ecologie-mvc/connexion";
        }, 5000);
      </script>';

     } else {
      echo  '<script language="javascript">
        document.write("<br><h3 style=\'color:red\'>Je suis désolé, mais l\'email n\'a pu aboutir. Veuillez réessayer ultérieurement. Merci.</h3><br>");
        setTimeout(function() {
         // window.location.href = "https://miramas-écologie.fr/connexion-utilisateur/Titre-pro-se-connecter.php";
         window.location.href = "http://localhost/miramas-ecologie-mvc/connexion";
        }, 5000);
      </script>'; ;

  $stmt->close();
  mysqli_close($connexion);

}
}
