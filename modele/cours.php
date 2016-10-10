<?php
class coursModele {
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
    public function add($niveau, $date, $heure, $nombrePlacesMax, $commentaires) {
        // ajoute un cours dans la BDD
        $nb = 0;
        if ($this->obj) {
            
            /* req sans prepare pour test
            $req = 'INSERT INTO COURS(ID_NIVEAU, DATE_COURS, HEURE_COURS, NOMBRE_PLACES_COURS, COMMENTAIRE_COURS) VALUES (' . $niveau . ', STR_TO_DATE(\''. $date . '\', \'%d/%m/%Y\'), STR_TO_DATE(\'' . $heure . '\', \'%H : %i\'), ' .$nombrePlacesMax . ', \'' . $commentaires . '\');';
            $this->obj->query($req);
            */
            
            $req = $this->obj->prepare('INSERT INTO COURS(ID_NIVEAU, DATE_COURS, HEURE_COURS, NOMBRE_PLACES_COURS, COMMENTAIRE_COURS) VALUES (:niveau, STR_TO_DATE(:date, \'%d/%m/%Y\'), STR_TO_DATE(:heure, \'%H : %i\'), :nombre, :commentaires);');
            $nb = $req->execute(array(
                'niveau' => $niveau,
                'date' => $date,
                'heure' => $heure,
                'nombre' => $nombrePlacesMax,
                'commentaires' => $commentaires));
        }
        return $nb; // si nb =1 alors l'insertion s est bien passee
    }
    
    public function getCours()
    {
        if ($this->obj){
            return $this->obj->query('SELECT LIBELLE_NIVEAU, DATE_FORMAT(DATE_COURS, \'%d/%m/%Y\') AS "DATE_COURS", DATE_FORMAT(HEURE_COURS, \'%H:%i\') AS "HEURE_COURS", NOMBRE_PLACES_COURS, COMMENTAIRE_COURS FROM COURS C INNER JOIN NIVEAU N ON N.ID_NIVEAU = C.ID_NIVEAU;');
        }
    }
}