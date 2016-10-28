<?php
class enfantModele {
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
    public function addEnfant($parent, $niveau, $prenom, $date, $sexe, $tel)
    {
        $nb = 0;
        if ($this->obj) {
            
            /* req sans prepare pour test
            $req = 'INSERT INTO COURS(ID_NIVEAU, DATE_COURS, HEURE_COURS, NOMBRE_PLACES_COURS, COMMENTAIRE_COURS) VALUES (' . $niveau . ', STR_TO_DATE(\''. $date . '\', \'%d/%m/%Y\'), STR_TO_DATE(\'' . $heure . '\', \'%H : %i\'), ' .$nombrePlacesMax . ', \'' . $commentaires . '\');';
            $this->obj->query($req);
            */
            
            $req = $this->obj->prepare('INSERT INTO ENFANT(ID_PARENT, ID_NIVEAU, PRENOM_ENFANT, DATE_ENFANT, SEXE_ENFANT, TEL_ENFANT) VALUES (:parent, :niveau, :prenom, STR_TO_DATE(:date, \'%d/%m/%Y\'), :sexe, :tel);');
            $nb = $req->execute(array(
                'parent' => $parent,
                'niveau' => $niveau,
                'prenom' => $prenom,
                'date' => $date,
                'sexe' => $sexe,
                'tel' => $tel));
        }
        return $nb; // si nb =1 alors l'insertion s est bien passee
    }
    
    public function getEnfants()
    {
        if ($this->obj) {
            
            /* req sans prepare pour test
            $req = 'INSERT INTO COURS(ID_NIVEAU, DATE_COURS, HEURE_COURS, NOMBRE_PLACES_COURS, COMMENTAIRE_COURS) VALUES (' . $niveau . ', STR_TO_DATE(\''. $date . '\', \'%d/%m/%Y\'), STR_TO_DATE(\'' . $heure . '\', \'%H : %i\'), ' .$nombrePlacesMax . ', \'' . $commentaires . '\');';
            $this->obj->query($req);
            */
            
            $req = $this->obj->query('SELECT ID_ENFANT, PRENOM_ENFANT FROM ENFANT');
        }
        return $req;
    }
    
    public function getEnfant($idEnfant)
    {
        if ($this->obj) {
            
            /* req sans prepare pour test
            $req = 'INSERT INTO COURS(ID_NIVEAU, DATE_COURS, HEURE_COURS, NOMBRE_PLACES_COURS, COMMENTAIRE_COURS) VALUES (' . $niveau . ', STR_TO_DATE(\''. $date . '\', \'%d/%m/%Y\'), STR_TO_DATE(\'' . $heure . '\', \'%H : %i\'), ' .$nombrePlacesMax . ', \'' . $commentaires . '\');';
            $this->obj->query($req);
            */
            
            $req = $this->obj->query('SELECT PRENOM_ENFANT, DATE_FORMAT(DATE_ENFANT, \'%d/%m/%Y\') AS "DATE_NAISSANCE", SEXE_ENFANT, TEL_ENFANT, LIBELLE_NIVEAU FROM ENFANT E INNER JOIN NIVEAU N ON E.ID_NIVEAU = N.ID_NIVEAU WHERE ID_ENFANT LIKE '.$idEnfant.';');
        }
        return $req;
    }
}