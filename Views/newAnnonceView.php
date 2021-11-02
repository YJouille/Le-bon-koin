<?php
// page affichant la liste des annonces $annoncesList
ob_start();
?>
<section class="page-section new-annonce" id="contact">
	<div class="container">
		<h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">
			Déposer une annonce</h2>
		<div class="divider-custom">
			<div class="divider-custom-line"></div>
		</div>

		<form action="?new" method="post">
			<div class="row justify-content-center">
				<div class="col-lg-6 col-xl-5">

					<input type="hidden" name="id_user" value="<?= $_SESSION['connected'] ?>">

					<div class="form-floating mb-3">
						<input class="form-control" id="titre" type="text" name="titre_annonce" placeholder="Titre de l'annonce" value="<?php if (isset($errors['value']['titre_annonce'])) {
																																			echo $errors['value']['titre_annonce'];
																																		} ?>" />
						<label for="titre">Titre de l'annonce</label>
						<?php if (isset($errors['errors']['titre_annonce'])) { ?>
							<div class="invalid-feedback"><?= $errors['errors']['titre_annonce']; ?></div>
						<?php } ?>
					</div>
					<div class="form-floating mb-3">
						<textarea class="form-control" id="desc" name="desc_annonce" placeholder="Description de l'annonce" style="height: 10rem"><?php if (isset($errors['value']['desc_annonce'])) {
																																						echo $errors['value']['desc_annonce'];
																																					} ?></textarea>
						<label for="desc">Description de l'annonce</label>
						<?php if (isset($errors['errors']['desc_annonce'])) { ?>
							<div class="invalid-feedback"><?= $errors['errors']['desc_annonce']; ?></div>
						<?php } ?>
					</div>
					<div class="form-floating mb-3">
						<input class="form-control" id="prix" type="number" name="prix_annonce" placeholder="Prix" value="<?php if (isset($errors['value']['prix_annonce'])) {
																																echo $errors['value']['prix_annonce'];
																															} ?>" />
						<label for="prix">Prix</label>
						<?php if (isset($errors['errors']['prix_annonce'])) { ?>
							<div class="invalid-feedback"><?= $errors['errors']['prix_annonce']; ?></div>
						<?php } ?>
					</div>

					<!-- add js for zip codes -->
					<div class="form-floating mb-3">
						<input class="form-control" id="adresse" type="text" name="adresse_annonce" placeholder="Adresse de l'annonce" value="<?php if (isset($errors['value']['adresse_annonce'])) {
																																					echo $errors['value']['adresse_annonce'];
																																				} ?>" />
						<label for="adresse">Adresse de l'annonce</label>
						<?php if (isset($errors['errors']['adresse_annonce'])) { ?>
							<div class="invalid-feedback"><?= $errors['errors']['adresse_annonce']; ?></div>
						<?php } ?>
					</div>

				</div>
				<div class="col-lg-6 col-xl-5"></div>
			</div>

			<div class="row justify-content-center">
				<div class="col-lg-6 col-xl-5">
					<div class="form-floating mb-3">
						<select class="form-select" id="categorie" name="id_categorie" onchange="updateCategories();">
							<option value="0">---</option>
							<?php
							foreach ($listCategories as $categorie) {
							?>
								<option value="<?= $categorie['id_categorie']; ?>" <?php if (isset($errors['value']['id_categorie']) && ($categorie['id_categorie'] == $errors['value']['id_categorie'])) {
																						echo 'selected';
																					} ?>>
									<?php if (strlen($categorie['id_categorie']) > 1) echo '---'; ?>
									<?= $categorie['libelle_categorie']; ?></option>
							<?php } ?>
						</select> <label for="categorie">Catégorie de l'annonce</label>
						<?php if (isset($errors['errors']['id_categorie'])) { ?>
							<div class="invalid-feedback"><?= $errors['errors']['id_categorie']; ?></div>
						<?php } ?>
					</div>
				</div>

				<div class="col-lg-6 col-xl-5">
					<!-- immo -->
					<div class="form-floating mb-3" style="display: none;" id="type-de-bien">
						<select class="form-select" name="critere_type-de-bien">
							<option value="Maison">Maison</option>
							<option value="Appartement">Appartement</option>
						</select> <label for="type-de-bien">Type de bien</label>
					</div>
					<div class="form-floating mb-3" style="display: none;" id="surface">
						<input class="form-control" id="surface" type="number" name="critere_surface" placeholder="Surface" /> <label for="surface">Surface</label>
					</div>
					<div class="form-floating mb-3" style="display: none;" id="nombre-de-pieces">
						<input class="form-control" id="surface" type="number" name="critere_nombre-de-pieces" placeholder="Nombre de pièces" />
						<label for="nombre-de-pieces">Nombre de pièces</label>
					</div>

					<!-- consoles -->
					<div class="form-floating mb-3" style="display: none;" id="type">
						<select class="form-select" name="critere_type">
							<option value="Console">Console</option>
							<option value="Jeux">Jeux</option>
							<option value="Accessoires">Accessoires</option>
						</select> <label for="type">Type</label>
					</div>

					<!-- voitures -->
					<div class="form-floating mb-3" style="display: none;" id="marque">
						<input class="form-control" id="marque" type="text" name="critere_marque" placeholder="Marque" /> <label for="marque">Marque</label>
					</div>
					<div class="form-floating mb-3" style="display: none;" id="modele">
						<input class="form-control" id="modele" type="text" name="critere_modele" placeholder="Modèle" /> <label for="modele">Modèle</label>
					</div>
					<div class="form-floating mb-3" style="display: none;" id="km">
						<input class="form-control" id="km" type="number" name="critere_km" placeholder="Kms" /> <label for="km">Kms</label>
					</div>
					<div class="form-floating mb-3" style="display: none;" id="carburant">
						<select class="form-select" name="critere_carburant">
							<option value="Essence">Essence</option>
							<option value="Diesel">Diesel</option>
							<option value="Electrique">Electrique</option>
						</select> <label for="carburant">Carburant</label>
					</div>
					<div class="form-floating mb-3" style="display: none;" id="boite-de-vitesse">
						<select class="form-select" name="critere_boite-de-vitesse">
							<option value="Manuelle">Manuelle</option>
							<option value="Automatique">Automatique</option>
						</select> <label for="boite-de-vitesse">Boite de vitesse</label>
					</div>
					<div class="form-floating mb-3" style="display: none;" id="couleur">
						<input class="form-control" id="couleur" type="text" name="critere_couleur" placeholder="Couleur" /> <label for="couleur">Couleur</label>
					</div>
					<div class="form-floating mb-3" style="display: none;" id="nb-de-portes">
						<input class="form-control" id="nb-de-portes" type="number" name="critere_nb-de-portes" placeholder="Nombre de portes" /> <label for="nb-de-portes">Nombre de portes</label>
					</div>
					<div class="form-floating mb-3" style="display: none;" id="puissance">
						<input class="form-control" id="puissance" type="number" name="critere_puissance" placeholder="Puissance" /> <label for="puissance">Puissance</label>
					</div>
					<div class="form-floating mb-3" style="display: none;" id="nb-de-places">
						<input class="form-control" id="nb-de-places" type="number" name="critere_nb-de-places" placeholder="Nombre de places" /> <label for="nb-de-places">Nombre de places</label>
					</div>

					<!-- telephonie -->
					<div class="form-floating mb-3" style="display: none;" id="capacite-de-stockage">
						<input class="form-control" id="capacite-de-stockage" type="number" name="critere_capacite-de-stockage" placeholder="capacite-de-stockage" /> <label for="capacite-de-stockage">Capacité de stockage</label>
					</div>

					<!-- informatique -->
					
						<div class="form-floating mb-3" style="display: none;" id="etat">
						<button style="float: right" type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-placement="top" title="Guide de l'état" data-bs-target="#guideEtats">?</button>

							<select class="form-select" name="critere_etat">
								<option value="Neuf">Neuf</option>
								<option value="Très bon état">Très bon état</option>
								<option value="Bon état">Bon état</option>
								<option value="Etat satisfaisant">Etat satisfaisant</option>
								<option value="Pour pièces">Pour pièces</option>
							</select><label for="etat">Etat </label>

						</div>
					
					
					

				</div>
			</div>
			<!--Modale guide des états-->
			<div class="modal" id="guideEtats" tabindex="-1">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Guide de l'état du bien à vendre</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<ul>
								<li><strong>État neuf : </strong>Bien non-utilisé, complet, avec emballage non ouvert et notice(s) d’utilisation.</li>
								<li><strong>Très bon état : </strong>Bien pas ou peu utilisé, sans aucun défaut ni rayure, complet et en parfait état de fonctionnement.</li>
								<li><strong>Bon état : </strong>Bien en parfait état de fonctionnement, comportant quelques petits défauts (mentionnés
									dans l’annonce et visibles sur les photos).</li>
								<li><strong>État satisfaisant : </strong>Bien en état de fonctionnement correct, comportant des défauts et signes d’usure
									manifestes (mentionnés dans l’annonce et visibles sur les photos).</li>
								<li><strong>Pour pièces : </strong>Bien non fonctionnel, pour restauration complète ou récupération de pièces détachées.</li>
							</ul>
						</div>

						<div class="modal-footer">
							<button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fermer</button>
						</div>
					</div>
				</div>
			</div>
			<!--Fin modale guide des états-->


			<div class="row justify-content-center">
				<div class="col-lg-4 col-xl-3">
					<!-- <div class="d-none" id="submitErrorMessage">
						<div class="text-center text-danger mb-3">Error sending message!</div>
					</div> -->
					<button class="btn btn-primary btn-lg" id="submitButton" name="submit" type="submit">Déposer l'annonce</button>
				</div>
			</div>
		</form>

	</div>
