<?php
// page affichant la liste des annonces $annoncesList
ob_start();
?>

<section class="page-section" id="contact">
	<div class="container">
		<h2
			class="page-section-heading text-center text-uppercase text-secondary mb-0">
			Déposer une annonce</h2>

		<div class="divider-custom">
			<div class="divider-custom-line"></div>
		</div>

		<div class="row justify-content-center">
			<div class="col-lg-8 col-xl-7">
				<form action="?new" method="post">
					<input type="hidden" name="id_user"
						value="<?= $_SESSION['id_user']?>">


					<div class="form-floating mb-3">
						<input class="form-control" id="titre" type="text"
							placeholder="Titre de l'annonce" required="required" /> <label
							for="titre">Titre de l'annonce</label>
					</div>


					<div class="form-floating mb-3">
						<textarea class="form-control" id="description"
							placeholder="Description de l'annonce" style="height: 10rem"></textarea>
						<label for="description">Description de l'annonce</label>
					</div>


					<div class="form-floating mb-3">
						<input class="form-control" id="prix" type="number"
							placeholder="(123) 456-7890" /> <label for="prix">Prix</label>
					</div>


					<!-- add js for zip codes -->
					<div class="form-floating mb-3">
						<input class="form-control" id="adresse" type="text"
							placeholder="Adresse de l'annonce" required="required" /> <label
							for="adresse">Adresse de l'annonce</label>
					</div>


					<div class="form-floating mb-3">
						<select class="form-select" id="categorie">
						<?php
    foreach ($listCategories as $categorie) {
        ?>
				<option value="<?=$categorie['id_categorie']; ?>">
				<?php if(strlen($categorie['id_categorie'])>1)echo'---'; ?>
				<?=$categorie['libelle_categorie']; ?></option>
		<?php } ?>
						</select> <label for="categorie">Catégorie de l'annonce</label>
					</div>
					
					<!-- JS additionals criterias -->


					<!-- <div class="d-none" id="submitErrorMessage">
						<div class="text-center text-danger mb-3">Error sending message!</div>
					</div> -->
					<button class="btn btn-primary btn-xl" id="submitButton"
						type="submit">Déposer l'annonce</button>
				</form>
			</div>
		</div>
	</div>
</section>


<?php
$content = ob_get_clean();
$pageTitle = "Nouvelle annonce";
require (__DIR__ . '/template.php');
?>
