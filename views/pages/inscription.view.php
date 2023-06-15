<?php 

ob_start();

?>
<?php
require_once('./models/inscription-bis.php');
?>

<div id="gd">
      <h1>INSCRIPTION</h1>
      <div id="div-form">
        <form action="" method="post">
          <label for="username">Nom d'utilisateur :</label><br>
          <input
            type="text"
            id="username"
            name="username"
            required
            minlength="3"
            maxlength="25"
            value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>"
          ><br><br>
          <label for="email">E-mail :</label><br>
          <input
            type="email"
            name="email"
            id="email"
            required
            minlength="8"
            maxlength="35"
            value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"
          ><br><br>
          <label for="password">Mot de passe :</label><br>
          <input
            type="password"
            name="password"
            id="password"
            required
            minlength="7"
            maxlength="35"
            value="<?php echo htmlspecialchars($_POST['password'] ?? ''); ?>"
          ><i class="fa fa-fw fa-eye field-icon toggle-password" id="eyeshow"></i>
          <i class="fa fa-fw fa-eye-slash field-icon toggle-password" id="eyehide"></i><br>
          <span class="span" id="cara">* minimum 8 caractères</span>
          <span class="span" id="maj">* une majuscule minimum</span>
          <span class="span" id="spec">* un caractère spécial </span>
          <span class="span" id="num">* un chiffre minimum </span><br>
          <label for="passwordconfirm"
            >Veuillez confirmer votre mot de passe :</label
          ><br>
          <input
            type="password"
            name="passwordconfirm"
            id="passwordconfirm"
            required
            minlength="8"
            maxlength="35"
            value="<?php echo htmlspecialchars($_POST['passwordconfirm'] ?? ''); ?>"
          /><i class="fa fa-fw fa-eye field-icon toggle-password" id="eyeshow2"></i>
          <i class="fa fa-fw fa-eye-slash field-icon toggle-password" id="eyehide2"></i><br>
          <div id="bouton-envoyer">
            <p id="red">Les deux mots de passe ne sont pas identiques</p>
            <button type="submit" disabled id="btn" name="submit">Envoyer</button>
          </div>
        </form>
      </div>
    </div>


<?php 

$content = ob_get_clean();
$title = "Inscription";
$css = "./public/css/inscription.css";
$js = "./public/js/inscription.js";

require "./views/base.php";
?>