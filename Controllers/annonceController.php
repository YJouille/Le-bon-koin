<?php
require_once (__DIR__ . '/../Models/AnnonceModel.php');

function searchAnnonces()
{
    // les annonces d'une categorie, les annonces d'un user ou une recherche passent par la méthode search du modele
    $annonceModel = new AnnonceModel();
    $annoncesList = $annonceModel->searchAnnonces();
    require_once (__DIR__ . '/../Views/listAnnoncesView.php');
    exit();
}

function listCategories()
{
    $annonceModel = new AnnonceModel();
    $listCategories = $annonceModel->listCategories();
    require_once (__DIR__ . '/../Views/home.php');
}

function newAnnonce()
{
    $annonceModel = new AnnonceModel();
    if (isset($_POST['submit'])) {

        $error = $annonceModel->newAnnonce();
        if ($error) {
            require_once (__DIR__ . '/../Views/newAnnonceView.php');
        } else {
            // renvoi vers detail annonce
            //header();
        }
    } else {
        $listCategories = $annonceModel->listCategories();
        require_once (__DIR__ . '/../Views/newAnnonceView.php');
    }
}