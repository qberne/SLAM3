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
            $req = $this->obj->prepare("INSERT INTO COURS(ID_NIVEAU, DATE_COURS, HEURE_COURS, NOMBRE_PLACES_COURS, COMMENTAIRE_COURS) VALUES (:niveau, :date, :heure, :nombre, :commentaires);");
            $nb = $req->execute(array(
                'niveau' => $niveau,
                'date' => $date,
                'heure' => $heure,
                'nombre' => $nombrePlacesMax,
                'commentaires' => $commentaires));
        }
        return $nb; // si nb =1 alors l'insertion s est bien passee
    }
}