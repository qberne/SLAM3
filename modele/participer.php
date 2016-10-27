<?php
class participerModele {
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
    
    public function addParticipation($idCours, $idEnfant)
    {
        if ($this->obj){
            $result = $this->obj->prepare('INSERT INTO PARTICIPER VALUES(:idCours, :idEnfant);');
            $result->execute(array(
                'idCours' => $idCours,
                'idEnfant' => $idEnfant
            ));
        }    
    }
    
    public function delParticipation($idCours, $idEnfant)
    {
        if ($this->obj){
            $result = $this->obj->prepare('DELETE FROM PARTICIPER WHERE ID_COURS LIKE :idCours AND ID_ENFANT LIKE :idEnfant;');
            $result->execute(array(
                'idCours' => $idCours,
                'idEnfant' => $idEnfant
            ));
        }    
    }
}