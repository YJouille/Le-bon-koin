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


<section class="page-section annonce-view mb-0" id="about">
	<div class="container">
		<h2 class="page-section-heading text-center text-uppercase"><?= $annonce['titre_annonce'] ?></h2>
		<div class="divider-custom"></div>
		<div class="row">
			<div class="col-lg-4 ms-auto">
				<p>
					<em>Catégorie : </em><b><?= $listCategories[$annonce['id_categorie']] ?></b>
				</p>
				<p>
					<span>Vendeur : <?= $user['email_user'] ?><br> <a href="?search&id_user=<?= $user['id_user'] ?>">Voir les annonces du
							vendeur</a> <a href="mailto:<?= $user['email_user'] ?>" target="_blank" class="btn btn-primary">Contacter le vendeur</a></span>
				</p>
				<p class="lead ">
					<strong><?= $annonce['prix_annonce'] ?> €</strong>
				</p>
			</div>
			<div class="col-lg-4 m-auto">
				<p class="lead">
					<em><?= $annonce['desc_annonce'] ?></em>
				</p>
			</div>
		</div>

		<div class="row">

			<?php
			foreach ($annonce as $nom_critere => $valeur_critere) {
				if (strpos($nom_critere, 'critere_') === 0) {
			?>
					<div class="col-lg-4 m-auto text-center">
						<p>
							<b><?= $criteresNames[$nom_critere] ?> : </b><?= $valeur_critere ?>
						</p>
					</div>
			<?php
				}
			}
			?>
		</div>
		<div class="row">
			<div class="d-flex justify-content-center flex-wrap">
				<?php
				$files = scandir(__DIR__ . "/../Assets/img/annonces/");
				$i = 1;
				$imgs = false;
				foreach ($files as $file) {
					if (strpos($file, $annonce['id_annonce'] . "-" . $i) === 0) {
						$imagPath = "Assets/img/annonces/" . $file;
						$i++;
						$imgs = true;

				?>
						<div class="m-2" style="width: 18rem;">
							<img class="img-fluid rounded" style="height: 300px; object-fit: contain;" src="<?= $imagPath ?>" alt="<?= $annonce['titre_annonce'] ?>">
						</div>
					<?php
					}
				}
				if (!$imgs) {
					$imagPath = "Assets/img/annonces/no-pict.png";
					?>
					<div class="m-2" style="width: 18rem;">
						<img class="img-fluid rounded" style="height: 300px; object-fit: contain;" src="<?= $imagPath ?>" alt="<?= $annonce['titre_annonce'] ?>">
					</div>

				<?php
				}

				?>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-8 m-auto">
				<h5 class="text-center text-uppercase">Localisation</h5>
				<iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDVpf8cNScpvRrJzvbhjjkIuA_blKGFPlQ&q=<?= str_replace(' ', '+', $annonce['adresse_annonce']) ?>" width="100%" height="450" style="border: 0;" allowfullscreen="" loading="lazy"></iframe>
			</div>
		</div>

		<!-- Wrapper container -->
		<div class="container py-4">

			<!-- Bootstrap 5 starter form -->
			<form id="contactForm" data-sb-form-api-token="API_TOKEN">
			
				<!-- Email address input -->
				<div class="mb-3">
					<label class="form-label" for="emailAddress">Email Address</label>
					<input class="form-control" id="emailAddress" type="email" placeholder="Email Address" data-sb-validations="required, email" />
					<div class="invalid-feedback" data-sb-feedback="emailAddress:required">Email Address is required.</div>
					<div class="invalid-feedback" data-sb-feedback="emailAddress:email">Email Address Email is not valid.</div>
				</div>

				<!-- Message input -->
				<div class="mb-3">
					<label class="form-label" for="message">Message</label>
					<textarea class="form-control" id="message" type="text" placeholder="Message" style="height: 10rem;" data-sb-validations="required"></textarea>
					<div class="invalid-feedback" data-sb-feedback="message:required">Message is required.</div>
				</div>

				<!-- Form submissions success message -->
				<div class="d-none" id="submitSuccessMessage">
					<div class="text-center mb-3">Form submission successful!</div>
				</div>

				<!-- Form submissions error message -->
				<div class="d-none" id="submitErrorMessage">
					<div class="text-center text-danger mb-3">Error sending message!</div>
				</div>

				<!-- Form submit button -->
				<div class="d-grid">
					<button class="btn btn-primary btn-lg disabled" id="submitButton" type="submit">Submit</button>
				</div>

			</form>

		</div>

	</div>

</section>



<?php
$content = ob_get_clean();
$pageTitle = "Détail d'une annonce - " . $annonce['titre_annonce'];
require(__DIR__ . '/template.php');
?>