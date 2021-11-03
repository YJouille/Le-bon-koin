<?php
// page affichant la recherche des annonces
ob_start();
?>
<section class="page-section search-annonce" id="contact">
	<div class="container">
		<h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">
			Rechercher une annonce</h2>
		<div class="divider-custom">
			<div class="divider-custom-line"></div>
		</div>

		<form action="?search" method="get">
			<div class="row justify-content-center">
				<div class="col-lg-6 col-xl-5">
			
					<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
					<script src="https://vicopo.selfbuild.fr/vicopo.min.js"></script>
					<div class="form-floating mb-3">
						<input class="form-control"
						id="adresse" type="text" 
						name="adresse_annonce" 
						placeholder="Entrer une ville ou un code postal" 
						value="<?php if (isset($errors['value']['adresse_annonce'])) {	echo $errors['value']['adresse_annonce'];} ?>" />
						<ul>
							<!--Affichage de la liste à partir de 2 caractères saisis-->
							<li data-vicopo="#adresse" data-vicopo-click='{"#adresse": "code - ville"}'>
								<strong data-vicopo-code-postal></strong>
								<span data-vicopo-ville></span>
							</li>
						</ul>
						<label for="adresse">Adresse de l'annonce</label>
						<?php if (isset($errors['errors']['adresse_annonce'])) { ?>
							<div class="invalid-feedback"><?= $errors['errors']['adresse_annonce']; ?></div>
						<?php } ?>
					</div>
				</div>
				<div class="col-lg-6 col-xl-5"></div>
			</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-lg-4 col-xl-3">
					<!-- <div class="d-none" id="submitErrorMessage">
						<div class="text-center text-danger mb-3">Error sending message!</div>
					</div> -->
					<button class="btn btn-primary btn-lg" id="submitButton" name="submit" type="submit">Rechercher</button>
				</div>
			</div>
		</form>
	</div>
</section>

<?php
$content = ob_get_clean();
$pageTitle = "Recherche annonce";
$pageDescription = "Recherche annonce";
require(__DIR__ . '/template.php');
?>