<?php

require_once('../modele/cours.php');
require_once ('../class/autoload.php');

$modele = new coursModele();

try {    
    // récupération des infos saisies nom et prenom
    //$heure = date("h:i", strtotime($_POST['timepicker']));
    $modele->add($_POST['niveau'], $_POST['jour'], $_POST['heure'], $_POST['nombreMax'], $_POST['commentaire']);
} catch ( PDOException $pdoe ) {
    echo "ERREUR ! : <br/>" . $pdoe->getMessage ();
}
// redirection vers autre page ou vers la même page
header('Location: /slam3/vue/cours.php');