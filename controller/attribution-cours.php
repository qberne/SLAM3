<?php

require_once('../modele/cours.php');
require_once('../modele/participer.php');
require_once ('../class/autoload.php');

$coursModele = new coursModele();
$participerModele = new participerModele();

try {  

    if (isset($_GET['action']))
    {
        switch ($_GET['action'])
        {
            case 1:                              
                $listCoursDispo = $coursModele->getCoursEnfantDispo($_GET['idEnfant']);

                $listCoursInscrit = $coursModele->getCoursEnfantInscrit($_GET['idEnfant']);

                $json = array();

                $json[0] =  array();  
                $json[1] = array();

                foreach ($listCoursDispo as $cours) //TODO : function
                {
                    $json[0][] = array(
                        'ID_COURS' => $cours->ID_COURS,
                        'LIBELLE_NIVEAU' => $cours->LIBELLE_NIVEAU,
                        'LIBELLE_JOUR' => $cours->LIBELLE_JOUR,
                        'HEURE_DEBUT' => $cours->HEURE_DEBUT,
                        'NOMBRE_PLACES_COURS' => $cours->NOMBRE_PLACES_COURS,
                        'COMMENTAIRE_COURS' => $cours->COMMENTAIRE_COURS
                    );
                }

                foreach ($listCoursInscrit as $cours)
                {
                    $json[1][] = array(
                        'ID_COURS' => $cours->ID_COURS,
                        'LIBELLE_NIVEAU' => $cours->LIBELLE_NIVEAU,
                        'LIBELLE_JOUR' => $cours->LIBELLE_JOUR,
                        'HEURE_DEBUT' => $cours->HEURE_DEBUT,
                        'NOMBRE_PLACES_COURS' => $cours->NOMBRE_PLACES_COURS,
                        'COMMENTAIRE_COURS' => $cours->COMMENTAIRE_COURS
                    );
                } 
                break;
            case 2:                
                $participerModele->addParticipation($_GET['idCours'], $_GET['idEnfant']);                
                break;
            case 3:                
                $participerModele->delParticipation($_GET['idCours'], $_GET['idEnfant']);                
                break;
        }        
    }
        
    
} catch ( PDOException $pdoe ) {
    echo "ERREUR ! : <br/>" . $pdoe->getMessage ();
}
// redirection vers autre page ou vers la même page
echo json_encode($json);