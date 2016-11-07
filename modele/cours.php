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
    public function addCours($niveau, $idHoraire, $nombrePlacesMax, $commentaires, $public) {
        // ajoute un cours dans la BDD
        if ($this->obj) {
         
            //req sans prepare pour test
            //'INSERT INTO COURS(ID_NIVEAU, ID_HORAIRE, NOMBRE_PLACES_COURS, COMMENTAIRE_COURS) VALUES (' . $niveau . ', '. $idHoraire . ', ' .$nombrePlacesMax . ', \'' . $commentaires . '\');';
            //$this->obj->exec($req);
            
            
            $req = $this->obj->prepare('INSERT INTO COURS(ID_NIVEAU, ID_HORAIRE, NOMBRE_PLACES_COURS, COMMENTAIRE_COURS, ID_PUBLIC) VALUES (:niveau, :idHoraire, :nombre, :commentaires, :public);');
            $nb = $req->execute(array(
                'niveau' => $niveau,
                'idHoraire' => $idHoraire,
                'nombre' => $nombrePlacesMax,
                'commentaires' => $commentaires,
                'public' => $public));
            
        }
        return $nb;
 // si nb =1 alors l'insertion s est bien passee
    }
    
    public function getCours($public, $niveau)
    {
        if ($this->obj){
            
            $req = 'SELECT LIBELLE_NIVEAU, LIBELLE_JOUR, HEURE_DEBUT, NOMBRE_PLACES_COURS, COMMENTAIRE_COURS, LIBELLE_PUBLIC FROM COURS C INNER JOIN NIVEAU N ON N.ID_NIVEAU = C.ID_NIVEAU INNER JOIN HORAIRE H ON C.ID_HORAIRE = H.ID_HORAIRE INNER JOIN JOURS J ON H.ID_JOUR = J.ID_JOUR INNER JOIN PUBLIC P ON C.ID_PUBLIC = P.ID_PUBLIC';
            
            if ($public != -1 && $niveau != -1)
            {
                $req .= ' WHERE C.ID_PUBLIC LIKE '.$public . ' AND C.ID_NIVEAU LIKE '.$niveau;
            }
            else if ($niveau != -1)
            {
                $req .= ' WHERE C.ID_NIVEAU LIKE '.$niveau;
            }
            else if ($public != -1)
            {
                $req .= ' WHERE C.ID_PUBLIC LIKE '.$public;
            }
            
            return $this->obj->query($req);
            
        }
    }
    
    public function getCoursEnfantDispo($idEnfant)
    {
        if ($this->obj){
            return $this->obj->query('SELECT C.ID_COURS, LIBELLE_NIVEAU, LIBELLE_JOUR, HEURE_DEBUT, NOMBRE_PLACES_COURS, COMMENTAIRE_COURS '
            .'FROM COURS C INNER JOIN NIVEAU N ON N.ID_NIVEAU = C.ID_NIVEAU '
            .'INNER JOIN HORAIRE H ON C.ID_HORAIRE = H.ID_HORAIRE '
            .'INNER JOIN JOURS J ON H.ID_JOUR = J.ID_JOUR '
            .'WHERE C.ID_NIVEAU LIKE (SELECT ID_NIVEAU FROM ENFANT WHERE ID_ENFANT LIKE '.$idEnfant.') AND C.ID_COURS NOT IN (SELECT C.ID_COURS FROM COURS C INNER JOIN PARTICIPER P ON C.ID_COURS = P.ID_COURS WHERE ID_ENFANT LIKE '.$idEnfant.');');
        }
    }
    
    public function getCoursEnfantInscrit($idEnfant)
    {
        if ($this->obj){
            return $this->obj->query('SELECT C.ID_COURS, LIBELLE_NIVEAU, LIBELLE_JOUR, HEURE_DEBUT, NOMBRE_PLACES_COURS, COMMENTAIRE_COURS '
            .'FROM COURS C INNER JOIN NIVEAU N ON N.ID_NIVEAU = C.ID_NIVEAU '
            .'INNER JOIN HORAIRE H ON C.ID_HORAIRE = H.ID_HORAIRE '
            .'INNER JOIN JOURS J ON H.ID_JOUR = J.ID_JOUR '
            .'INNER JOIN PARTICIPER P ON C.ID_COURS = P.ID_COURS '
            .'WHERE P.ID_ENFANT LIKE '.$idEnfant.';');
        }
    }
}