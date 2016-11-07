<?php

require_once('../modele/cours.php');
require_once ('../class/autoload.php');

$coursModele = new coursModele();

try {  

    $listCours = $coursModele->getCours($_GET['public'], $_GET['niveau']);
    
    $json = array();
    
    foreach ($listCours as $cours)
    {
        $json[] = array(
                'LIBELLE_NIVEAU' => $cours->LIBELLE_NIVEAU,
                'LIBELLE_JOUR' => $cours->LIBELLE_JOUR,
                'HEURE_DEBUT' => $cours->HEURE_DEBUT,
                'NOMBRE_PLACES_COURS' => $cours->NOMBRE_PLACES_COURS,
                'COMMENTAIRE_COURS' => $cours->COMMENTAIRE_COURS,
                'LIBELLE_PUBLIC' => $cours->LIBELLE_PUBLIC);
                
    }
        
    
} catch ( PDOException $pdoe ) {
    echo "ERREUR ! : <br/>" . $pdoe->getMessage ();
}
// redirection vers autre page ou vers la même page
echo json_encode($json);