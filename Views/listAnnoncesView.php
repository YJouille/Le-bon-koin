<?php
// page affichant la liste des annonces $annoncesList
ob_start();
?>
<div class="container-fluid">
	<div class="d-flex justify-content-center flex-wrap">
	
<?php
// si tableau vide afficher 'aucune annonce'
foreach ($annoncesList as $annonce) {
    ?>


			<div class="card m-2" style="width: 18rem;">
			<img class="card-img-top img-fluid" style="height: 300px; object-fit: contain;"
				src="Assets/img/annonces/<?=$annonce['id_annonce']?>.png"
				alt="<?=$annonce['titre_annonce']?>">
			<div class="card-body">
				<h5 class="card-title"><?=$annonce['titre_annonce']?></h5>
				<p class="card-text"><?=$annonce['desc_annonce']?></p>
				<a href="?view&id_annonce=<?=$annonce['id_annonce']?>"
					class="btn btn-primary">Détails</a>
			</div>
		</div>

<?php } ?>



		</div>
</div>



<?php
$content = ob_get_clean();
$pageTitle = "Liste des annonces";
require (__DIR__ . '/template.php');
?>
