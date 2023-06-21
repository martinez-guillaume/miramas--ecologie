<?php


session_start();

use PHPMailer\PHPMailer\PHPMailer;

include ('./models/config.php');



if (isset($_POST['submit'])) {

  $email = $_POST["email"];
  $username = $_POST['username'];
  $password = $_POST["password"];

  // Vérifier si l'e-mail existe déjà
  $stmt = $connexion->prepare("SELECT email FROM users WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $stmt->store_result();

  if ($stmt->num_rows > 0) {
     echo '<script language="javascript">
                 Swal.fire({
                 icon: "error",
                 title: "Oops...",
                 text: "Cet email est déjà utilisé, veuillez en choisir un autre s\'il vous plaît !",
                 showConfirmButton: false,
                 timer: 5000
                 });
                 setTimeout(function() {
                         window.location.href = "https://xn--miramas-cologie-inb.fr/inscription";
                    }, 5000);
                </script>';
                 return;
  }

  // Vérifier si le nom d'utilisateur existe déjà
  $stmt = $connexion->prepare("SELECT username FROM users WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $stmt->store_result();

  if ($stmt->num_rows > 0) {
  echo '<script language="javascript">
                 Swal.fire({
                 icon: "error",
                 title: "Oops...",
                 text: "Ce nom d\'utilisateur est déjà utilisé, veuillez en choisir un autre s\'il vous plaît !",
                 showConfirmButton: false,
                 timer: 5000
                 });
                 setTimeout(function() {
                         window.location.href = "https://xn--miramas-cologie-inb.fr/inscription";
                    }, 5000);
                </script>';
                 return;
    
  }

  // Hash du mot de passe
  $passwordHash = password_hash($password, PASSWORD_BCRYPT);

  //   // l'envoi vers la bdd

  if (empty($_POST['email'])|| empty($_POST['password'])|| empty($_POST['username'])){

     header("Location: https://xn--miramas-cologie-inb.fr");

    exit();

   } elseif (strlen($_POST['password']) > 255 || strlen($_POST['username'])>255 || strlen($_POST['email']) > 255) {

    header("Location: https://xn--miramas-cologie-inb.fr");

    exit();
    
  } 
  
  // Génération d'une clé de confirmation aléatoire
  $longueurKey = "15";
  $key="";
  
  for($i=1; $i<$longueurKey; $i++){
      $key .= mt_rand(0,9);
  }

  $stmt = $connexion->prepare("INSERT INTO users (username, email, password, confirmkey) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("ssss", $username, $email, $passwordHash, $key);
  $stmt->execute();

  // Configuration des en-têtes pour l'e-mail de confirmation

    //   ini_set( 'display_errors', 1 );
    //      error_reporting( E_ALL );


              $message = '
<html>
<body>
<div align="center">
<p>Bonjour ,<br>
Félicitations et Merci de vous être inscrit sur notre site. Nous sommes ravis de vous accueillir parmi nous.<br>
Veuillez cliquer sur le lien ci-dessous pour confirmer votre adresse e-mail : <br></p>
<a href="https://miramas-écologie.fr/confirmation?username='.urlencode($username).'&key='.$key.'">Confirmez votre compte !</a>
<p>Si vous avez des questions ou des préoccupations, notre équipe est là pour vous aider.<br>
Cordialement,<br>
Miramas-écologie</p>
</div>
</body>     
</html>
';

                function envoie_mail($from_name, $from_email, $subject, $message) {
                    $mail = new PHPMailer(true); //on creer un objet phpmailer pour utiliser ses attributs et methodes
                    try {
                        $mail->isSMTP();
                        $mail->SMTPDebug = 0;
                        $mail->SMTPSecure = 'ssl';
                        $mail->Host = 'smtp.hostinger.com'; //le serveur smtp de gmail
                        $mail->SMTPAuth = true;
                        $mail->Username = "support@xn--miramas-cologie-inb.fr"; //mail->permet d'acceder a l'attribut username de l'objet creer ( c'est le mail qui vas nous aider a envoyer des mail)
                        $mail->Password = "Martine6714@"; //mot de passe pour passer la double authentification
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //permet de crypter le message
                        $mail->Port = 465; // le port

                        $mail->setFrom("support@xn--miramas-cologie-inb.fr", "Miramas ecologie"); //le message est envoyer par $from_email, et son nom $from_name
                        $mail->addAddress($_POST['email'] );
                        $mail->isHTML(true); // le message peut être au format HTML
                        $mail->Subject = "Inscription";
                        $mail->Body = $message;
                        $mail->setLanguage('fr', '/optional/path/to/language/directory/'); //pour charger la version française
                    //pour envoyer le message on va utiliser la méthode send
                    if ($mail->send()) {
                        return true;
                    } else {
                        return false;
                    }
                } catch (Exception $e) {
                    // Afficher l'erreur en cas d'échec de l'envoi
                    print_r($e);
                    die();
                    return false;
                }
            }

            if (envoie_mail($_POST['username'], $_POST['email'], $_POST['password'],  $message)) {

    echo '<script language="javascript">
                Swal.fire({
                icon: "success",
                title: "Félicitations!",
                text: " Un e-mail avec un lien de vérification vous a été envoyé afin de terminer votre inscription. Merci.",
                showConfirmButton: false,
                timer: 6000
                });
                setTimeout(function() {
                         window.location.href = "https://xn--miramas-cologie-inb.fr";
                    }, 6000);
                </script>';

 
            } else {
                //sinon écrire une erreur
                // echo $e->ErrorInfo;
       echo '<script language="javascript">
                 Swal.fire({
                 icon: "error",
                 title: "Oops...",
                 text: "Je suis désolé, mais l\'email n\'a pu aboutir. Veuillez réessayer ultérieurement. Merci.",
                 showConfirmButton: false,
                 timer: 6000
                 });
                 setTimeout(function() {
                         window.location.href = "https://xn--miramas-cologie-inb.fr/inscription";
                    }, 6000);
                </script>';
            }
        }
   