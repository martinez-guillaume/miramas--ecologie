<?php

session_start();
    
    // Vérification si les champs email, subject, name et message sont remplis
if (!empty($_POST['email']) && !empty($_POST['subject']) && !empty($_POST['name']) && !empty($_POST['message'])){
    $secret = "6Lf7YFYmAAAAAMwCKNUqVUtVScNW6BhmXYzjlvMZ";
    $response = htmlspecialchars($_POST['g-recaptcha-response']);
    $remoteip = $_SERVER['REMOTE_ADDR'];
    // URL de requête pour vérifier le reCAPTCHA
    $request = "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip";
    $get = file_get_contents($request);
    $decode = json_decode($get,true);
    
    if($decode['success'])
   
    

    if (empty($_POST['name']) || empty($_POST['subject']) || empty($_POST['email']) || empty($_POST['message'])) {
           // Si l'un des champs requis est vide, redirection vers la page de contact
        echo '<script language="javascript">
            setTimeout(function() {
                window.location.href = "https://xn--miramas-cologie-inb.fr/contact/Titre-pro-contact.php";
            }, 1000);
        </script>';
        return;
    } elseif (strlen($_POST['name']) > 255 || strlen($_POST['subject']) > 255 || strlen($_POST['email']) > 255 || strlen($_POST['message']) > 255) {
                // Si la longueur des champs dépasse 255 caractères, redirection vers la page de contact
        echo '<script language="javascript">
            setTimeout(function() {
                window.location.href = "https://xn--miramas-cologie-inb.fr/contact/Titre-pro-contact.php";
            }, 1000);
        </script>';
        return;
    } else {
       // Envoi du message par e-mail
          ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );
    $from = "https://miramas-écologie.fr";
    $to = "guillaume.m.developer@gmail.com";
    $subject = $_POST['subject'];
    $message = " adresse mail : ". $_POST['email'] . "  nom de la personne : " . $_POST['name'] . "  message : " . $_POST['message'];
    $mail = $_POST['email'];
    $headers = "De :" . $from;
   
    
     if (mail($to, $subject, $message, $headers)) {
    echo '<script language="javascript">
                document.write("<br><h3 style=color:green>Message envoyé avec succès...</h3>");
                setTimeout(function() {
                    window.location.href = "https://xn--miramas-cologie-inb.fr";
                }, 3000);
            </script>';
        } 
        
        
        else {
            echo "Le message n'a pas pu être envoyé...";
        }
    }

}

?>
