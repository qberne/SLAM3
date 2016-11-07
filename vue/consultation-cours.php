<?php

include_once('../class/autoload.php');
require_once('../modele/cours.php');
require_once('../modele/niveaux.php');
require_once('../modele/public.php');

$pageConsultation = new page_base("TP4 Consultation");

$modele = new coursModele();
$niveauxModele = new niveauxModele();
$publicModele = new publicModele();

$listCours= $modele->getCours(-1,-1); //requête via le modele
$listeNiv = $niveauxModele->getNiveaux();
$listPublic = $publicModele->getPublic();

$pageConsultation->script = 'jsTrieCours';

$pageConsultation->corps = '
<form action="javascript:jsRecupCours()">
<legend>Filtre</legend>
    <fieldset>
        <span>
            <label for="public">Public</label>
            <select id="public" name="public">
                <option value="-1">---</option>';
foreach ($listPublic as $public)
{
    $pageConsultation->corps .= '<option value="'.$public->ID_PUBLIC.'">'.$public->LIBELLE_PUBLIC.'</option>';
}

$pageConsultation->corps .= '</select>
        </span>
        <span>
            <label for="niveau">Niveau</label>
            <select id="niveau" name="niveau">
                <option value="-1">---</option>';

foreach ($listeNiv as $niveau)
{
    $pageConsultation->corps .= '<option value="'.$niveau->ID_NIVEAU.'">'.$niveau->LIBELLE_NIVEAU.'</option>';
}
$pageConsultation->corps .= '</select>
        </span>
    </fieldset>
    <div><input type="submit" value="envoyer"/></div>
</form>
<form>
<legend>Liste des cours</legend>
<div id="tableauCours">
    <table border=1 id="tableauConsultation">
    <tr>
        <th>Niveau </th>
        <th>Jour</th>
        <th>Heure</th>
        <th>Nombre de places</th>
        <th>Commentaire</th>
        <th>Public</th>
    </tr>';
//parcours du résultat de la requete

foreach ($listCours as $C){
    $pageConsultation->corps .= '<tr>'
            . '<td>'.$C->LIBELLE_NIVEAU.'</td>'
            . '<td>'.$C->LIBELLE_JOUR.'</td>'
            . '<td>'.$C->HEURE_DEBUT.'</td>'
            . '<td>'.$C->NOMBRE_PLACES_COURS.'</td>'
            . '<td>'.$C->COMMENTAIRE_COURS.'</td>'
            . '<td>'.$C->LIBELLE_PUBLIC.'</td>'
            . '</tr>';
}

$listCours->closeCursor (); // pour libérer la mémoire occupée par le résultat de la requête

$listCours = null; // pour une autre exécution avec cette variable

$pageConsultation->corps .= '</table></form></div>';

$pageConsultation->afficher ();