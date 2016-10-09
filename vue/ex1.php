<?php

include_once('class/page_base.class.php');

$pageInitiale = new page_base("TP2 EX1 Formulaire");

$pageInitiale->corps = '
<form action="#" name="formulaire" onsubmit="return valider ();">
<table cellspacing="2" cellpadding="2" border="0">
<tr>
<td align="right">Nom de famille</td>
<td><input type="text" name="NomFamille"></td>
</tr>
<tr>
<td align="right">Prenom</td>
<td><input type="text" name="Prenom"></td>
</tr>
<tr>
<td align="right">Âge</td>
<td><input type="text" name="Age"></td>
</tr>
<tr>
<td align="right">Adresse</td>
<td><textarea cols="20" rows="5" name="Adresse"></textarea></td>
</tr>
<tr>
<td align="right"></td>
<td><input type="submit" value="Soumettre"></td>
<td><input type="reset" value="Effacer"></td>
</tr>
</table>
</form>';

$pageInitiale->corps .= '
</br></br>FIN !!!
</br></br>';

$pageInitiale->afficher();
