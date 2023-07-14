<?php 

ob_start();

?>
<?php
require_once('./models/deposer-une-annonce-bis.php');

?>
<div id="gd">
      <h1>DEPOSER UNE ANNONCE</h1>
      <div id="div-form">
        <form enctype="multipart/form-data" method="post" action="#">
          <label for="nom">Titre de l'annonce :</label><br>
          <input
            type="text"
            name="title"
            id="nom"
            required
            minlength="4"
            maxlength="40"
            value="<?php echo htmlspecialchars($_POST['title'] ?? ''); ?>"
          ><br>       
          <label for="image">Choisir une photos :</label><br>
          <input type="hidden" name="MAX_FILE_SIZE" value"10000000000">
          <input
            type="file"
            id="image"
            name="picture"
            required
            value="<?php echo htmlspecialchars($_POST['picture'] ?? ''); ?>"
          ><br>
          
          
          
          
          
          <label for="message">Description de l'objet :</label><br>
          <textarea
            name="description"
            id="message"
            required
            minlength="8"
            maxlength="250"
            placeholder="250 caractères max"
            value="<?php echo htmlspecialchars($_POST['description'] ?? ''); ?>"
          ></textarea
          ><br>
          <div id="bouton-envoyer">
            <button type="submit" name="submit">Envoyer</button>
          </div>
        </form>
      </div>
    </div>


<?php 

$content = ob_get_clean();
$title = "Déposer une annonce";
$css = "./public/css/deposer-une-annonce.css";

require "./views/base.php";
?>