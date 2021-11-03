<?php
require_once ('Database.php');

class AnnonceModel extends Database
{

    // criteres en fonction des id des categories
    public $criteres = [
        "1" => [
            "type-de-bien",
            "surface",
            "nombre-de-pieces"
        ],
        "2" => [
            "marque",
            "modele",
            "km",
            "carburant",
            "boite-de-vitesse",
            "couleur",
            "nb-de-portes",
            "puissance",
            "nb-de-places"
        ],
        "31" => [
            "etat"
        ],
        "32" => [
            "type",
            "marque",
            "modele",
            "etat"
        ],
        "33" => [
            "marque",
            "modele",
            "couleur",
            "capacite-de-stockage",
            "etat"
        ]
    ];

    public function getCriteres()
    {
        return $this->criteres;
    }

    // get one annonce by id
    public function getAnnonce($idAnnonce)
    {
        $db = $this->connect();
        $sql = 'SELECT * FROM annonce WHERE id_annonce = :id_annonce';
        $query = $db->prepare($sql);
        $query->bindValue(':id_annonce', $idAnnonce, PDO::PARAM_INT);
        $query->execute();
        // get annonce
        $annonce = $query->fetch(PDO::FETCH_ASSOC);
        // add specific fields
        $sql = 'SELECT * FROM critere WHERE id_annonce = :id_annonce';
        $q = $db->prepare($sql);
        $q->bindValue(':id_annonce', $idAnnonce, PDO::PARAM_INT);
        $q->execute();
        // add each field
        if ($q->rowCount() > 0) {
            while ($field = $q->fetch(PDO::FETCH_ASSOC)) {
                $annonce['critere_'.$field['nom_critere']] = $field['valeur_critere'];
            }
        }
        return $annonce;
    }
    
    // list all annonces, search without critere
    // search annonces
    public function searchAnnonces()
    {
        $db = $this->connect();
        $tables = "annonce";
        $sql = '';
        // terms on titre and desc
        if (isset($_GET['terms'])) {
            $sql .= "AND (annonce.titre_annonce LIKE CONCAT('%', :terms_titre, '%') ";
            $sql .= "OR annonce.desc_annonce LIKE CONCAT('%', :terms_desc, '%') ";
        }
        // user
        if (isset($_GET['id_user'])) {
            $sql .= 'AND annonce.id_user = :id_user ';
        }
        // categorie
        if (isset($_GET['id_categorie'])) {
            $sql .= "AND annonce.id_categorie LIKE CONCAT(:id_categorie, '%') ";
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
                $tables .= ', critere ';
                $sql .= ' AND annonce.id_annonce = critere.id_annonce ';
                $sql .= ' AND critere.nom_critere = :nom_critere ';
                $sql .= ' AND critere.valeur_critere = :valeur_critere ';
            }
        }

        $sql = 'SELECT annonce.id_annonce FROM ' . $tables . ' WHERE 1=1 ' . $sql;
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

        // echo $query->debugDumpParams();
        // exit();

