<?php



    //   ini_set( 'display_errors', 1 );
    //      error_reporting( E_ALL );

    // session_start();
    
    use PHPMailer\PHPMailer\PHPMailer;
            
    // Vérification si les champs email, subject, name et message sont remplis
    if (!empty($_POST['email']) && !empty($_POST['subject']) && !empty($_POST['name']) && !empty($_POST['message'])){
        // $secret = "";
        // $response = htmlspecialchars($_POST['g-recaptcha-response']);
        // $remoteip = $_SERVER['REMOTE_ADDR'];
        // // URL de requête pour vérifier le reCAPTCHA
        // $request = "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip";
        // $get = file_get_contents($request);
        // $decode = json_decode($get, true);

        // if ($decode['success']) {

            if (empty($_POST['name']) || empty($_POST['subject']) || empty($_POST['email']) || empty($_POST['message'])) {
                // Si l'un des champs requis est vide, redirection vers la page de contact
               header("Location: https://xn--miramas-cologie-inb.fr/contact/Titre-pro-contact.php");
               exit;
            } elseif (strlen($_POST['name']) > 255 || strlen($_POST['subject']) > 255 || strlen($_POST['email']) > 255 || strlen($_POST['message']) > 255) {
               header("Location: https://xn--miramas-cologie-inb.fr/contact/Titre-pro-contact.php");
               exit;
            } else {
                $message = "<br><br>adresse mail : " . $_POST['email'] . "<br>nom : " . $_POST['name'];

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

                        $mail->setFrom("support@xn--miramas-cologie-inb.fr", $from_name); //le message est envoyer par $from_email, et son nom $from_name
                        $mail->addAddress('guillaume.m.developer@gmail.com', 'GuillaumeTech');
                        $mail->isHTML(true); // le message peut être au format HTML
                        $mail->Subject = $subject;
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

            if (envoie_mail($_POST['name'], $_POST['email'], $_POST['subject'], $_POST['message'] . $message)) {
                echo '<script language="javascript">
                Swal.fire({
                icon: "success",
                title: "Félicitations!",
                text: "Votre message a été envoyé avec succès.",
                showConfirmButton: false,
                timer: 1800
                });
                setTimeout(function() {
                         window.location.href = "https://xn--miramas-cologie-inb.fr";
                    }, 1800);
                </script>';
            } else {
                //sinon écrire une erreur
                // echo $e->ErrorInfo;
                 echo '<script language="javascript">
                 Swal.fire({
                 icon: "error",
                 title: "Oops...",
                 text: "Je suis désolé, mais l\'email  n\'a pu aboutir. Veuillez réessayer ultérieurement. Merci..",
                 showConfirmButton: false,
                 timer: 1800
                 });
                 setTimeout(function() {
                         window.location.href = "https://xn--miramas-cologie-inb.fr";
                    }, 1800);
                </script>';
          
            }
        }
    }
//}

