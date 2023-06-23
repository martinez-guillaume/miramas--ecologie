<?php

$servername = "";
$username = "";
$password = "";
$dbname = "miramas-ecologie";

$connexion = mysqli_connect($servername, $username, $password, $dbname);

// Vérification de la connexion
if (!$connexion) {
    die("La connexion a échoué : " . mysqli_connect_error());
  }

?>