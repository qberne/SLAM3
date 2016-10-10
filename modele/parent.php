<?php
class parentModele {
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
    
    public function add($nom, $email, $mdp)
    {
        if ($this->obj) {
            
            /* req sans prepare pour test
            $req = 'INSERT INTO COURS(ID_NIVEAU, DATE_COURS, HEURE_COURS, NOMBRE_PLACES_COURS, COMMENTAIRE_COURS) VALUES (' . $niveau . ', STR_TO_DATE(\''. $date . '\', \'%d/%m/%Y\'), STR_TO_DATE(\'' . $heure . '\', \'%H : %i\'), ' .$nombrePlacesMax . ', \'' . $commentaires . '\');';
            $this->obj->query($req);
            */
            
            $req = $this->obj->prepare('INSERT INTO PARENT(NOM_PARENT, EMAIL_PARENT, MDP_PARENT) VALUES (:nom, :email, :mdp);');
            $req->execute(array(
                'nom' => $nom,
                'email' => $email,
                'mdp' => $mdp));
            
            return $this->obj->lastInsertId();
        }
    }
    
    public function getID($email){
        if ($this->obj){
            
            $req = $this->obj->query('SELECT ID_PARENT AS "ID" FROM PARENT WHERE EMAIL_PARENT LIKE \''.$email.'\';'); //TODO : prepare
            
            foreach ($req as $tuple)
            {
                $ID = $tuple->ID;
            }
        }
        return $ID;
    }
}
