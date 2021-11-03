<?php
require_once ('Database.php');

class UserModel extends Database
{

    public function login($nom, $pwd)
    {

        // On écrit la requête
        $sql = 'SELECT * FROM user WHERE nom_user = :nom_user';
        $db = $this->connect();
        // On prépare la requête
        $query = $db->prepare($sql);
        // On injecte (terme scientifique) les valeurs
        $query->bindValue(':nom_user', $nom, PDO::PARAM_STR);
        // On exécute la requête
        $user = $query->execute();
        // echo $query->debugDumpParams();
        $user = $query->fetch(PDO::FETCH_ASSOC);

        // Première étape nous allons vérifier si l'utlisateur existe bel et bien
        if (! $user) {
            echo 'Désolé cet utilisateur n\'existe pas!';
        } else {
            // On utilise password_verify pour s'assurer que le mot de passe saisie est bien celui que nous avons en crypté dans la base de données
            if (password_verify($pwd, $user['pwd_user'])) {
                // Si c'est bon nous créons notre variable de session et faisons la redirection.
                $_SESSION['connected'] = $user['id_user'];
            } else {
                echo 'Le mot de passe est invalide.';
            }
        }
    }

    public function signin($login, $mail, $pwd)
    {
        // On écrit la requête
        $sql = 'INSERT INTO user (nom_user, email_user, pwd_user) VALUES (:nom_user, :email_user, :pwd_user)';
        // On prépare la requête
        $db = $this->connect();
        $query = $db->prepare($sql);
        // On injecte (terme scientifique) les valeurs
        $query->bindValue(':nom_user', $login, PDO::PARAM_STR);
        $query->bindValue(':email_user', $mail, PDO::PARAM_STR);
        $query->bindValue(':pwd_user', $pwd, PDO::PARAM_STR);
        // On exécute la requête
        $query->execute();
    }

    function getUser($userId)
    {
        // On écrit la requête
        $sql = 'SELECT * FROM user WHERE id_user = :id_user';
        $db = $this->connect();
        // On prépare la requête
        $query = $db->prepare($sql);
        // On injecte (terme scientifique) les valeurs
        $query->bindValue(':id_user', $userId, PDO::PARAM_INT);
        // On exécute la requête
        $user = $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

  
}

