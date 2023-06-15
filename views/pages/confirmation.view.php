<?php 

ob_start();

?>

<div id="gd">
      <h1 style="margin-top: 2%;">VALIDATION INSCRIPTION</h1>
      <div id="div-form">
       <?php
  include ('./models/config.php');
  include ('./models/confirmation-bis.php');
  
  ?>
    </div>


<?php 

$content = ob_get_clean();
$title = "Confirmation";
$css = "./public/css/inscription.css";
$js = "./public/js/inscription.js";
require "./views/base.php";
?>