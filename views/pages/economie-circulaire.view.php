
<?php 

ob_start();

?>

<div id="gd">
      <main>
        <h1>L'économie circulaire</h1>
        <p id="paragraphe">
          L’économie circulaire consiste à produire des biens et des services de
          manière durable en limitant la consommation et le gaspillage des
          ressources et la production des déchets. Il s’agit de passer d’une
          société du tout jetable à un modèle économique plus circulaire.
        </p>

        <img
          src="./public/image/economiecirculaire2.jpg"
          id="image"
          alt="image définissant l'économie circulaire"
        >
      </main>
    </div>


<?php 

$content = ob_get_clean();
$title = "Économie circulaire";
$css = "./public/css/economie-circulaire.css";

require "./views/base.php";
?>


