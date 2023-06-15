<?php 

ob_start();

?>

<div id="gd">
      <div id="conteneur-map">
        <div id="map"></div>
      </div>
 </div>
  

        <?php 

$content = ob_get_clean();
$title = "Carte";
$css = "./public/css/carte.css";

$js ="./public/js/carte.js";


require "./views/base.php";
?>