<?php
class niveauxModele {
    private $obj = null;
    public function __construct() {
        // creation de la connexion afin d'executer les requetes
        try {
            $Connexion = new connexion();
            $this->obj = $Connexion->IDconnexion;
        } catch ( PDOException $e ) {
            echo "<h1>probleme access BDD</h1>";
        }
    }
    
    public function getNiveaux()
    {
        if ($this->obj){
            return $this->obj->query('SELECT * FROM NIVEAU;');
        }    
    }

}