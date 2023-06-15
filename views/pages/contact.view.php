<?php 

ob_start();

?>

<div id="gd">
      <div class="snowfall">
        <h1>Contactez moi</h1>
        <div id="div-form">
          <form action="contact.mailer.php" method="POST" id="formu">
            <label for="nom">Nom:</label><br>
            <input
              type="text"
              name="name"
              id="nom"
              required
              minlength="3"
              maxlength="50"
              value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>"
              ><br>
              <label for="prenom">Sujet:</label><br>
              <input
              type="text"
              name="subject"
              id="prenom"
              required
              minlength="3"
              maxlength="50"
              value="<?php echo htmlspecialchars($_POST['subject'] ?? ''); ?>"
              ><br>
              <label for="email">E-mail:</label><br>
              <input
              type="email"
              name="email"
              id="email"
              required
              minlength="8"
              maxlength="50"
              value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"
              ><br>
              <label for="message">Message:</label><br>
              <textarea
              name="message"
              required
              minlength="8"
              maxlength="500"
              id="message"
              value="<?php echo htmlspecialchars($_POST['message'] ?? ''); ?>"
              ></textarea
              ><br>
              <div id="bouton-envoyer">
                  <button type="submit" 
            class="g-recaptcha" 
        data-sitekey="6Lf7YFYmAAAAAIwiDbCp86W4GThqtbGrL96VMg4s" 
        data-callback='onSubmit' 
        data-action='submit'>Envoyer</button>
              </div>
          </form>
        </div>
      </div>
    </div>


<?php 

$content = ob_get_clean();
$title = "Contact";
$css = "./public/css/contact.css";

require "./views/base.php";
?>