</section>

<script type="text/javascript">
	function updateCategories() {
		// DOM elements
		var categoriesIds = new Array();
		categoriesIds['0'] = new Array();
		categoriesIds['1'] = ["type-de-bien", "surface", "nombre-de-pieces"];
		categoriesIds['2'] = ["marque", "modele", "km", "carburant", "boite-de-vitesse", "couleur", "nb-de-portes", "puissance", "nb-de-places"];
		categoriesIds['31'] = ["etat"];
		categoriesIds['32'] = ["type", "marque", "modele", "etat"];
		categoriesIds['33'] = ["marque", "modele", "couleur", "capacite-de-stockage", "etat"];
		categoriesIds.forEach((item, index) => {
			for (var j = 0; j < item.length; j++) {
				hide(item[j]);
			}
		})
		// display selected
		var categorie = document.getElementById('categorie');
		for (var j = 0; j < categoriesIds[categorie.value].length; j++) {
			display(categoriesIds[categorie.value][j]);
		}
	}

	function display(element) {
		var e = document.getElementById(element);
		e.style.display = "block";
	}

	function hide(element) {
		var e = document.getElementById(element);
		e.style.display = "none";
	}

	// first update if errors on form
	updateCategories();
</script>

<?php
$content = ob_get_clean();
$pageTitle = "Nouvelle annonce";
$pageDescription = "Nouvelle annonce";
require(__DIR__ . '/template.php');
?>