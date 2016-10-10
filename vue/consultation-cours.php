<?php

include_once('../class/autoload.php');
require_once('../modele/cours.php');

$pageConsultation = new page_base("TP4 Consultation");
$modele = new coursModele();

$listCours= $modele->getCours(); //requête via le modele

$pageConsultation->corps = '<section>
<label>Liste des cours :</label>
<table border=1>
<tr>
    <th>Niveau </th>
    <th>Date</th>
    <th>Heure</th>
    <th>Nombre de places</th>
    <th>Commentaire</th>
</tr>';
//parcours du résultat de la requete

foreach ($listCours as $C){
    $pageConsultation->corps .= '<tr>'
            . '<td>'.$C->LIBELLE_NIVEAU.'</td>'
            . '<td>'.$C->DATE_COURS.'</td>'
            . '<td>'.$C->HEURE_COURS.'</td>'
            . '<td>'.$C->NOMBRE_PLACES_COURS.'</td>'
            . '<td>'.$C->COMMENTAIRE_COURS.'</td>'
            . '</tr>';
}

$listCours->closeCursor (); // pour libérer la mémoire occupée par le résultat de la requête

$listCours = null; // pour une autre exécution avec cette variable

$pageConsultation->corps .= '</table></section>';

$pageConsultation->afficher ();