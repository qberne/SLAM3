<?php

include_once('../class/autoload.php');
require_once('../modele/cours.php');

$pageInitiale = new page_base("TP2 EX1 Formulaire");
$pageInitiale->script = 'jsCours';

$modeleC = new coursModele ();
$listeJ = $modeleC->getJours(); // récupération via le modèle des jours
$listeNiv = $modeleC->getNiveaux();

$pageInitiale->corps = '
<form method="post" action="../controller/cours.php" name="formCours" id="formCours">
    <fieldset>
        <legend>Ajout d\'un cours</legend>
        <div>
            <label for="niveau">Niveau</label>
            <select id="niveau" name="niveau">';

foreach ($listeNiv as $niveau)
{
    $pageInitiale->corps .= '<option value="'.$niveau->ID_NIVEAU.'">'.$niveau->LIBELLE_NIVEAU.'</option>';
}

$pageInitiale->corps .= '</select>
        </div>
        <div>
            <label for="jour"> Jour de la semaine</label>
            <select id="jour" name="jour">';

foreach ($listeJ as $jours)
{
    $pageInitiale->corps .= '<option value="'.$jours->ID_JOUR.'">'.$jours->LIBELLE_JOUR.'</option>';
}

$pageInitiale->corps .= '</select>
        </div>
        <div>
            <label for="heure"> Horaire de début</label>
            <select id="heure" name="heure"></select>
        </div>
        <div>
            <label for="nombreMax"> Nombre max</label>
            <input type="number" id="nombreMax" name="nombreMax"/>
        </div>
        <div>
            <table id="com">
                <tr>
                    <td><label for="commentaire"> Commentaire</label></td>
                    <td><textarea type="text" id="commentaire" name="commentaire"></textarea></td>
                </tr>
            </table>
        </div>
    </fieldset>
    <input type="submit" value="Je m\'inscris" name="inscription" id="inscription" />
    <input type="reset" value="Effacer" name="effacement" id="effacement" />
</form>';

$listeJ->closeCursor();
$listeJ = null;

$listeNiv->closeCursor();
$listeNiv = null;

$pageInitiale->afficher();