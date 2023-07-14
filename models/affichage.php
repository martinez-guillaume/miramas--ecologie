<?php


include ('./models/config.php');

$elements_par_page = 10;

$stmt = $connexion->prepare("SELECT COUNT(*) AS total FROM announcement");
$stmt->execute();
$total_elements = $stmt->fetchColumn();

$page_courante = isset($_GET["dons"]) ? $_GET["dons"] : 1;
$nombre_pages = ceil($total_elements / $elements_par_page);
$offset = ($page_courante - 1) * $elements_par_page;

$stmt1 = $connexion->prepare("SELECT announcement.id_announcement, announcement.user_id, announcement.title, announcement.picture, announcement.description, announcement.date_publication, users.id, users.email 
                            FROM announcement  
                            INNER JOIN users ON announcement.user_id = users.id 
                            ORDER BY announcement.date_publication DESC
                            LIMIT :offset, :elements_par_page");
$stmt1->bindParam(":offset", $offset, PDO::PARAM_INT);
$stmt1->bindParam(":elements_par_page", $elements_par_page, PDO::PARAM_INT);
$stmt1->execute();
$results = $stmt1->fetchAll(PDO::FETCH_ASSOC);

$date = date('Y-m-d H:i:s');

foreach ($results as $row) {
  $announcement_id = $row['id_announcement'];
  $image = $row["picture"];

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
        <p class='texte'>" . $wrappedDescription . "</p>
        <p class=date-time>Déposé le : ". (new DateTime($row["date_publication"]))->format('d/m/Y \à  H:i') . "</p>
      </div>
      <div class=div-i>
        <a href=modifier-l-annonce?id=" . $announcement_id . ">
          <i class='fa-solid fa-pen' title='modifier' id='logo-i'></i>
        </a> 
        <form method='post' action=''>
          <input type='hidden' name='id' value='" . $announcement_id . "'>
          <button class='button-delete' type='submit' name='delete_button" . $announcement_id . "'>
            <i class='fa-solid fa-trash-can' title='supprimer' id='logo-i-2'></i>
          </button>
        </form>
      </div>
    </section>";

    if (isset($_POST['delete_button' . $announcement_id])) {
      $sql_delete = "DELETE FROM announcement WHERE id_announcement = :announcement_id";
      $stmt = $connexion->prepare($sql_delete);
      $stmt->bindParam(":announcement_id", $announcement_id, PDO::PARAM_INT);
      $stmt->execute();

      if ($stmt->rowCount() > 0) {
        echo '<script language="javascript">
          Swal.fire({
            icon: "success",
            title: "Félicitations!",
            text: "L\'annonce a été supprimée avec succès !",
            showConfirmButton: false,
            timer: 2100
          });
          setTimeout(function() {
            window.location.href = "https://xn--miramas-cologie-inb.fr/dons";
          }, 2100);
        </script>';
      } else {
        echo '<script language="javascript">
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Une erreur est survenue lors de la suppression de l\'annonce, veuillez réessayer ultérieurement, merci.",
            showConfirmButton: false,
            timer: 2100
          });
          setTimeout(function() {
            window.location.href = "https://xn--miramas-cologie-inb.fr/deposer-une-annonce";
          }, 2100);
        </script>';
      }
      $connexion = null;
    }
  } else {
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
        <p class='texte'>" . $wrappedDescription . "</p>
        <p class=date-time>Déposé le : ". (new DateTime($row["date_publication"]))->format('d/m/Y \à  H:i') . "</p>
      </div>
      <div class='container-button-contact'>";
    if(isset($_SESSION['username'])) { 
      echo " 
      <a href='mailto:". $row["email"] ."' class='button-contact'>contact</a>";
    } else {
      echo "<a class='button-contact'>Contact</a>";
      echo "<script>
        document.querySelectorAll('.button-contact').forEach(function(button) {
          button.addEventListener('click', function() {
            Swal.fire({
              icon: 'error',
              title: 'Connectez-vous',
              text: 'Vous devez être connecté pour contacter l\\'annonceur !',
              confirmButtonColor: '#406346',
              footer: '<a href=\"connexion\" style=\"color: green; font-family: Inter;\">Se connecter ?</a>'
            });
          });
        });
      </script>";
    }
    echo "</div>              
  </section>";
}
}
echo "<div id='pagination'>";
for ($i = 1; $i <= $nombre_pages; $i++) {
    if ($i == $page_courante) {
        echo "<span class='page-active'>$i</span>";
    } else {
        echo "<a class='page' href='?dons=$i'>$i</a>";
    }
}
echo "</div>";
