<?php

require_once('../modele/cours.php');
require_once ('../class/connexion.class.php');

$modele = new coursModele();

try {
    // récupération des infos saisies nom et prenom
    //$heure = date("h:i", strtotime($_POST['timepicker']));
    $modele->add($_POST['rb'], $_POST['datepicker'], $_POST['timepicker'], $_POST['heureMax'], $_POST['commentaire']);
} catch ( PDOException $pdoe ) {
    echo "ERREUR ! : <br/>" . $pdoe->getMessage ();
}
// redirection vers autre page ou vers la même page
header('Location: /slam3/vue/cours.php');