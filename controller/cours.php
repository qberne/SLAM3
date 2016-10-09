<?php

require_once('../modele/cours.php');
require_once ('../class/connexion.class.php');

$modele = new coursModele();

try {
    // récupération des infos saisies nom et prenom
    $date = date("Y-m-d", strtotime($_POST['datepicker']));
    //$heure = date("h:i", strtotime($_POST['timepicker']));
    $modele->add($_POST['rb'], $date, 'dfsd', $_POST['heureMax'], $_POST['commentaire']);
} catch ( PDOException $pdoe ) {
    echo "ERREUR ! : <br/>" . $pdoe->getMessage ();
}
// redirection vers autre page ou vers la même page
header('Location: /slam3/vue/cours.php');