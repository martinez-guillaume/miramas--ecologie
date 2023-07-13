<?php

session_start();

include ('./models/config.php');

$sql = "SELECT * FROM announcement WHERE id_announcement = ?";
$stmt = $connexion->prepare($sql);
$stmt->execute([$_GET['id']]);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$title = "";
$description = "";

if (count($results) > 0) {
    // Vérification si des résultats ont été retournés par la requête
    $row = $results[0];
    $title = $row['title'];
    $description = $row['description'];
}

if (isset($_POST['submit'])) {

    // Vérification si l'utilisateur est connecté
    if (!isset($_SESSION['username'])) {
        header("Location: http://localhost/miramas-ecologie-mvc");
        exit;
    }

    date_default_timezone_set('Europe/Paris');

    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = date('Y-m-d H:i:s');

    $announcement_id = $_GET['id'];

    // start image upload
    $target_dir = dirname(__FILE__, 2) . DIRECTORY_SEPARATOR . "public" . DIRECTORY_SEPARATOR . "image" . DIRECTORY_SEPARATOR;
    $uploadedFileName = uniqid(rand(), true) . '_' . basename($_FILES["picture"]["name"]);
    $target_file = $target_dir . $uploadedFileName;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Désolé, le fichier existe déjà.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" && $imageFileType != "webp" && $imageFileType != "jfif"
    ) {
        echo '<script language="javascript">
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Désoler, seuleument JPG, JPEG, PNG , JFIF , WEBP & GIF fichiers sont acceptés.",
                showConfirmButton: false,
                timer: 5000
            });
            setTimeout(function() {
                window.location.href = "http://localhost/miramas-ecologie-mvc/modifier-l-annonce";
            }, 5000);
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
                timer: 3500
            });
            setTimeout(function() {
                window.location.href = "http://localhost/miramas-ecologie-mvc/modifier-l-annonce";
            }, 3500);
        </script>';
    } else {
        if (!move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
            echo '<script language="javascript">
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Désolé, une erreur s\'est produite lors du téléchargement de votre fichier.",
                    showConfirmButton: false,
                    timer: 3500
                });
                setTimeout(function() {
                    window.location.href = "http://localhost/miramas-ecologie-mvc/modifier-l-annonce";
                }, 3500);
            </script>';
        } else {

            // end image upload

            if (empty($title) || empty($uploadedFileName) || empty($description)) {
                header("Location: https://xn--miramas-cologie-inb.fr");
                exit;
            } elseif (strlen($title) > 255 || strlen($description) > 255) {
                header("Location: https://xn--miramas-cologie-inb.fr");
                exit;
            } else {
                $sql_update = "UPDATE announcement SET title=?, picture=?, description=?, date_publication=? WHERE id_announcement=?";
                $stmt = $connexion->prepare($sql_update);
                $stmt->execute([$title, $uploadedFileName, $description, $date, $announcement_id]);
            }

            // Exécution de la requête de mise à jour
            if ($stmt->execute()) {
                echo '<script language="javascript">
                    Swal.fire({
                        icon: "success",
                        title: "Félicitations!",
                        text: "Félicitations ! Votre annonce a bien été modifier . Elle sera bientôt publiée en ligne. Merci",
                        showConfirmButton: false,
                        timer: 3000
                    });
                    setTimeout(function() {
                        window.location.href = "http://localhost/miramas-ecologie-mvc/dons";
                    }, 3000);
                </script>';
            } else {
                echo '<script language="javascript">
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Une erreur s\'est produite lors de la modification de l\'annonce . Veuillez vérifier les informations que vous avez saisies.",
                        showConfirmButton: false,
                        timer: 3000
                    });
                    setTimeout(function() {
                        window.location.href = "http://localhost/miramas-ecologie-mvc/modifier-l-annonce";
                    }, 3000);
                </script>';
            }
        }
    }
}

$connexion = null;

?>
