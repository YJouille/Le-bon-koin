<?php
// page affichant la liste des annonces $annoncesList
ob_start();

$criteresNames = [
    'critere_marque' => 'Marque',
    'critere_modele' => 'Modèle',
    'critere_km' => 'Kms',
    'critere_carburant' => 'Carburant',
    'critere_boite-de-vitesse' => 'Boite de vitesse',
    'critere_couleur' => 'Couleur',
    'critere_nb-de-portes' => 'Nombre de portes',
    'critere_puissance' => 'Puissance',
    'critere_nb-de-places' => 'Nombre de places',
    'critere_type-de-bien' => 'Type de bien',
    'critere_surface' => 'Surface',
    'critere_nombre-de-pieces' => 'Nombre de pièces',
    'critere_etat' => 'Etat',
    'critere_type' => 'Type',
    'critere_capacite-de-stockage' => 'Capacité de stockage'
];

?>

<section class="page-section mb-0" id="about">
	<div class="container">
		<h2 class="page-section-heading text-center text-uppercase"><?=$annonce['titre_annonce']?></h2>
		<div class="divider-custom"></div>
		<div class="row">
			<div class="col-lg-4 ms-auto">
				<p class="lead">
					<em><?=$annonce['desc_annonce']?></em>
				</p>
				<p class="lead ">
					<strong><?=$annonce['prix_annonce']?> €</strong>
				</p>
				<p class="lead">Catégorie : <?=$listCategories[$annonce['id_categorie']]?>
				</p>
				<?php
    foreach ($annonce as $nom_critere => $valeur_critere) {
        if (strpos($nom_critere, 'critere_') === 0) {
            ?>
            <p class="lead"><?=$criteresNames[$nom_critere]?> : <?=$valeur_critere ?>
				</p>
            <?php
        }
    }

    ?>
			</div>
	
			<?php
if (file_exists(__DIR__ . "/../Assets/img/annonces/" . $annonce['id_annonce'] . ".png")) {
    $imagPath = "Assets/img/annonces/" . $annonce['id_annonce'] . ".png";
} else {
    $imagPath = "Assets/img/annonces/no-pict.png";
}
?>
			<div class="col-lg-4 me-auto">
				<img class="card-img-top img-fluid"
					style="height: 300px; object-fit: contain;" src="<?=$imagPath?>"
					alt="<?=$annonce['titre_annonce']?>">
			</div>
		</div>
		<div class="row">
			<div class="col-lg-8 m-auto">
				<h5 class="text-center text-uppercase">Localisation</h5>
				<iframe
					src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDVpf8cNScpvRrJzvbhjjkIuA_blKGFPlQ&q=<?=str_replace(' ', '+', $annonce['adresse_annonce'])?>"
					width="100%" height="450" style="border: 0;" allowfullscreen=""
					loading="lazy"></iframe>
			</div>
		</div>
		<div class="text-center mt-4">
			<a class="btn btn-xl btn-outline-light"
				href="https://startbootstrap.com/theme/freelancer/"> <i
				class="fas fa-download me-2"></i> Free Download!
			</a>
		</div>
	</div>

</section>

<?php
$content = ob_get_clean();
$pageTitle = "Détail d'une annonce - " . $annonce['titre_annonce'];
$pageDescription="Détail de l'annonce - ".$annonce['desc_annonce'];
require (__DIR__ . '/template.php');
?>

