<?php

include_once('../class/autoload.php');

$pageInitiale = new page_base("TP2 EX1 Formulaire");

$pageInitiale->corps = '
<form method="post" action="../controller/inscription.php" name="formParents" id="formParents">
    <fieldset>
        <legend>Inscription</legend>
        <div>
            <label for="nom" class="formLabel">Votre Nom</label>
            <input type="text" name="nom"/>
        </div>
        <div>
            <label for="email" class="formLabel">Votre Email</label>
            <input type="text" name="email"/>
        </div>
        <div>
            <label for="mdp" class="formLabel">Confirmation</label>
            <input type="password" id="mdp" name="mdp"/>
        </div>
        <div>
            <label for="mdpC" class="formLabel">Mot de passe</label>
            <input type="password" name="mdpC"/>
        </div><br />
        <legend>Ajouter un enfant</legend><br />
        <div>
            <label for="prenom" class="formLabel"> Prénom</label>
            <input type="text" name="prenom" />
        </div>
        <div>
            <label for="datepicker" class="formLabel"> Date de naissance</label>
            <input type="text" id="datepicker" name="datepicker">
        </div>
        <div>
            <label for="sexe" class="formLabel"> Sexe</label>
            Garçon<input type="radio" name="sexe" value="1">
            Fille<input type="radio" name="sexe" value="0" id="errorSexe">
        </div>
        <div>
            <label for="tel" class="formLabel"> Téléphone</label>
            <input type="tel" name="tel"/>
        </div>
        <div>
            <label for="competent" class="formLabel"> Niveau Tennis</label>
        </div>
        <div>
            Débutant<input type="radio" name="competent" value="1"/>
            Perfectionnement<input type="radio" name="competent" value="2"/>
            Compétition<input type="radio" name="competent" value="3" id="errorCompetent"/>
        </div>
    </fieldset>
    <div>
        <input type="submit" value="Je m\'inscris" name="inscription" id="inscription" />
        <input type="reset" value="Effacer" name="effacement" id="effacement" />
    </div>
</form>';

if (isset($_POST['nom']))
{
    $pageInitiale->corps .= 'Nom : ' . $_POST['nom'] . '<br />'
            . 'Email : ' . $_POST['email'] . '<br />'
            . 'Mdp : ' . md5($_POST['mdp']) . '<br />';
}

$pageInitiale->afficher();