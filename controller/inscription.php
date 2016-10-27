<?php

require_once('../modele/enfant.php');
require_once('../modele/parent.php');
require_once ('../class/connexion.class.php');

$modeleE = new enfantModele();
$modeleP = new parentModele();

try {
    
    $ID_PARENT = $modeleP->getIDParent($_POST['email']); //recupération du parent inscrit
    
    if ($ID_PARENT == '') //si parent non inscrit
    {
        $ID_PARENT = $modeleP->addParent($_POST['nom'], $_POST['email'], md5($_POST['mdp'])); //ajout du parent et recup de l'id
    }
    
    $modeleE->addEnfant($ID_PARENT, $_POST['niveau'], $_POST['prenom'], $_POST['datepicker'], $_POST['sexe'], $_POST['tel']); //ajout de l'enfant
    
} catch ( PDOException $pdoe ) {
    echo "ERREUR ! : <br/>" . $pdoe->getMessage();
}
// redirection vers autre page ou vers la même page
header('Location: /slam3/vue/index.php');