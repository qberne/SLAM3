<?php

include_once('../class/autoload.php');
require_once('../modele/enfant.php');

$pageConsultation = new page_base("TP4 Consultation");
$pageConsultation->script = 'jsAttributionCours';

$enfantModele = new enfantModele();

$listEnfants= $enfantModele->getEnfants(); //requête via le modele

$pageConsultation->corps = '
<section>
    <label>Liste des enfants :</label>
    <select id="listEnfants">';
//parcours du résultat de la requete

foreach ($listEnfants as $enfant){
    $pageConsultation->corps .= '<option value="'.$enfant->ID_ENFANT.'">'.$enfant->PRENOM_ENFANT.'</option>';
}

$pageConsultation->corps .= '</select><br/>
    <span id="coursDispo" class="row2">
    </span>
    <span id="coursInscrit" class="row2">
    </span>
</section>';

$listEnfants->closeCursor (); // pour libérer la mémoire occupée par le résultat de la requête
$listEnfants = null; // pour une autre exécution avec cette variable

$pageConsultation->afficher ();