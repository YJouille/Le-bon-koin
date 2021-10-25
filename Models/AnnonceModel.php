<?php
require_once('Database.php');
class AnnonceModel extends Database
{
    public function listAnnonce()
    {
        try {
            $annonce = $this->connect()->prepare('');
            $annonce->execute();
            //echo $annonce->debugDumpParams();
            $result = $annonce->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC to have the same keys as in the database
            $annonce->closeCursor();
            return $result;
        } catch (Exception $e) {
            //$GLOBALS['errorMessage'] = 2;
            //die('Erreur : ' . $e->getMessage());
        }
    }

}