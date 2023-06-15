<?php 

ob_start();

?>

<div id="gd">
      <main>
        <h1>PRÉSERVER LA BIODIVERSITÉ</h1>
        <p class="paragraphe">
          POURQUOI FAUT-IL PRÉSERVER LA BIODIVERSITÉ VÉGÉTALE ?<br>
          <br>
          La biodiversité est un indicateur précieux de la santé des écosystèmes
          dont nous dépendons. Face à son érosion et la perte de milliers
          d’espèces chaque année, nous accentuons les risques de voir nos
          conditions de vie se dégrader de manière irréparable.<br><br>
          Un écosystème en bonne santé c’est un réseau solide capable de fournir
          des services irremplaçables comme notre nourriture, l’air que nous
          respirons, l’eau que nous buvons, les médicaments qui nous soignent,
          etc...<br><br>
          À titre d’exemple :<br><br>
          L’océan produit 50% de l’oxygène que nous respirons et absorbe 30% du
          CO2 de l’atmosphère 70% des cultures dépendent d’une pollinisation
          animale.
          <a
            href="https://biodiversite.gouv.fr/la-biodiversite-cest-quoi"
            class="lien-bio"
            target="_blank"
            >(source : biodiversité.gouv.fr)</a
          ><br><br>
          La biodiversité nous protège aussi des risques naturels accentués par
          le changement climatique (crues, incendies, tempêtes, sécheresse,
          épidémies, etc.), et peut même compenser, dans une certaine mesure,
          les dommages que nous causons à l’environnement, comme la pollution
          des sols, de l’air ou des cours d’eau.<br>
          Elle est enfin une source inépuisable de connaissance,
          d’émerveillement et de divertissement.<br><br>
          L’Homme n’est qu’une espèce parmi les autres. Nous vivons tous
          ensemble sur une même planète aux ressources limitées. Les écosystèmes
          reposent sur des équilibres fragiles. La perte de biodiversité est un
          bousculement à très grande échelle dont nous ne percevons que les
          effets immédiats mais qui aura des conséquences sur les générations à
          venir si nous ne redoublons pas d’efforts pour la protéger, la
          préserver et la restaurer partout où c’est possible.
        </p>
      </main>
    </div>


<?php 

$content = ob_get_clean();
$title = "Biodiversité";
$css = "./public/css/biodiversite.css";

require "./views/base.php";
?>