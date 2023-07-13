<?php

ob_start();

?>
<?php

require_once('./models/verify.php');

?>
<div id="gd"> <?php if (isset($_SESSION['username'])) {
                // utilisateur connecté
                echo "<h1>Se déconnecter</h1>
      <div id='div-form'>
        <form method='POST' action='' id='formi'>
          <div id='bouton-envoyer'>
          <p class='paragraphe'>Êtes-vous sûr de vouloir vous déconnecter ?</p>
            <a
          href='./models/deconnexion.php'
          class='texte-footer-2'
          ><p class='texte-footer-2'>Se déconnecter</p></a
        >
          </div>
        </form>
      </div>";
              } else {
                /*utilisateur non connecter*/
                echo "<h1>Connectez-vous</h1>
      <div id='div-form'>
        <form method='POST' action='' id='formi'>
          <label for='email'>E-mail :</label><br>
          <input
            type='email'
            name='email'
            id='email'
            required
            minlength='8'
            maxlength='35'
            value='" . (isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '') . "' 
          ><br><br>
          <label for='pass'>Mot de passe :</label><br>
          <input
            type='password'
            id='pass'
            name='password'
            minlength='8'
            maxlength='35'
            required
             value='" . (isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '') . "'
             >
          <i
            class='fa fa-fw fa-eye field-icon toggle-password'
            id='eyeshow'
          ></i>
          <i
            class='fa fa-fw fa-eye-slash field-icon toggle-password'
            id='eyehide'
          ></i>
          <!--<p class='mdp-oublier'></p></a>-->
          <div id='bouton-envoyer'>
            <button type='submit'
             class='g-recaptcha' 
        data-sitekey='6Lf7YFYmAAAAAIwiDbCp86W4GThqtbGrL96VMg4s' 
        data-callback='onSubmit' 
        data-action='submit'>Se connecter</button>
          </div>
          <div id='btn'>
        <a href='inscription'
              ><p class='texte-inscription'>Pas encore inscrit ? Inscrivez-vous !</p></a
            >
          </div>
        </form>
      </div>";
              }
              ?>
</div>
<!-- <script>
   function onSubmit(token) {
     document.getElementById("formi").submit();
   }
 </script>
<script src="https://www.google.com/recaptcha/api.js"></script> -->

<?php

$content = ob_get_clean();
$title = "Connexion";
$css = "./public/css/connexion.css";
$js = "./public/js/connexion.js";
require "./views/base.php";
?>