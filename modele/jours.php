<?php
class joursModele {
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
    
    public function getJours()
    {
        if ($this->obj){
            return $this->obj->query('SELECT * FROM JOURS WHERE ID_JOUR IN (SELECT ID_JOUR FROM HORAIRE);');
        }
    }
}