        $query->execute();
        $annonces = array();
        while ($annonceId = $query->fetch(PDO::FETCH_ASSOC)) {
            $annonce = $this->getAnnonce($annonceId['id_annonce']);
            array_push($annonces, $annonce);
        }
        return $annonces;
    }

    // insert new annonce
    public function newAnnonce()
    {
        // valid params
        $return = array();
        $return["errors"] = array();
        $return["value"] = array();
        @$titre_annonce = $_POST['titre_annonce'];
        if ($titre_annonce == "") {
            $return["errors"]['titre_annonce'] = "Le titre est obligatoire";
        } else {
            $return["value"]['titre_annonce'] = $titre_annonce;
        }
        @$desc_annonce = $_POST['desc_annonce'];
        if ($desc_annonce == "") {
            $return["errors"]['desc_annonce'] = "La description est obligatoire";
        } else {
            $return["value"]['desc_annonce'] = $desc_annonce;
        }
        @$prix_annonce = $_POST['prix_annonce'];
        if ($prix_annonce == "") {
            $return["errors"]['prix_annonce'] = "Le prix est obligatoire";
        } else {
            $return["value"]['prix_annonce'] = $prix_annonce;
        }
        @$adresse_annonce = $_POST['adresse_annonce'];
        if ($adresse_annonce == "") {
            $return["errors"]['adresse_annonce'] = "L'adresse est obligatoire";
        } else {
            $return["value"]['adresse_annonce'] = $adresse_annonce;
        }
        @$id_categorie = $_POST['id_categorie'];
        if (! isset($this->criteres[$id_categorie])) {
            $return["errors"]['id_categorie'] = "La catégorie est invalide";
            if ($id_categorie == '3') {
                $return["errors"]['id_categorie'] = "Veuillez choisir une sous-catégorie";
                $return["value"]['id_categorie'] = $id_categorie;
            }
        } else {
            $return["value"]['id_categorie'] = $id_categorie;
        }
        @$id_user = $_POST['id_user'];
        if (count($return["errors"]) > 0) {
            return $return;
        }
        $db = $this->connect();
        $sql = 'INSERT INTO annonce ( titre_annonce,  desc_annonce,  prix_annonce,  adresse_annonce,  id_categorie,  id_user)
                             VALUES (:titre_annonce, :desc_annonce, :prix_annonce, :adresse_annonce, :id_categorie, :id_user)';
        $query = $db->prepare($sql);
        $query->bindValue(':titre_annonce', $titre_annonce, PDO::PARAM_STR);
        $query->bindValue(':desc_annonce', $desc_annonce, PDO::PARAM_STR);
        $query->bindValue(':prix_annonce', $prix_annonce, PDO::PARAM_STR);
        $query->bindValue(':adresse_annonce', $adresse_annonce, PDO::PARAM_STR);
        $query->bindValue(':id_categorie', $id_categorie, PDO::PARAM_INT);
        $query->bindValue(':id_user', $id_user, PDO::PARAM_INT);
        $query->execute();
        // get new annonce id
        $annonceId = $db->lastInsertId();
        // for each additionals categorie fields, add new fields
        foreach ($this->criteres[$_POST['id_categorie']] as $critere) {
            if ($_POST['critere_' . $critere] != "") {
                // filter on key name (set in form)
                $sql = 'INSERT INTO critere ( id_annonce,  nom_critere,  valeur_critere)
                                     VALUES (:id_annonce, :nom_critere, :valeur_critere)';
                $q = $db->prepare($sql);
                $q->bindValue(':id_annonce', $annonceId, PDO::PARAM_INT);
                $q->bindValue(':nom_critere', $critere, PDO::PARAM_STR);
                $q->bindValue(':valeur_critere', $_POST['critere_' . $critere], PDO::PARAM_STR);
                $q->execute();
            }
        }

        // IMAGES INSERT
        $i = 1;
        if (isset($_POST['submit'])) {
            foreach ($_FILES['photos_annonce']['tmp_name'] as $file => $image) {
                $valid_formats = ["jpg", "png", "gif", "bmp"];
                $path = "./Assets/img/annonces/";
                $fileName = $_FILES['photos_annonce']['name'][$file];
                $tmpName = $_FILES['photos_annonce']['tmp_name'][$file];

                if (strlen($fileName)) {
                    $fileExt = "." . strtolower(substr(strrchr($fileName, '.'), 1));
                    if (!in_array($fileExt, $valid_formats)) {
                        $uniqueName = $annonceId.'-'.$i++ . $fileExt;
                        move_uploaded_file($tmpName, $path . $uniqueName);
                    }
                }
                if ($i==10){
                    break;
                }
            }
        }
        return false;
    }

    public function deleteAnnonce($idAnnonce)
    {
        $db = $this->connect();
        $sql = 'DELETE FROM annonce WHERE id_annonce = :id_annonce';
        $query = $db->prepare($sql);
        $query->bindValue(':id_annonce', $idAnnonce, PDO::PARAM_INT);
        $query->execute();
    }

    // update annonce ?????
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
        $categories = array();
        $sql = 'SELECT id_categorie, libelle_categorie FROM categorie';
        $query = $db->prepare($sql);
        $query->execute();
        while ($cat = $query->fetch(PDO::FETCH_ASSOC)) {
            $categories[$cat['id_categorie']] = $cat['libelle_categorie'];
        }
        return $categories;
    }
}