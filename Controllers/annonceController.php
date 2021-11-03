<?php
require_once (__DIR__ . '/../Models/AnnonceModel.php');
$annonceModel = new AnnonceModel();

function viewAnnonce()
{
    global $annonceModel;
    // les annonces d'une categorie, les annonces d'un user ou une recherche passent par la méthode search du modele
    $annonce = $annonceModel->getAnnonce($_GET['id_annonce']);
    $listCategories = $annonceModel->listCategories();
    require_once (__DIR__ . '/../Views/annonceView.php');
    exit();
}

function searchAnnonces()
{
    global $annonceModel;
    // les annonces d'une categorie, les annonces d'un user ou une recherche passent par la méthode search du modele
    $annoncesList = $annonceModel->searchAnnonces();
    require_once (__DIR__ . '/../Views/listAnnoncesView.php');
    exit();
}

function listCategories()
{
    global $annonceModel;
    $listCategories = $annonceModel->listCategories();
    require_once (__DIR__ . '/../Views/home.php');
}

function newAnnonce()
{
    global $annonceModel;
    $listCategories = $annonceModel->listCategories();
    if (isset($_POST['submit'])) {
        $errors = $annonceModel->newAnnonce();
        if ($errors) {
            require_once (__DIR__ . '/../Views/newAnnonceView.php');
        } else {
            require_once (__DIR__ . '/../Views/home.php');
        }
    } else {
        require_once (__DIR__ . '/../Views/newAnnonceView.php');
    }
}