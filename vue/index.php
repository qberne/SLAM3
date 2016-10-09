<?php

include_once('../class/page_base.class.php');

$pageInitiale = new page_base("TP2 EX1 Formulaire");

$pageInitiale->corps = '
<form method="post" action="#" name="formulaire" onsubmit="return valider(this)">
    <fieldset>
        <legend>Inscription</legend>
        <div>
            <label for="nom">Votre Nom</label>
            <input type="text" id="nom" name="nom" onblur ="verifChaine(this)"/>
        </div>
        <div>
            <label for="email">Votre Email</label>
            <input type="text" id="email" name="email" onblur="verifMail(this)"/>
        </div><div>
            <label for="mdp">Votre Mot de passe</label>
            <input type="password" id="mdp" name="mdp" onblur ="verifMotdepasse(this)"/>
        </div>
    </fieldset>
    <fieldset id="ajouter_enfant">
        <legend>Ajouter un enfant</legend>
        <div class="afficher"><a href="#ajouter_enfant">Ajouter un enfant</a></div>
        <div class="masquer"><a href="#">Fermer</a></div>
        <div>
            <label for="prenom"> Prénom</label>
            <input type="text" id="prenom" name="prenom" onblur ="verifChaine(this)" />
        </div>
        <div>
            <label for="age"> Age</label>
            <input type="number" id="age" name="age" onblur ="verifAge(this)" min="5" max="17" />
        </div>
        <div>
            <label for="datepicker"> Crénau</label>
            <input type="text" id="datepicker" name="datepicker">
        </div>
        <div>
            <label for="sexe"> Sexe</label>
            <input type="radio" name="sexeG" id="sexeG" value="homme">Garçon
            <input type="radio" name="sexeF" id="sexeF" value="femme">Fille
        </div>
        <div>
            <label for="tel"> Téléphone</label>
            <input type="tel" id="tel" name="tel" onblur ="verifTel(this)"/>
        </div>
        <div>
            <label for="competentD"> Niveau Tennis</label>
        </div>
        <div>
            Débutant<input type="checkbox" id="competentD" name="competentD" value="debutant"/>
            Perfectionnement<input type="checkbox" id="competentP" name="competentP" value="perfectionnement"/>
            Compétition<input type="checkbox" id="competentC" name="competentC" value="competition"/>
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