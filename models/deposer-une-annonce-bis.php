<?php

session_start();


include ('./models/config.php');

if (isset($_POST['submit'])) {
    
 // Vérification si l'utilisateur est connecté
  if (!isset($_SESSION['username'])) {
    echo "<div class=container-green-text><p class=red-text-reservation>Vous devez être connecté pour déposer une annonce !</p></div>";
    exit();
  }

 date_default_timezone_set('Europe/Paris');

  $title = $_POST['title'];
  $description = $_POST["description"];
  $date = date('Y-m-d h:i:s');

    // start image upload
$target_dir = dirname(__FILE__, 2) . DIRECTORY_SEPARATOR . "public". DIRECTORY_SEPARATOR . "image" . DIRECTORY_SEPARATOR;
$uploadedFileName = uniqid(rand(), true) . '_' .basename($_FILES["picture"]["name"]);
$target_file = $target_dir . $uploadedFileName;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));



// Check if file already exists
if (file_exists($target_file)) {
  echo "Désolé, le fichier existe déjà.";
  $uploadOk = 0;
}


// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" && $imageFileType != "webp" && $imageFileType != "jfif" ) {
  echo "Désoler, seuleument JPG, JPEG, PNG , GIF , JFIF , WEBP fichiers sont acceptés.";
  $uploadOk = 0;
}


// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Désolé, votre fichier n'a pas été téléchargé.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
    echo "The file " . htmlspecialchars($uploadedFileName) . " has been uploaded.";
  } else {
    echo "Désolé, une erreur s'est produite lors du téléchargement de votre fichier.";
  }
}


// end image upload



  if (empty($title) || empty($uploadedFileName) || empty($description)) {
      // Vérification si les champs titre, image et description sont vides
    echo '<script language="javascript">
      setTimeout(function() {
        // window.location.href = "http://localhost/miramas-ecologie-mvc/deposer-une-annonce";
       // window.location.href = "";
      }, 1000);
    </script>';
    return;
  } elseif (strlen($title) > 255 || strlen($description) > 255) {
        // Vérification si la longueur des champs titre et description dépasse 255 caractères
    echo '<script language="javascript">
      setTimeout(function() {
        // window.location.href = "https://xn--miramas-cologie-inb.fr/deposer-une-annonce/Titre-pro-deposer-une-annonce.php";
  
       // window.location.href = " http://localhost/miramas-ecologie-mvc/deposer-une-annonce";
      }, 1000);
    </script>';
    return;
  } else {
    // Préparation de la requête SQL en utilisant une déclaration préparée
    $stmt = $connexion->prepare("INSERT INTO announcement (user_id, title, picture, description, date_publication) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $_SESSION['id'], $title, $uploadedFileName, $description, $date);

    if ($stmt->execute()) {
      echo '<script language="javascript">
        document.write("<br><h3 style=color:green>Félicitations ! Votre annonce a été enregistrée avec succès. Elle sera bientôt publiée en ligne. Merci.</h3>");
        setTimeout(function() {
      //    window.location.href = "http://localhost/miramas-ecologie-mvc/dons";
        }, 4000);
      </script>';
    } else {
      echo "<div class=container-green-text><p class=red-text>Une erreur s'est produite lors de l'enregistrement de l'annonce. Veuillez vérifier les informations que vous avez saisies.</p></div>";
    }

    $stmt->close();
  }
}


mysqli_close($connexion);


?>