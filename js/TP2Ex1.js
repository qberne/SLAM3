/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function valider()
{
    var valid = true;
    
    if (document.forms['formulaire'].elements["NomFamille"].value === "")
    {
        alert ("Veuillez entrer une votre nom !");
        valid = false;
    }
    else if (document.forms['formulaire'].elements["Prenom"].value === "")
    {
        alert ("Veuillez entrer une votre prenom !");
        valid = false;
    }
    else if (document.forms['formulaire'].elements["Age"].value === "")
    {
        alert ("Veuillez entrer une votre age !");
        valid = false;
    }
    else alert('Bonjour ' + document.forms['formulaire'].elements["NomFamille"].value + ' ' + document.forms['formulaire'].elements["Prenom"].value);
    
    return valid;
}