<?php
// page affichant la liste des annonces $annoncesList
ob_start();
?>


<section class="page-section" id="contact">
	<div class="container">
		<h2
			class="page-section-heading text-center text-uppercase text-secondary mb-0">
			Connexion</h2>

		<div class="divider-custom">
			<div class="divider-custom-line"></div>
		</div>

		<div class="row justify-content-center">
			<div class="col-lg-8 col-xl-7">
				<form action="?login" method="post">


					<div class="form-floating mb-3">
						<input class="form-control" id="nom" name="nom" type="text"
							placeholder="Nom d'utilisateur" required="required" /> <label
							for="nom">Nom d'utilisateur</label>
					</div>


					<div class="form-floating mb-3">
						<input class="form-control" id="pwd" name="pwd" type="password"
							placeholder="Mot de passe" required="required" /> <label
							for="pwd">Mot de passe</label>
					</div>

					<!-- <div class="d-none" id="submitErrorMessage">
						<div class="text-center text-danger mb-3">Error sending message!</div>
					</div> -->
					
					<div class="text-center"><button class="btn btn-primary btn-xl" id="submitButton"
						type="submit">Se connecter</button>
						
						<a href="?signin">Pas encore inscrit ?</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>


<?php
$content = ob_get_clean();
$pageTitle = "Connexion";
$pageDescription= "Page de connexion pour site du bon koin";
require (__DIR__ . '/template.php');
?>

