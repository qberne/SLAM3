<?php

require_once ('../class/autoload.php');
require_once('../modele/horaire.php');

$horaireModele = new horaireModele();

if (isset($_GET['idJour'])){

    $listeH = $horaireModele->getHoraire($_GET['idJour']);
    
    $tabH = array();
    
    foreach($listeH as $H) {        
        $tabH[] = array(
            'ID_HORAIRE' => $H->ID_HORAIRE,
            'HEURE_DEBUT' => $H->HEURE_DEBUT
        );
        
    }

    $listeH->closeCursor ();
    //pour libérer la mémoire occupée par le résultat de la requête
    $listeH = null; // pour une autre exécution avec cette variable

}
// envoi du résultat au success
echo json_encode($tabH);