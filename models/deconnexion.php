<?php

session_start();
// supprime toutes les variables de session. Elle est utilisée pour vider les données stockées dans la session.
session_unset();
//détruit la session en cours. Elle supprime toutes les données de session existantes.
session_destroy();
// header('Refresh:0;https://xn--miramas-cologie-inb.fr/index.php');

header('Refresh:0;https://xn--miramas-cologie-inb.fr');
?>