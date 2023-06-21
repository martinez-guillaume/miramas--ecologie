<?php 

ob_start();

?>
<?php
session_start();
?>
<div id="gd">
      <div id="background-texte">
        <p id="bonjour">
          Bonjour à tous,<br><br>
          Je m'appelle Guillaume Martinez et je suis développeur web installé à
          Miramas.<br>
          J’ai voulu créer ce projet afin de contribuer à l’écologie dans ma
          ville.<br>Il est important de prendre conscience de l'impact de nos
          actions sur l'environnement.<br><br>
          En effet, je pense que chacun d'entre nous peut, à notre échelle,
          aider à laisser une planète plus propre pour les générations
          futures.<br>
          Sur ce site, vous trouverez des articles de sensibilisation ainsi
          qu'une carte GPS indiquant des points de tri sélectif, des points de
          collecte de vêtements, ainsi que les points GPS des zones de recharge
          pour les voitures électriques. De plus, une page est dédiée aux
          annonces de dons où les Miramasséens et les Miramasséennes peuvent
          déposer des annonces pour des meubles, objets, électroménagers, etc.
          afin de promouvoir l'entraide dans notre ville.<br>
          <br>
          Je reste à votre disposition dans la rubrique contact pour toute
          suggestion, évolution des zones sur le terrain, ou remarque.<br>
          <br>
          Je vous souhaite une bonne utilisation.<br>
          <br>
          Bien à vous,<br>
          <br>
          Guillaume
        </p>
      </div>
    </div>


<?php 

$content = ob_get_clean();
$title = "Qui-suis-je";
$css = "./public/css/qui-suis-je.css";

require "./views/base.php";
?>