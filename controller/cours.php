<?php

require_once('../modele/cours.php');
require_once('../modele/horaire.php');
require_once ('../class/autoload.php');

$coursModele = new coursModele();
$horaireModele = new horaireModele();

try {    
    // récupération des infos saisies nom et prenom
    //$heure = date("h:i", strtotime($_POST['timepicker']));
    $idHoraire = $horaireModele->getIdHoraire($_POST['jour'], $_POST['heure']);
    
    $coursModele->addCours($_POST['niveau'], $idHoraire, $_POST['nombreMax'], $_POST['commentaire']);
    
} catch ( PDOException $pdoe ) {
    echo "ERREUR ! : <br/>" . $pdoe->getMessage ();
}
// redirection vers autre page ou vers la même page
header('Location: /slam3/vue/cours.php');