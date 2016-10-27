<?php
class horaireModele {
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
    
    public function getHoraire($idJour)
    {
        if ($this->obj){
            /*$req = $this->obj->prepare('SELECT ID_HORAIRE AS "ID", HEURE_DEBUT AS "HEURE" FROM HORAIRE WHERE ID_JOUR LIKE :idJour;');
            return $req->execute(array('idJour' => $idJour));*/
            
            return $this->obj->query('SELECT HEURE_DEBUT FROM HORAIRE WHERE ID_JOUR LIKE '.$idJour);
        }
    }
    
    public function getIdHoraire($idJour, $heureDebut)
    {
        if ($this->obj){
            /*$req = $this->obj->prepare('SELECT ID_HORAIRE AS "ID", HEURE_DEBUT AS "HEURE" FROM HORAIRE WHERE ID_JOUR LIKE :idJour;');
            return $req->execute(array('idJour' => $idJour));*/
            
            $tabIdHoraire = $this->obj->query('SELECT ID_HORAIRE FROM HORAIRE WHERE ID_JOUR LIKE '.$idJour.' AND HEURE_DEBUT LIKE \''.$heureDebut.'\';');
            
            foreach ($tabIdHoraire as $horaire) $idHoraire = $horaire->ID_HORAIRE;
           
        }
        return $idHoraire;
    }
}