<?php 

ob_start();

?>
<?php

require_once('./models/dons-bis.php');

?>
<div id="gd">
    <h1>Offrez ce que vous ne voulez plus...</h1>
    <main>
      <form method="post" action="">
        <div id="flex-depot-annonce">
          <button class="depot-annonce" type="submit" name="depot_annonce">Déposer une annonce</button>
        </div>
      </form>
      <?php
      include("./models/affichage.php");
      ?>

    </main>
  </div>


<?php 

$content = ob_get_clean();
$title = "Dons";
$css = "./public/css/dons.css";

require "./views/base.php";
?>