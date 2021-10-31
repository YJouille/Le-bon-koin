<?php
// categories list
ob_start();
?>

	<!-- Categories Section-->
	<section class="page-section portfolio" id="portfolio">
		<div class="container">
			<!-- Portfolio Section Heading-->
			<h2
				class="page-section-heading text-center text-uppercase text-secondary mb-0">Catégories</h2>
			<!-- Icon Divider-->
			<div class="divider-custom">
				<div class="divider-custom-line"></div>
				<div class="divider-custom-icon">
					<i class="fas fa-star"></i>
				</div>
				<div class="divider-custom-line"></div>
			</div>
			<!-- Portfolio Grid Items-->
			<div class="row justify-content-center">
				<!-- Portfolio Item 1-->
				<div class="col-md-6 col-lg-4 mb-5">
					<div class="portfolio-item mx-auto">
						<div
							class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
							<div
								class="portfolio-item-caption-content text-center text-white">
								<a href="?search&id_categorie=1">
									<i class="fas fa-arrow-circle-right fa-3x"></i><br>
									Immobilier
								</a>
							</div>
						</div>
						<img class="img-fluid" src="Assets/img/portfolio/immo.png"
							alt="..." />
					</div>
				</div>
				<!-- Portfolio Item 2-->
				<div class="col-md-6 col-lg-4 mb-5">
					<div class="portfolio-item mx-auto" data-bs-toggle="modal"
						data-bs-target="#portfolioModal2">
						<div
							class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
							<div
								class="portfolio-item-caption-content text-center text-white">
								<a href="?search&id_categorie=2"><i class="fas fa-arrow-circle-right fa-3x"></i><br>
									Voitures</a>
							</div>
						</div>
						<img class="img-fluid" src="Assets/img/portfolio/voitures.png"
							alt="..." />
					</div>
				</div>
				<!-- Portfolio Item 3-->
				<div class="col-md-6 col-lg-4 mb-5">
					<div class="portfolio-item mx-auto" data-bs-toggle="modal"
						data-bs-target="#portfolioModal3">
						<div
							class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
							<div
								class="portfolio-item-caption-content text-center text-white">
								<a href="?search&id_categorie=3"><i class="fas fa-arrow-circle-right fa-3x"></i><br>
									Multimédia</a>
							</div>
						</div>
						<img class="img-fluid" src="Assets/img/portfolio/multimedia.png"
							alt="..." />
					</div>
				</div>
			</div>
		</div>
	</section>


<?php 
$content = ob_get_clean();
$pageTitle = "Accueil";
require(__DIR__.'/template.php');
?>