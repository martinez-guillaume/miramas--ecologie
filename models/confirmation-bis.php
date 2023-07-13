<?php

include('./models/config.php');

if (isset($_GET['username'], $_GET['key']) && !empty($_GET['username']) && !empty($_GET['key'])) {
  $username = htmlspecialchars(urldecode($_GET['username']));
  $key = htmlspecialchars($_GET['key']);

  $requser = $connexion->prepare("SELECT * FROM users WHERE username = :username AND confirmkey = :key");
  $requser->bindParam(':username', $username);
  $requser->bindParam(':key', $key);
  $requser->execute();
  $userexist = $requser->rowCount();

  if ($userexist == 1) {
    $user = $requser->fetch();

    if ($user['confirme'] == 0) {
      $updateuser = $connexion->prepare("UPDATE users SET confirme = 1 WHERE username = :username AND confirmkey = :key");
      $updateuser->bindParam(':username', $username);
      $updateuser->bindParam(':key', $key);
      $updateuser->execute();

      echo '<script language="javascript">
          document.write("<h3 style=\'color: green; margin-bottom: 10%; margin-top: 4%; text-align: center;\'>Félicitations!<br>Votre compte a bien été confirmé !</h3>");
          setTimeout(function() {
            window.location.href = "http://localhost/miramas-ecologie-mvc/connexion";
          }, 4000);
        </script>';
    } else {
      echo '<script language="javascript">
          document.write("<h3 style=\'color: red; margin-bottom: 10%; margin-top: 4%;\'>Votre compte a déjà été confirmé !</h3>");
          setTimeout(function() {
            window.location.href = "http://localhost/miramas-ecologie-mvc";
          }, 4000);
        </script>';
    }
  } else {
    echo '<script language="javascript">
          document.write("<h3 style=\'color: red; margin-bottom: 10%; margin-top: 4%;\'>L\'utilisateur n\'existe pas !</h3>");
          setTimeout(function() {
            window.location.href = "http://localhost/miramas-ecologie-mvc";
          }, 4000);
        </script>';
  }
}

$connexion = null;

?>
