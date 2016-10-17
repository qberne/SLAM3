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
    public function add($niveau, $idJour, $heureDebut, $nombrePlacesMax, $commentaires) {
        // ajoute un cours dans la BDD
        if ($this->obj) {
            
            $idHoraire = $this->getIdHoraire($idJour, $heureDebut);
           
            //req sans prepare pour test
            //'INSERT INTO COURS(ID_NIVEAU, ID_HORAIRE, NOMBRE_PLACES_COURS, COMMENTAIRE_COURS) VALUES (' . $niveau . ', '. $idHoraire . ', ' .$nombrePlacesMax . ', \'' . $commentaires . '\');';
            //$this->obj->exec($req);
            
            
            $req = $this->obj->prepare('INSERT INTO COURS(ID_NIVEAU, ID_HORAIRE, NOMBRE_PLACES_COURS, COMMENTAIRE_COURS) VALUES (:niveau, :idHoraire, :nombre, :commentaires);');
            $nb = $req->execute(array(
                'niveau' => $niveau,
                'idHoraire' => $idHoraire,
                'nombre' => $nombrePlacesMax,
                'commentaires' => $commentaires));
            
        }
        return $nb;
 // si nb =1 alors l'insertion s est bien passee
    }
    
    public function getCours()
    {
        if ($this->obj){
            return $this->obj->query('SELECT LIBELLE_NIVEAU, LIBELLE_JOUR, HEURE_DEBUT, NOMBRE_PLACES_COURS, COMMENTAIRE_COURS FROM COURS C INNER JOIN NIVEAU N ON N.ID_NIVEAU = C.ID_NIVEAU INNER JOIN HORAIRE H ON C.ID_HORAIRE = H.ID_HORAIRE INNER JOIN JOURS J ON H.ID_JOUR = J.ID_JOUR;');
        }
    }
    
    public function getJours()
    {
        if ($this->obj){
            return $this->obj->query('SELECT * FROM JOURS WHERE ID_JOUR IN (SELECT ID_JOUR FROM HORAIRE);');
        }
    }
    
    public function getNiveaux()
    {
        if ($this->obj){
            return $this->obj->query('SELECT * FROM NIVEAU;');
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