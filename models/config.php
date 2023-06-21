<?php

$servername = "";
$username = "u897624032_guillaumemart";
$password = "Martine6714@";
$dbname = "u897624032_miramas1384";

$connexion = mysqli_connect($servername, $username, $password, $dbname);

// Vérification de la connexion
if (!$connexion) {
    die("La connexion a échoué : " . mysqli_connect_error());
  }

?>