<?php

//page affichant la liste des annonces

ob_start();
// ob_start() démarre la temporisation de sortie. Tant qu'elle est enclenchée, aucune donnée, hormis les en-têtes, n'est envoyée au navigateur, mais temporairement mise en tampon.
?>

<p> je suis la vue list annonce!</p>
<?php
$loopAnnonces =  ob_get_clean();
// ob_get_clean — Lit le contenu courant du tampon de sortie puis l'efface
require_once('skeleton.php');
?>
