<?php

session_start();


include ('./models/config.php');



$sql = "SELECT * FROM announcement WHERE id_announcement = $_GET[id]";
$results = $connexion->query($sql);
$title="";
$description="";
if ($results->num_rows > 0) { 
    // Vérification si des résultats ont été retournés par la requête
  while ($row = $results->fetch_assoc()) { 
    $title = $row['title'];
    $description = $row['description'];
  }
}

if (isset($_POST['submit'])) {

   // Vérification si l'utilisateur est connecté
   if (!isset($_SESSION['username'])) {
    echo "<div class=container-green-text><p class=red-text-reservation>Vous devez être connecté pour réserver un livre.</p></div>";
    exit();
  }


date_default_timezone_set('Europe/Paris');

$title = $_POST['title'];
$description = $_POST['description'];
$date = date('Y-m-d H:i:s');
$announcement_id = $_GET['id'];


  // start image upload
// $target_dir = "../image/";
// $uploadedFileName = $date . '_' .basename($_FILES["picture"]["name"]);
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
  echo "Désoler, seuleument JPG, JPEG, PNG , JFIF , WEBP & GIF fichiers sont acceptés.";
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




if (empty($title)|| empty($uploadedFileName)|| empty($description)){
  echo '<script language="javascript">

  setTimeout(function() {

    // window.location.href = "https://xn--miramas-cologie-inb.fr/inscription/Titre-pro-s-inscrire.php";
    window.location.href = "http://localhost/miramas-ecologie-mvc/inscription";
   
  }, 1000);
  
  </script>';
  
  
  return;

 } elseif (strlen($title) > 255 || strlen($description) > 255) {
    echo '<script language="javascript">

    setTimeout(function() {

      //window.location.href = "https://xn--miramas-cologie-inb.fr/inscription/Titre-pro-s-inscrire.php";
      window.location.href = "http://localhost/miramas-ecologie-mvc/inscription";
    }, 1000);
    
    </script>';
    return;
  
} else {


$sql_update = "UPDATE announcement SET title=?, picture=?, description=?, date_publication=? WHERE id_announcement=?";
$stmt = $connexion->prepare($sql_update);
$stmt->bind_param("ssssi", $title, $uploadedFileName, $description, $date, $announcement_id);
$stmt->execute();
}
// Exécution de la requête de mise à jour
if ($stmt->execute())   {

    echo '<script language="javascript">


    document.write("<br><h3 style=color:green>Félicitations ! Votre annonce a bien été modifier . Elle sera bientôt publiée en ligne. Merci </h3>");

    setTimeout(function() {

     // window.location.href = "https://xn--miramas-cologie-inb.fr/dons/Titre-pro-dons.php";
     window.location.href = "http://localhost/miramas-ecologie-mvc/dons";
    }, 4000);
  
    </script>';
} else {
    echo "<div class=container-green-text><p class=green-text>Une erreur s'est produite lors de la modification de l'annonce . Veuillez vérifier les informations que vous avez saisies. " . $connexion->error . "</p></div>";
}
}


mysqli_close($connexion);
  

?>