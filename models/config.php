<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "miramas-ecologie";

 
// Création de la connexion PDO
try {
    $connexion = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
     // Crée une instance de la classe PDO pour se connecter à la base de données
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    // Configure le mode de gestion des erreurs pour afficher les exceptions
} catch (PDOException $e) {
    die("La connexion a échoué : " . $e->getMessage()); 
   
}

