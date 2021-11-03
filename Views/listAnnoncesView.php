<?php
// page affichant la liste des annonces $annoncesList
ob_start();
?>
<div class="container-fluid list-annonces">
	<div class="d-flex justify-content-center flex-wrap">

		<?php
		// si tableau vide afficher 'aucune annonce'
		foreach ($annoncesList as $annonce) {
		?>

			<div class="card m-2" style="width: 18rem;">
				<?php
				if (file_exists(__DIR__ . "/../Assets/img/annonces/" . $annonce['id_annonce'] . ".png")) {
					$imagPath = "Assets/img/annonces/" . $annonce['id_annonce'] . ".png";
				} else {
					$imagPath = "Assets/img/annonces/no-pict.png";
				}
				?>

				<img class="card-img-top img-fluid" style="height: 300px; object-fit: contain;" src="<?= $imagPath ?>" alt="<?= $annonce['titre_annonce'] ?>">
				<div class="card-body">
					<h5 class="card-title"><?= $annonce['titre_annonce'] ?></h5>
					<h6 class="card-subtitle"><?= $annonce['prix_annonce'] ?> €</h6>
					
					<a href="?view&id_annonce=<?= $annonce['id_annonce'] ?>" class="btn btn-primary">Détails</a>
				</div>
			</div>
		<?php } ?>
	</div>
</div>



<?php
$content = ob_get_clean();
$pageTitle = "Liste des annonces";
$pageDescription = "Liste des annonces du bon koin";
require(__DIR__ . '/template.php');
?>