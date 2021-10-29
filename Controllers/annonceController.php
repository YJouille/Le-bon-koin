<?php
require_once(__DIR__ . '/../Models/AnnonceModel.php');

function search(){
    //les annonces d'une categorie, les annonces d'un user ou une recherche passent par la méthode search du modele

    $annonceModel = new AnnonceModel();
    $result = $annonceModel->searchAnnonces();
    include(__DIR__.'/../Views/listAnnoncesView.php');

    // require(__DIR__ . '/../views/listView.php');
    // exit;

}

function listCategories(){
    $annonceModel = new AnnonceModel();
    $listCategories = $annonceModel->listCategories();
    include(__DIR__.'/../Views/home.php');

}

