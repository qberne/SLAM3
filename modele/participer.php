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
            
            $placesDispo = false;
            $req = $this->obj->query('SELECT NOMBRE_PLACES_COURS-COUNT(ID_ENFANT) AS "PLACES" FROM COURS C LEFT JOIN PARTICIPER P ON P.ID_COURS = C.ID_COURS WHERE C.ID_COURS LIKE '.$idCours.';');
            foreach ($req as $tuple) if ($tuple->PLACES > 0) $placesDispo = true;
            
            if ($placesDispo)
            {
                $result = $this->obj->prepare('INSERT INTO PARTICIPER VALUES(:idCours, :idEnfant);');
                $result->execute(array(
                    'idCours' => $idCours,
                    'idEnfant' => $idEnfant
                ));
                return true;
            }
            else return false;
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