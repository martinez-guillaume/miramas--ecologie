<?php 

ob_start();

?>

<div id="photos-accueil"></div>
    <div id="rectangle-accueil">
      <p id="texte-rectangle">De petits gestes naissent de grandes choses...</p>
    </div>
    <div id="gd">
      <div class="animation-text">
        <h2 id="bonjour">Bonjour à tous ,</h2>
        <p id="text-principal">
          bienvenue sur ce site internet qui permet de contribuer à l'écologie
          de la ville de Miramas. Vous y trouverez des articles de
          sensibilisation ainsi qu'une carte GPS indiquant des points de tri
          précis. De plus, une page est dédiée aux habitants de Miramas qui
          souhaitent déposer des annonces de dons tels que des meubles, objets,
          électroménagers, et bien plus encore, afin d'éviter de les jeter et de
          favoriser l'entraide dans notre ville.
        </p>
      </div>

      <h2>Découvrez nos astuces pratiques :</h2>

      <div id="container-section">
        <div class="lien-biodiversite">
          <a href="sobriete-energetique">
            <img
              id="photos-velo"
              src="./public/image/image-cycliste.jpg"
              alt="homme qui fait du velo"
            >
            <p class="texte-circulaire">Sobriété énergétique</p>
          </a>
        </div>

        <div class="lien-biodiversite">
          <a href="economie-circulaire">
            <div id="photos-circulaire"></div>
            <p class="texte-circulaire">Économie circulaire</p>
          </a>
        </div>

        <div class="lien-biodiversite">
          <a href="biodiversite">
            <img
              id="photos-biodiversité"
              src="./public/image/image-biodiversité.jfif"
              alt="photos de presonnes devant une ruche"
            >
            <p class="texte-circulaire">Biodiversité préservée</p>
          </a>
        </div>
      </div>
    </div>
<?php 

$content = ob_get_clean();
$title = "accueil";
$css = "./public/css/accueil.css";
$js = "./public/js/accueil.js";
require "./views/base.php";
?>