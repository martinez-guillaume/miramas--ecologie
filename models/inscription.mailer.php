<?php

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include ('./models/config.php');

if (isset($_POST['submit'])) {

    $email = $_POST["email"];
    $username = $_POST['username'];
    $password = $_POST["password"];

    // Vérifier si l'e-mail existe déjà
    $stmt = $connexion->prepare("SELECT email FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $result = $stmt->fetch();

    if ($result) {
        echo '<script language="javascript">
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Cet email est déjà utilisé, veuillez en choisir un autre s\'il vous plaît !",
                showConfirmButton: false,
                timer: 5000
            });
            setTimeout(function() {
                window.location.href = "http://localhost/miramas-ecologie-mvc/inscription";
            }, 5000);
        </script>';
        return;
    }

    // Vérifier si le nom d'utilisateur existe déjà
    $stmt = $connexion->prepare("SELECT username FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $result = $stmt->fetch();

    if ($result) {
        echo '<script language="javascript">
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Ce nom d\'utilisateur est déjà utilisé, veuillez en choisir un autre s\'il vous plaît !",
                showConfirmButton: false,
                timer: 5000
            });
            setTimeout(function() {
                window.location.href = "http://localhost/miramas-ecologie-mvc/inscription";
            }, 5000);
        </script>';
        return;
    }

    // Hash du mot de passe
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    if (empty($_POST['email']) || empty($_POST['password']) || empty($_POST['username'])) {
        header("Location: https://xn--miramas-cologie-inb.fr");
        exit();
    } elseif (strlen($_POST['password']) > 255 || strlen($_POST['username']) > 255 || strlen($_POST['email']) > 255) {
        header("Location: https://xn--miramas-cologie-inb.fr");
        exit();
    }

    // Génération d'une clé de confirmation aléatoire
    $longueurKey = "15";
    $key = "";

    for ($i = 1; $i < $longueurKey; $i++) {
        $key .= mt_rand(0, 9);
    }

    $stmt = $connexion->prepare("INSERT INTO users (username, email, password, confirmkey) VALUES (?, ?, ?, ?)");
    $stmt->execute([$username, $email, $passwordHash, $key]);

    // Configuration des en-têtes pour l'e-mail de confirmation
    $message = '
        <html>
        <body>
        <div align="center">
        <p>Bonjour ,<br>
        Félicitations et Merci de vous être inscrit sur notre site. Nous sommes ravis de vous accueillir parmi nous.<br>
        Veuillez cliquer sur le lien ci-dessous pour confirmer votre adresse e-mail : <br></p>
        <a href="https://miramas-écologie.fr/confirmation?username=' . urlencode($username) . '&key=' . $key . '">Confirmez votre compte !</a>
        <p>Si vous avez des questions ou des préoccupations, notre équipe est là pour vous aider.<br>
        Cordialement,<br>
        Miramas-écologie</p>
        </div>
        </body>     
        </html>
    ';

    function envoie_mail($from_name, $from_email, $subject, $message) {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->SMTPDebug = 0;
            $mail->SMTPSecure = 'ssl';
            $mail->Host = 'smtp.hostinger.com';
            $mail->SMTPAuth = true;
            $mail->Username = "support@xn--miramas-cologie-inb.fr";
            $mail->Password = "Martine6714@";
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            $mail->setFrom("support@xn--miramas-cologie-inb.fr", "Miramas ecologie");
            $mail->addAddress($_POST['email']);
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = "Inscription";
            $mail->Body = $message;
            $mail->setLanguage('fr', '/optional/path/to/language/directory/');
            $mail->addCustomHeader("Content-Type: text/html; charset=UTF-8");

            if ($mail->send()) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            print_r($e);
            die();
            return false;
        }
    }

    if (envoie_mail($_POST['username'], $_POST['email'], $_POST['password'], $message)) {
        echo '<script language="javascript">
            Swal.fire({
                icon: "success",
                title: "Félicitations!",
                text: " Un e-mail avec un lien de vérification vous a été envoyé afin de terminer votre inscription. Merci.",
                showConfirmButton: false,
                timer: 6000
            });
            setTimeout(function() {
                window.location.href = "http://localhost/miramas-ecologie-mvc";
            }, 6000);
        </script>';
    } else {
        echo '<script language="javascript">
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Je suis désolé, mais l\'email n\'a pu aboutir. Veuillez réessayer ultérieurement. Merci.",
                showConfirmButton: false,
                timer: 6000
            });
            setTimeout(function() {
                window.location.href = "http://localhost/miramas-ecologie-mvc/inscription";
            }, 6000);
        </script>';
    }
}

$connexion = null;
