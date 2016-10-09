<?php

include_once('../class/page_base.class.php');

$pageInitiale = new page_base("TP2 EX1 Formulaire");

$pageInitiale->corps = '
<form method="post" action="../controller/cours.php" name="formCours" id="formCours">
    <fieldset>
        <legend>Ajout d\'un cours</legend>
        <label class="formLabel" id="error"> Niveau</label>
        <div class="fieldset content">
            <ul class="checkbox-grid">
                <li>            
                    <input type="radio" name="rb" value="1"/>
                    <label>Débutant</label>
                </li>
                <li>
                    <input type="radio" name="rb" value="2"/>
                    <label>Perfectionnement</label>
                </li>
                <li>
                    <input type="radio" name="rb" value="3"/>
                    <label>Compétition</label>
                </li>
            </ul>
        </div>
        <div>
            <label class="formLabel" for="datepicker"> Crenau</label>
            <input type="text" id="datepicker" name="datepicker">
        </div>
        <div>
            <label class="formLabel" for="timepicker"> Heure</label>
            <input type="text" id="timepicker" name="timepicker" class="timepicker"/>
        </div>
        <div>
            <label class="formLabel" for="heureMax"> Nombre max</label>
            <input type="number" id="heureMax" name="heureMax"/>
        </div>
        <div>
            <table id="com">
                <tr>
                    <td><label class="formLabel" for="commentaire"> Commentaire</label></td>
                    <td><textarea type="text" id="commentaire" name="commentaire"></textarea></td>
                </tr>
            </table>
        </div>
    </fieldset>
    <input type="submit" value="Je m\'inscris" name="inscription" id="inscription" />
    <input type="reset" value="Effacer" name="effacement" id="effacement" />
</form>';

if (isset($_POST['nom']))
{
    $pageInitiale->corps .= 'Nom : ' . $_POST['nom'] . '<br />'
            . 'Email : ' . $_POST['email'] . '<br />'
            . 'Mdp : ' . md5($_POST['mdp']) . '<br />';
}

$pageInitiale->afficher();