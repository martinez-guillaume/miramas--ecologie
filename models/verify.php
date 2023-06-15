<?php


    session_start();

//vérifie si les champs "email" et "password" du formulaire de connexion ne sont pas vides 
if (!empty($_POST['email']) && !empty($_POST['password'])){
    // $secret = "6Lf7YFYmAAAAAMwCKNUqVUtVScNW6BhmXYzjlvMZ";
    // $response = htmlspecialchars($_POST['g-recaptcha-response']);
    // $remoteip = $_SERVER['REMOTE_ADDR'];
    // //vérification du reCAPTCHA en envoyant une requête à l'API de Google reCAPTCHA 
    // $request = "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip";
    
    // $get = file_get_contents($request);
    // $decode = json_decode($get,true);
    
    // if($decode['success'])

include ('./models/config.php');

    $email = $_POST["email"];
    $password = $_POST["password"];
   
  
    $sql = "select * from users";
    $results = $connexion->query($sql);


    $password_verified = false;
    if ($results->num_rows > 0) { 
        while ($row = $results->fetch_assoc()) { 
        // Vérifie si le mot de passe soumis correspond à un mot de passe haché dans la base de données
        // Vérifie également la correspondance de l'e-mail et la vérification de l'état de confirmation de l'utilisateur
            if (password_verify($password, $row['password']) && ($email == $row['email']) && ($row['confirme'] == 1)) {
                $_SESSION['username']=$row['username'];
                $_SESSION['email']=$row['email'];
                $_SESSION['id']=$row['id'];
               
               
                // mettre la variable à true si le mot de passe est vérifié
                $password_verified = true;
               
               
            //    header('Refresh:0; https://xn--miramas-cologie-inb.fr/index.php');
               header('Refresh:0; http://localhost/miramas-ecologie-mvc/accueil');
               exit();
            }
        }
    }
    // afficher le message d'erreur si la variable est toujours à false
    if (!$password_verified) { 
         echo '<script language="javascript">
      document.write("<h3 style=color:red>Vous devez d\'abord vous inscrire s\'il vous plaît !<br>Une fois l\'inscription faite, veuillez vérifier votre boîte mail et cliquer sur le lien de confirmation qui vous a été envoyé pour activer votre compte.</h3>");
  
      setTimeout(function() {
     // window.location.href = "https://xn--miramas-cologie-inb.fr/connexion-utilisateur/Titre-pro-se-connecter.php";
     window.location.href = "http://localhost/miramas-ecologie-mvc/connexion";
      }, 8000);
    </script>';
    }
    

mysqli_close($connexion);
}


    




