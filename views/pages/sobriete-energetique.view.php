<?php 

ob_start();

?>
<?php
session_start();
?>
<div id="gd">
      <main>
        <h1>Sobriété énergétique</h1>
        <p class="paragraphe">
          Afin de diminuer vos factures et réduire l’impact de la crise
          énergétique sur vos activités, il est indispensable de se mobiliser
          dans une démarche de sobriété énergétique. Au-delà des bons réflexes à
          adopter au quotidien, rappelons que l’efficacité énergétique implique
          un engagement à plus long terme, à initier dès à présent.
        </p>

        <h3 class="sous-titre">Des premiers gestes simples et immédiats</h2>
        <h6>Éclairage</h6>
        <p class="paragraphe">
          Éteindre l’éclairage intérieur des bâtiments lors des périodes de
          fermeture.<br>
          Réduire l’éclairage extérieur des bâtiments, notamment publicitaire
          (et l’éteindre au plus tard à 1h du matin conformément à la
          réglementation).<br>
          Améliorer l'efficacité de l'éclairage en déployant des LED ou des
          éclairages basse consommation, ainsi qu’une gestion en fonction de la
          présence.<br>
        </p>

        <h6>Numérique</h6>

        <p class="paragraphe">
          Réduire la consommation des appareils informatiques : <br>
          <br>
          Paramétrer la veille des ordinateurs, éteindre complètement les écrans
          la nuit, mettre en place une gestion optimisée du fonctionnement des
          serveurs informatiques....<br>
          Limiter le nombre d’équipements électriques et éviter leur
          sur-dimensionnement (nombre et taille d’écrans, puissance du matériel
          informatique par rapport au besoin…).<br>
          Optimiser les usages : moins de consommation de vidéos, optimisation
          par l’écoconception des codes des applications et sites Web.<br>
          Réduire ou arrêter les systèmes audiovisuels non indispensables, tels
          que les projecteurs ou écrans des halls d’accueil ou des cafétérias.
          Augmenter la température des salles de serveur, mettre en œuvre des
          systèmes de refroidissement passifs (free cooling), viser des PUE
          (Power Usage Effectiveness) performants.<br>
          Récupérer l’énergie fatale produite par les serveurs (préchauffage
          d’eau…).
        </p>

        <h6>Chauffage / Climatisation</h6>

        <p class="paragraphe">
          Fermer les portes pour éviter la déperdition ou l’apport de
          chaleur.<br>
          Adapter la température par la programmation des équipements :<br>
          L’hiver, 19 °C pour les pièces occupées, 16 °C hors période
          d’occupation, 8 °C si les lieux sont inoccupés plus de deux jours.
          <br>L’été, ouvrez les fenêtres le matin quand l’air est plus frais,
          refermez dès qu’il devient plus chaud en occultant les fenêtres,
          réglez la climatisation en respectant un écart de 6 °C max avec la
          température extérieure.<br>
          Si la température est inférieure à 26 °C, éteignez la climatisation.
          Faire entretenir sa pompe à chaleur ou sa climatisation réversible, en
          plus de l’inspection quinquennale obligatoire.<br>
          Faire vérifier le bon fonctionnement général des systèmes de
          chauffage, notamment le bon réglage des pompes de circulation pour le
          chauffage à eau chaude. Installer des portes sur les meubles
          frigorifiques des commerces alimentaires.
        </p>
      </main>
    </div>


<?php 

$content = ob_get_clean();
$title = "Sobriété énergétique";
$css = "./public/css/sobriete-energetique.css";

require "./views/base.php";
?>