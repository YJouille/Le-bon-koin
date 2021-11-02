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
			<div class="card m-2">
				<img class="card-img-top img-fluid" src="Assets/img/annonces/<?= $annonce['id_annonce'] ?>.png" alt="<?= $annonce['titre_annonce'] ?>">
				<div class="card-body">
					<h5 class="card-title"><?= $annonce['titre_annonce'] ?></h5>
					<p class="card-text"><?= $annonce['desc_annonce'] ?></p>
					<p class="card-text"><?= $annonce['prix_annonce'] ?> €</p>
					<a href="?view&id_annonce=<?= $annonce['id_annonce'] ?>" class="btn btn-primary btn-detail">Détails</a>
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