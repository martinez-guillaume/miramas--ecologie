<?php

session_start();

include ('./models/config.php');

//vérifie si les champs "email" et "password" du formulaire de connexion ne sont pas vides 
if (!empty($_POST['email']) && !empty($_POST['password'])) {

    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $connexion->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $password_verified = false;
    foreach ($results as $row) {
        // Vérifie si le mot de passe soumis correspond à un mot de passe haché dans la base de données
        // Vérifie également la correspondance de l'e-mail et la vérification de l'état de confirmation de l'utilisateur
        if (password_verify($password, $row['password']) && ($email == $row['email']) && ($row['confirme'] == 1)) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['id'] = $row['id'];

            // mettre la variable à true si le mot de passe est vérifié
            $password_verified = true;

            header('Refresh:0; http://localhost/miramas-ecologie-mvc');

            exit();
        }
    }

    // afficher le message d'erreur si la variable est toujours à false
    if (!$password_verified) {
        echo '<script language="javascript">
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Vous devez d\'abord vous inscrire s\'il vous plaît! Une fois l\'inscription faite, veuillez vérifier votre boîte mail et cliquer sur le lien de confirmation qui vous a été envoyé pour activer votre compte.",
                showConfirmButton: false,
                timer: 3000
            });
            setTimeout(function() {
                window.location.href = "http://localhost/miramas-ecologie-mvc/connexion";
            }, 3000);
        </script>';
    }
}

$connexion = null;
