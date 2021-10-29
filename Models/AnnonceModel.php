<?php
require_once ('Database.php');

class AnnonceModel extends Database
{

    // get one annonce by id
    public function getAnnonce($idAnnonce)
    {
        $db = $this->connect();
        $sql = 'SELECT * FROM annonce WHERE id_annonce = :id_annonce';
        $query = $db->prepare($sql);
        $query->bindValue(':id_annonce', $idAnnonce, PDO::PARAM_INT);
        $annonce = $query->execute();
        // get annonce
        $annonce = $query->fetch(PDO::FETCH_ASSOC);
        // add specific fields
        $sql = 'SELECT * FROM critere WHERE id_annonce = :id_annonce';
        $query = $db->prepare($sql);
        $query->bindValue(':id_annonce', $_GET['id_annonce'], PDO::PARAM_STR);
        $fields = $query->execute();
        // add each field
        foreach ($fields as $field) {
            $annonce[$field['nom_critere']] = $field['valeur_critere'];
        }
        return $annonce;
    }

    // list all annonces
    public function listAnnonces()
    {
        $db = $this->connect();
        $sql = 'SELECT * FROM annonce';
        $query = $db->prepare($sql);
        $query->execute();
        $annonces = array();
        // add specifics fields for each annonces
        while ($annonce = $query->fetch(PDO::FETCH_ASSOC)) {
            $sql = 'SELECT * FROM critere WHERE id_annonce = :id_annonce';
            $q = $db->prepare($sql);
            $q->bindValue(':id_annonce', $annonce['id_annonce'], PDO::PARAM_INT);
            $q->execute();
            // add each field
            while ($field = $q->fetch(PDO::FETCH_ASSOC)) {
                $annonce[$field['nom_critere']] = $field['valeur_critere'];
            }
            array_push($annonces, $annonce);
        }
        return $annonces;
    }

    // search annonces
    public function searchAnnonces()
    {
        $db = $this->connect();
        $sql = 'SELECT annonce.id_annonce FROM annonce, categorie, critere WHERE 1=1 ';
        // terms on titre and desc
        if (isset($_GET['terms'])) {
            $sql .= 'AND (annonce.titre_annonce LIKE %:terms_titre% ';
            $sql .= 'OR annonce.desc_annonce LIKE %:terms_desc%) ';
        }
        // user
        if (isset($_GET['id_user'])) {
            $sql .= 'AND annonce.id_user = :id_user ';
        }
        // categorie
        if (isset($_GET['id_categorie'])) {
            $sql .= 'AND annonce.id_categorie = :id_categorie ';
        }
        // prix
        // TODO '>prix' OR '<prix'
        if (isset($_GET['prix_annonce'])) {
            $sql .= 'AND annonce.prix_annonce = :prix_annonce ';
        }
        // adresse
        if (isset($_GET['adresse_annonce'])) {
            $sql .= 'AND annonce.adresse_annonce = :adresse_annonce ';
        }
        // Others criteres
        foreach ($_GET as $key => $value) {
            // filter on key name (set in form)
            if (strpos($key, 'critere_') === 0) {
                $sql .= ' AND annonce.id_annonce = critere.id_annonce ';
                $sql .= ' AND critere.nom_critere = :nom_critere ';
                $sql .= ' AND critere.valeur_critere = :valeur_critere ';
            }
        }

        $query = $db->prepare($sql);
        // bind param
        // terms on titre and desc
        if (isset($_GET['terms'])) {
            $query->bindValue(':terms_titre', $_GET['terms'], PDO::PARAM_STR);
            $query->bindValue(':terms_desc', $_GET['terms'], PDO::PARAM_STR);
        }
        // user
        if (isset($_GET['id_user'])) {
            $query->bindValue(':id_user', $_GET['id_user'], PDO::PARAM_INT);
        }
        // categorie
        if (isset($_GET['id_categorie'])) {
            $query->bindValue(':id_categorie', $_GET['id_categorie'], PDO::PARAM_INT);
        }
        // prix
        // TODO '>prix' OR '<prix'
        if (isset($_GET['prix_annonce'])) {
            $query->bindValue(':prix_annonce', $_GET['prix_annonce'], PDO::PARAM_STR);
        }
        // adresse
        if (isset($_GET['adresse_annonce'])) {
            $query->bindValue(':adresse_annonce', $_GET['adresse_annonce'], PDO::PARAM_STR);
        }
        // Others criteres
        foreach ($_GET as $key => $value) {
            // filter on key name (set in form)
            if (strpos($key, 'critere_') === 0) {
                $query->bindValue(':nom_critere', $_GET['critere_nom_critere'], PDO::PARAM_STR);
                $query->bindValue(':valeur_critere', $_GET['critere_valeur_critere'], PDO::PARAM_STR);
            }
        }

        //echo $query->debugDumpParams();
        $query->execute();
        $annonces = array();
        while ($annonceId = $query->fetch(PDO::FETCH_ASSOC)) {

            $annonce = $this->getAnnonce($annonceId); 
            array_push($annonces, $annonce);
        }
        return $annonces;
    }

