<?php

session_start();


if (isset($_POST['depot_annonce'])) {
  if (isset($_SESSION['username'])) {
    // utilisateur connecté 
    header('Location: https://xn--miramas-cologie-inb.fr/deposer-une-annonce');
    exit;
  } else {
   header('Location: https://xn--miramas-cologie-inb.fr/connexion');
    exit; 
  } 
}

 

?>