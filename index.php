<?php 

require ("./vendor/autoload.php");
$authorized_pages = [
    'accueil' => 'accueil',
    'carte' => 'carte',
    'dons' => 'dons',
    'qui-suis-je' => 'qui-suis-je',
    'contact' => 'contact',
    'biodiversite' => 'biodiversite',
    'sobriete-energetique' => 'sobriete-energetique',
    'economie-circulaire' => 'economie-circulaire',
    'connexion' => 'connexion',
    'inscription' => 'inscription',
    'confirmation' => 'confirmation',
    'modifier-l-annonce' => 'modifier-l-annonce',
    'deposer-une-annonce' => 'deposer-une-annonce',
];

$route = $_GET['page'] ?? 'accueil';

if(array_key_exists($route, $authorized_pages)) {
    require 'views/pages/'. $authorized_pages[$route] . '.view.php';
}

// if(empty($_GET['page'])){
//     require 'views/pages/accueil.view.php';
    
// }else{
//   switch($_GET['page']){
//         case "accueil" : require 'views/pages/accueil.view.php';
//         break;
//         case "carte" : require 'views/pages/carte.view.php';
//         break;
//         case "dons" : require 'views/pages/dons.view.php';
//         break;
//         case "qui-suis-je" : require 'views/pages/qui-suis-je.view.php';
//         break;
//         case "contact" : require 'views/pages/contact.view.php';
//         break;
//         case "biodiversite" : require 'views/pages/biodiversite.view.php';
//         break;
//         case "sobriete-energetique" : require 'views/pages/sobriete-energetique.view.php';
//         break;
//         case "economie-circulaire" : require 'views/pages/economie-circulaire.view.php';
//         break;
//         case "connexion" : require 'views/pages/connexion.view.php';
//         break;
//         case "inscription" : require 'views/pages/inscription.view.php';
//         break;
//         case "confirmation" : require 'views/pages/confirmation.view.php';
//         break;
//         case "modifier-l-annonce" : require 'views/pages/modifier-l-annonce.view.php';
//         break;
//         case "deposer-une-annonce" : require 'views/pages/deposer-une-annonce.view.php';
//         break;
//         //case "ajout" : require 'views/ajout.view.php';
//         //break;
//   }
// }

require('./models/contact.mailer.php');