    // insert new annonce
    public function addAnnonce()
    {
        $db = $this->connect();
        $sql = 'INSERT INTO annonce ( titre_annonce,  desc_annonce,  prix_annonce,  adresse_annonce,  id_categorie,  id_user)
                             VALUES (:titre_annonce, :desc_annonce, :prix_annonce, :adresse_annonce, :id_categorie, :id_user)';
        $query = $db->prepare($sql);
        $query->bindValue(':titre_annonce', $_POST['titre_annonce'], PDO::PARAM_STR);
        $query->bindValue(':desc_annonce', $_POST['desc_annonce'], PDO::PARAM_STR);
        $query->bindValue(':prix_annonce', $_POST['prix_annonce'], PDO::PARAM_STR);
        $query->bindValue(':adresse_annonce', $_POST['adresse_annonce'], PDO::PARAM_STR);
        // TODO test if valid categorie ?
        $query->bindValue(':id_categorie', $_POST['id_categorie'], PDO::PARAM_INT);
        // TODO test if valid user ?
        $query->bindValue(':id_user', $_POST['id_user'], PDO::PARAM_INT);
        $query->execute();
        // TODO : test or use lastInsertId()
        $tempAnnonce = $query->fetch(PDO::FETCH_ASSOC);
        // for each additionals fields, add new fields
        foreach ($_POST as $key => $value) {
            // filter on key name (set in form)
            if (strpos($key, 'critere_') === 0) {
                $sql = 'INSERT INTO critere ( id_annonce,  nom_critere,  valeur_critere)
                                     VALUES (:id_annonce, :nom_critere, :valeur_critere)';
                $q = $db->prepare($sql);
                $q->bindValue(':id_annonce', $tempAnnonce['id_annonce'], PDO::PARAM_INT);
                $q->bindValue(':nom_critere', $_POST['critere_nom_critere'], PDO::PARAM_STR);
                $q->bindValue(':valeur_critere', $_POST['critere_valeur_critere'], PDO::PARAM_STR);
                $q->execute();
            }
        }
    }

    public function deleteAnnonce($idAnnonce)
    {
        $db = $this->connect();
        $sql = 'DELETE FROM annonce WHERE id_annonce = :id_annonce';
        $query = $db->prepare($sql);
        $query->bindValue(':id_annonce', $idAnnonce, PDO::PARAM_INT);
        $query->execute();
    }

    // update annonce
    public function updateAnnonce()
    {
        $db = $this->connect();
        $sql = 'UPDATE annonce SET 
                    titre_annonce = :titre_annonce,
                    desc_annonce = :desc_annonce,
                    prix_annonce = :prix_annonce,
                    adresse_annonce = :adresse_annonce,  
                    id_categorie = :id_categorie  
                WHERE id_annonce = :id_annonce';
        $query = $db->prepare($sql);
        $query->bindValue(':titre_annonce', $_POST['titre_annonce'], PDO::PARAM_STR);
        $query->bindValue(':desc_annonce', $_POST['desc_annonce'], PDO::PARAM_STR);
        $query->bindValue(':prix_annonce', $_POST['prix_annonce'], PDO::PARAM_STR);
        $query->bindValue(':adresse_annonce', $_POST['adresse_annonce'], PDO::PARAM_STR);
        $query->bindValue(':id_annonce', $_POST['id_annonce'], PDO::PARAM_INT);
        // TODO test if valid categorie ?
        $query->bindValue(':id_categorie', $_POST['id_categorie'], PDO::PARAM_INT);
        $query->execute();
        // TODO : test or use lastInsertId()
        $tempAnnonce = $query->fetch(PDO::FETCH_ASSOC);
        // for each additionals fields, add new fields
        foreach ($_POST as $key => $value) {
            // filter on key name (set in form)
            if (str_starts_with($key, "critere_")) {
                $sql = 'INSERT INTO critere ( id_annonce,  nom_critere,  valeur_critere)
                                     VALUES (:id_annonce, :nom_critere, :valeur_critere)';
                $query = $db->prepare($sql);
                $query->bindValue(':id_annonce', $tempAnnonce['id_annonce'], PDO::PARAM_INT);
                $query->bindValue(':nom_critere', $_POST['critere_nom_critere'], PDO::PARAM_STR);
                $query->bindValue(':valeur_critere', $_POST['critere_valeur_critere'], PDO::PARAM_STR);
                $query->execute();
            }
        }
    }

    // list all categories
    public function listCategories()
    {
        $db = $this->connect();
        $sql = 'SELECT * FROM categorie';
        $query = $db->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}