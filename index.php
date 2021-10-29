<?php
//  Routeur qui indique quel controlleur appeler
// ici le routeur est directement dans index.php, dans certains cas on l'appelle ici

error_reporting(E_ALL);
ini_set('display_errors',1);


// session_start() crée une session ou restaure celle trouvée sur le serveur, via l'identifiant de session passé dans une requête GET, POST ou par un cookie.
session_start();

//Nous allons vérifier si une variable de session connected existe auquel cas on va laisser l'utilisateur accéder à cette page
// $_SESSION['connected']=true;

require_once(__DIR__.'/Controllers/annonceController.php');

if (isset($_GET['search'])) {
    
    search();
    # code...
}else{
    //aucune action demandée, affichage de la page par defaut : categories sous forme de vignette
    
    listCategories();



}
?>