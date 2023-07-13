<?php 

ob_start();

?>
<?php
session_start()
?>
<div id="gd">
      <div id="conteneur-map">
        <div id="map"></div>
      </div>
 </div>
 <script 
    src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" 
    integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" 
    crossorigin=""
    ></script>

        <?php 

$content = ob_get_clean();
$title = "Carte";
$css = "./public/css/carte.css";

$js ="./public/js/carte.js";


require "./views/base.php";
?>