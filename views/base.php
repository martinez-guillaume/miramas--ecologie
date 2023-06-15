<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer">
  <link rel="stylesheet" href="<?= $css ?>">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Site web écologique pour la ville de Miramas en Provence, dans les Bouches-du-Rhône. Découvrez la carte GPS des zones de tri, la section dons et déposez vos annonces écologiques. Contribuez à préserver l'environnement et promouvoir la durabilité.">
  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Inter&display=swap" rel="stylesheet">
  <link
      rel="stylesheet"
      href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
      integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
      crossorigin=""
      >
  <link rel="icon" type="image/png" sizes="32x32" href="./public/favicon/favicon-32x32.png">
  <title><?= $title; ?> | Miramas écologie</title>
</head>

<body>
  <div id="container-logo">
    <img id="logo-miramas" src="./public/image/logomiramas2.png" alt="logo de la ville de Miramas">
    <a href="connexion" id="c"><i class="fa-sharp fa-solid fa-circle-user" title="se connecter"></i>
      <p class="phrase-connexion"><?php if (isset($_SESSION['username'])) {
                                    // utilisateur connecté
                                    echo $_SESSION['username'];
                                  } else {
                                    // utilisateur non connecté
                                    echo '<p class="phrase-connexion">Se connecter</p>';
                                  } ?></p>
    </a>
  </div>
  <p id="phrase-logo">Agissons ensemble pour vivre mieux...</p>

  <!--menu burger-->


  <?php include "./views/partials/_navBar.php" ?>


  <?= $content; ?>

  <div id="grand-footer">
    <p id="titre-footer">De quoi avez vous besoin ?</p>
    <div class="container-footer">
      <a href="./index.php" class="texte-footer-2">
        <p class="texte-footer-2">Accueil</p>
      </a>
      <a href="./carte/Titre-pro-carte.php" class="texte-footer-2">
        <p class="texte-footer-2">Carte GPS</p>
      </a>
      <a href="./dons/Titre-pro-dons.php" class="texte-footer-2">
        <p class="texte-footer-2">Dons</p>
      </a>
      <a href="./carte/Titre-pro-carte.php" class="texte-footer-22">
        <p class="texte-footer-22">Dépôt de vêtements</p>
      </a>
      <a href="./carte/Titre-pro-carte.php" class="texte-footer-22">
        <p class="texte-footer-22">Zone de charge</p>
      </a>
      <a href="./carte/Titre-pro-carte.php" class="texte-footer-22">
        <p class="texte-footer-22">Zone de tri</p>
      </a>
      <a href="./sobriété-énergétique/Titre-pro-sobriete-energétique.php" class="texte-footer-22">
        <p class="texte-footer-22">Article</p>
      </a>

      <?php if (isset($_SESSION['username'])) {
        // utilisateur connecté
        echo  "<a
  href='./qui-suis-je/Titre-pro-a-propos.php'
  class='texte-footer-22'
  ><p class='texte-footer-22'>Qui suis je</p></a
>
<a href='./contact/Titre-pro-contact.php' class='texte-footer-2'
  ><p class='texte-footer-2'>Contact</p></a
>
<a
  href='./connexion-utilisateur/deconnexion.php'
  class='texte-footer-2'
  ><p class='texte-footer-2'>Se déconnecter</p></a
>";
      } else {
        // utilisateur non connecté
        echo "   <a href='./contact/Titre-pro-contact.php' class='texte-footer-2'
  ><p class='texte-footer-2'>Contact</p></a
>
<a
  href='./connexion-utilisateur/Titre-pro-se-connecter.php'
  class='texte-footer-2'
  ><p class='texte-footer-2'>Se connecter</p></a
>
<a
  href='./inscription/Titre-pro-s-inscrire.php'
  class='texte-footer-22'
  ><p class='texte-footer-22'>S'inscrire</p></a
>";
      } ?>
    </div>
    <div id="container-footer-3">
      <p id="texte-footer-3">© tous droits réservés</p>
      <p id="texte-footer-3-2">guillaume.m.developer@gmail.com</p>
    </div>
  </div>
  <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
  <script src="<?= $js; ?>"></script>
</body>

</html>