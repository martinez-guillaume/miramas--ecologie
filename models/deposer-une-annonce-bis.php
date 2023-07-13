<?php

session_start();

include ('./models/config.php');

if (isset($_POST['submit'])) {
    
    // Vérification si l'utilisateur est connecté
    if (!isset($_SESSION['username'])) {
        header("Location: https://miramas-écologie.fr");
        exit();
    }

    date_default_timezone_set('Europe/Paris');
    $title = $_POST['title'];
    $description = $_POST["description"];
    $date = date('Y-m-d H:i:s');

    // start image upload
    $target_dir = dirname(__FILE__, 2) . DIRECTORY_SEPARATOR . "public". DIRECTORY_SEPARATOR . "image" . DIRECTORY_SEPARATOR;
    $uploadedFileName = uniqid(rand(), true) . '_' .basename($_FILES["picture"]["name"]);
    $target_file = $target_dir . $uploadedFileName;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file already exists
    if (file_exists($target_file)) {
        echo '<script language="javascript">
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Désolé, le fichier existe déjà.",
                showConfirmButton: false,
                timer: 3000
            });
            setTimeout(function() {
                window.location.href = "https://xn--miramas-cologie-inb.fr/deposer-une-annonce";
            }, 3000);
        </script>';
        $uploadOk = 0;
    }

    // Allow certain file formats
    $allowedExtensions = ["jpg", "png", "jpeg", "gif", "webp", "jfif"];
    if (!in_array($imageFileType, $allowedExtensions)) {
        echo '<script language="javascript">
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Désolé, seuls les fichiers JPG, JPEG, PNG, GIF, JFIF, WEBP sont acceptés.",
                showConfirmButton: false,
                timer: 5000
            });
            setTimeout(function() {
                window.location.href = "https://xn--miramas-cologie-inb.fr/deposer-une-annonce";
            }, 2100);
        </script>';
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo '<script language="javascript">
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Désolé, votre fichier n\'a pas été téléchargé.",
                showConfirmButton: false,
                timer: 5000
            });
            setTimeout(function() {
                window.location.href = "https://xn--miramas-cologie-inb.fr/deposer-une-annonce";
            }, 2100);
        </script>';
    } else {
        if (!move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
            echo '<script language="javascript">
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Désolé, une erreur s\'est produite lors du téléchargement de votre fichier.",
                    showConfirmButton: false,
                    timer: 5000
                });
                setTimeout(function() {
                    window.location.href = "https://xn--miramas-cologie-inb.fr/deposer-une-annonce";
                }, 2100);
            </script>';
        } else {
            // end image upload

            if (empty($title) || empty($uploadedFileName) || empty($description)) {
                header("Location: https://xn--miramas-cologie-inb.fr/deposer-une-annonce");
                exit;
            } elseif (strlen($title) > 255 || strlen($description) > 255) {
                header("Location: https://xn--miramas-cologie-inb.fr/deposer-une-annonce");
                exit;
            } else {
                try {
                    $stmt = $connexion->prepare("INSERT INTO announcement (user_id, title, picture, description, date_publication) VALUES (?, ?, ?, ?, ?)");
                    $stmt->execute([$_SESSION['id'], $title, $uploadedFileName, $description, $date]);

                    echo '<script language="javascript">
                        Swal.fire({
                            icon: "success",
                            title: "Félicitations!",
                            text: " Votre annonce a été enregistrée avec succès. Elle sera bientôt publiée en ligne. Merci.",
                            showConfirmButton: false,
                            timer: 3000
                        });
                        setTimeout(function() {
                            window.location.href = "https://xn--miramas-cologie-inb.fr/dons";
                        }, 2100);
                    </script>';
                } catch (PDOException $e) {
                    echo '<script language="javascript">
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Une erreur s\'est produite lors de l\'enregistrement de l\'annonce. Veuillez vérifier les informations que vous avez saisies.",
                            showConfirmButton: false,
                            timer: 3000
                        });
                        setTimeout(function() {
                            window.location.href = "https://xn--miramas-cologie-inb.fr/deposer-une-annonce";
                        }, 3000);
                    </script>';
                }
            }
        }
    }

    $stmt = null;
}

$connexion = null;
