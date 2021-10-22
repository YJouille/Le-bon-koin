<!-- Routeur qui indique quel controlleur appeler -->
<!-- ici le routeur est directement dans index.php, dans certains cas on l'appelle ici  -->
<?php
// session_start() crée une session ou restaure celle trouvée sur le serveur, via l'identifiant de session passé dans une requête GET, POST ou par un cookie.
session_start();
//Nous allons vérifier si une variable de session connected existe auquel cas on va laisser l'utilisateur accéder à cette page
// $_SESSION['connected']=true;

if(isset($_GET['login'])){
    require_once(__DIR__.'/Controllers/userController.php');
    login();
}

if (isset($_GET['signin'])){
   
    require_once(__DIR__.'/Controllers/userController.php');
}


if (isset($_SESSION['connected'])) {
          
    
    // if(isset($_GET['new'])){
    //     require_once(__DIR__.'/controllers/newController.php');
    // }else if(isset($_GET['update'])){
    //     require_once(__DIR__.'/controllers/updateController.php');
    // }else if(isset($_GET['delete'])){
    //     require_once(__DIR__.'/controllers/deleteController.php');
    // }else if (isset($_GET['logout'])){
    //     require_once(__DIR__.'/controllers/logoutController.php');
    // } else{
    //     require_once(__DIR__.'/controllers/listController.php');
    // }
}
//Sinon nous allons le rediriger vers le formulaire de connexion
else{   
    require(__DIR__ . '/Views/loginView.php');
}
?>