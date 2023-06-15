<?php

session_start();


if (isset($_POST['depot_annonce'])) {
  if (isset($_SESSION['username'])) {
    // utilisateur connecté 
    header('Location: http://localhost/miramas-ecologie-mvc/deposer-une-annonce');
    exit;
  } else {
    echo "<br><h3 style=color:red; text-align:center;>Vous devez vous connectez pour déposer une annonce!</h3>";
    echo '<script language="javascript">



    setTimeout(function() {

      window.location.href = "http://localhost/miramas-ecologie-mvc/connexion";
     
    }, 4000);
    
    </script>';
    
   return; 
   
  } 
}

 

?>