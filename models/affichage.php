<?php


include ('./models/config.php');

/*Pagination :

Nombre d'éléments à afficher par page*/
$elements_par_page = 10;


// Requête pour obtenir le nombre total d'annonces
$stmt = $connexion->prepare("SELECT COUNT(*) AS total FROM announcement");
$stmt->execute();
$result = $stmt->get_result();
$total_elements = $result->fetch_assoc()["total"];


// $page_courante = isset($_GET["page"]) ? $_GET["page"] : 1;
$page_courante = isset($_GET["dons"]) ? $_GET["dons"] : 1;
// Calcul du nombre de pages nécessaires
$nombre_pages = ceil($total_elements / $elements_par_page);

// calculer l'offset (décalage) nécessaire pour effectuer une pagination.

// L'offset est utilisé pour déterminer la position de départ des éléments à afficher dans une requête SQL, en spécifiant le nombre d'éléments à "sauter" avant de commencer à récupérer les résultats.

// Dans ce cas, l'offset est calculé en multipliant le numéro de la page courante moins un par le nombre d'éléments à afficher par page. Cela permet de déterminer le point de départ des résultats à récupérer pour afficher les éléments de la page actuelle.
$offset = ($page_courante - 1) * $elements_par_page;


// Requête pour obtenir les annonces de la page courante
$stmt1 = $connexion->prepare("SELECT announcement.id_announcement, announcement.user_id, announcement.title, announcement.picture, announcement.description, announcement.date_publication, users.id, users.email 
                            FROM announcement  
                            INNER JOIN users ON announcement.user_id = users.id 
                            ORDER BY announcement.date_publication DESC
                            LIMIT ?, ?");
$stmt1->bind_param("ii", $offset, $elements_par_page);
$stmt1->execute();
$results = $stmt1->get_result();


$date = date('Y-m-d H:i:s');

// Boucle pour afficher chaque annonce
while ($row = $results->fetch_assoc()) {
  $announcement_id = $row['id_announcement'];
  $image = $row["picture"];

    // Vérification si l'utilisateur est connecté et est l'auteur de l'annonce
    if (isset($_SESSION['username']) && $_SESSION['id'] == $row['user_id']) {

      $description = $row["description"];

      $wrappedDescription = wordwrap($description, 70, "\n", true);
      
    echo "<hr>
    <section id=annonce-list>
          <h6>" . $row["title"] . "</h6>
          <div class='div-photos-texte'>
          <img src='./public/image/" . htmlspecialchars($image) . "'
              class='photos-dons'
              alt='photos des annonces postées par les utilisateurs'
            >
            <p class='texte'>
            " . $wrappedDescription . "
            </p>
            <p class=date-time>Déposé le : ". $row["date_publication"] . "</p>
          </div>
          <div class=div-i>
            <a href=modifier-l-annonce?id=" . $announcement_id . "
              ><i
                class='fa-solid fa-pen'
                title='modifier'
                id='logo-i'
              ></i
            ></a> 
            <form method='post' action=''>
            <input type='hidden' name='id' value='" . $announcement_id . "'>
            <button class='button-delete' type='submit' name='delete_button" . $announcement_id . "'><i
            class='fa-solid fa-trash-can'
            title='supprimer'
            id='logo-i-2'
            ></i
            ></button>
            </form>
          </div>
        </section>";
    // Vérification si le bouton de suppression a été cliqué
  if (isset($_POST['delete_button' . $announcement_id])) {
  


    // Requête SQL de suppression
    $sql_delete = "DELETE FROM announcement WHERE id_announcement = ?";
    $stmt = $connexion->prepare($sql_delete);
    $stmt->bind_param("i", $announcement_id);
    $stmt->execute();

    // Vérification de la suppression
    if ($stmt->affected_rows > 0) {
        echo "<div class='msg-delete-container'>";
        echo "<br><h3 style='color:red'>L'annonce a été supprimée avec succès !</h3>";
        echo "</div>";
        echo '<script language="javascript">
      
        setTimeout(function() {
            window.location.href = "http://localhost/miramas-ecologie-mvc/dons";
        }, 3000);
      
        </script>';
    } else {
        echo "Une erreur est survenue lors de la suppression de l'annonce : " . $connexion->error;
    }

  
    $connexion->close();
}

  }
   // sinon, afficher les informations de l'annonce avec un bouton pour contacter l'auteur
  else {
    $description = $row["description"];
    $wrappedDescription = wordwrap($description, 70, "\n", true);
    echo  "<hr>
    <section>
            <h6>" . $row["title"] . "</h6>
            <div class='div-photos-texte'>
            <img src='./public/image/" . htmlspecialchars($image) . "'
                class='photos-dons'
                alt='photos des annonces postées par les utilisateurs'
              >
              <p class='texte'>
                 " . $wrappedDescription . " 
              </p>
              <p class=date-time>Déposé le : ". $row["date_publication"] . "</p>
            </div>
               <div class='container-button-contact'>
            <form method='post' action=''>
                <button type='submit' name='submit-contact' class='button-contact' onclick='event.preventDefault(); showErrorMessage()'>Contact</button>
            </form>
            <p id='error-message' class='red-' style='display: none ; color: red';>Vous devez être connecté pour contacter l'annonceur.</p>
      
    <script>
        function showErrorMessage() {
            var errorMessage = document.getElementById('error-message');
            errorMessage.style.display = 'block';
            setTimeout(function() {
                errorMessage.style.display = 'none';
            }, 4000);
        }
    </script>";

    
           

          echo "</div>
      </section>";
}
}

 //afficher les liens vers les pages précédentes et suivantes
echo "<div id='pagination'>";
for ($i = 1; $i <= $nombre_pages; $i++) {
    if ($i == $page_courante) {
        echo "<span class='page-active'>$i</span>";
    } else {
        echo "<a class='page' href='?page=$i'>$i</a>";
      }
  }

  echo "</div>";



?>