<?php
// page affichant la liste des annonces $annoncesList
ob_start();
?>
<div class="container-fluid">
	<div class="d-flex justify-content-center flex-wrap">
	
<?php 
// si tableau vide afficher 'aucune annonce'
foreach ($annoncesList as $annonce) { ?>


			<div class="card m-2" style="width: 18rem;">
			<img class="card-img-top" src="Assets/img/annonces/1.png"
				alt="Card image cap">
			<div class="card-body">
				<h5 class="card-title"><?=$annonce['titre_annonce']?></h5>
				<p class="card-text">Some quick example text to build on the card
					title and make up the bulk of the card's content.</p>
				<a href="#" class="btn btn-primary">Go somewhere</a>
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
