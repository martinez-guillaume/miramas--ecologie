<?php

session_start();


if (isset($_POST['depot_annonce'])) {
  if (isset($_SESSION['username'])) {
    // utilisateur connecté 
    header('Location: http://localhost/miramas-ecologie-mvc/deposer-une-annonce');
    exit;
  } else {
   header('Location: http://localhost/miramas-ecologie-mvc/connexion');
    exit; 
  } 
}

 

?>