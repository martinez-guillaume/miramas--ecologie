<?php
       
       include ('../config/config.php');
      
     // Vérifie si les paramètres 'username' et 'key' sont définis dans la requête GET et s'ils ne sont pas vides
      
     if(isset($_GET['username'], $_GET['key']) AND !empty($_GET['username']) AND !empty($_GET['key'])){
         $username = htmlspecialchars(urldecode($_GET['username']));
         $key = htmlspecialchars($_GET['key']);
           
     // Prépare la requête SQL pour sélectionner l'utilisateur avec le nom d'utilisateur et la clé de confirmation correspondants
         
         $requser = $connexion->prepare("SELECT * FROM users WHERE username = ? AND confirmkey = ?");
         $requser->bind_param("ss", $username ,$key);
         $requser->execute();
       $requser->store_result();
     
          $userexist = $requser->num_rows;
     
        
         if($userexist == 1){
             
             $user = $requser->fetch();
             
             // Vérifie si le compte de l'utilisateur n'à pas encore été confirmé
           
             if($user['confirme'] == 0){
         
              $updateuser = $connexion->prepare("UPDATE users SET confirme = 1 WHERE username = ? AND confirmkey = ?");
              $updateuser->bind_param("ss", $username ,$key);
              $updateuser->execute();
                    
           echo '<script language="javascript">
           document.write("<h3 style=\'color: green; margin-bottom: 10%; margin-top: 4%;\'>Félicitations , Votre compte a bien été confirmé !</h3>");
       
           setTimeout(function() {
             window.location.href = "https://miramas-écologie.fr/connexion-utilisateur/Titre-pro-se-connecter.php";
           }, 4000);
         </script>';
     
         
     
         
             }else{
                 
                  echo '<script language="javascript">
           document.write("<h3 style=\'color: red; margin-bottom: 10%; margin-top: 4%;\'>Votre compte a déja été confirmé !</h3>");
       
           setTimeout(function() {
             window.location.href = "https://miramas-écologie.fr";
           }, 4000);
         </script>';
             }
         }else{
                 echo '<script language="javascript">
           document.write("<h3 style=\'color: red; margin-bottom: 10%; margin-top: 4%;\'>L\'utilisateur n\'existe pas !</h3>");
       
           setTimeout(function() {
             window.location.href = "https://miramas-écologie.fr";
           }, 4000);
         </script>';
         }
     }
     $requser->close(); 
     $connexion->close(); 
     
     ?>