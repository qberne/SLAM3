/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function() {
    
    $.datepicker.setDefaults($.datepicker.regional["fr"]);

    $("#datepicker").datepicker({
        showOtherMonths: true,
        selectOtherMonths: true,
        changeMonth: true,
        changeYear: true,
        minDate: '-17Y',
        maxDate: '-5Y',
    });
    
    $.validator.addMethod( "dateFR", function( value, element ) {
	return this.optional( element ) || /^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/.test( value );
    }, $.validator.messages.date );
    
    $.validator.addMethod( "heureFR", function( value, element ) {
	return this.optional( element ) || /^([0-9]|0[0-9]|1[0-9]|2[0-3]) : [0-5][0-9]$/.test( value );
    }, $.validator.messages.date );
    
    $.validator.addMethod( "telFR", function( value, element ) {
	return this.optional( element ) || /^(0|\+33)[1-9]([-. ]?[0-9]{2}){4}$/.test( value );
    }, $.validator.messages.date );

    $("#formCours").validate({
      rules: {
        rb: "required",
        datepicker: {
            required : true,
            dateFR: true
        },
        timepicker: {
            required : true,
            heureFR : true
        },
        heureMax: "required",
        commentaire: "required"
      },
      messages: {
        rb: "Ce champ est requis",
        datepicker: {
          required: "Ce champ est requis",
          dateFR: "La date n\'est pas valide"
        },
        timepicker: {
            required: "Ce champ est requis",
            heureFR: "Cette heure est invalide"
        },
        heureMax: "Ce champ est requis",
        commentaire: "Ce champ est requis"
      }
    });
    
    $("#formParents").validate({
      rules: {
        nom: "required",
        email: {
            required : true,
            email: true
        },
        mdp: {
            required: true,
            minlength: 8
        },
        mdpC: {
            equalTo: "#mdp"
        },
        prenom: "required",
        age: {
            required: true,
            min: 5,
            max: 17
        },
        datepicker: {
            required: true,
            dateFR: true
        },
        sexe: "required",
        tel: {
            required: true,
            telFR: true
        },
        competent: "required"
      },
      messages: {
        nom: "Ce champ est requis",
        email: {
          required: "Ce champ est requis",
          email: "Cet email n\'est pas valide"
        },
        mdp: {
            required: "Ce champ est requis",
            minlength: "Le mot de passe doit comporter au moins 8 caractères"
        },
        mdpC: {
            equalTo: "Les mots de passes ne correspondent pas"
        },
        prenom: "Ce champ est requis",
        age: {
            required: "Ce champ est requis",
            min: "L'âge minimal est 5 ans",
            max: "L'âge maximal est 17 ans"
        },
        datepicker: {
            required: "Ce champ est requis",
            dateFR: "La date n'est pas correcte"
        },
        sexe: "Ce champ est requis",
        tel: {
            required: "Ce champ est requis",
            telFR: "Ce numéro est incorrect"
        },
        competent: "Ce champ est requis"        
      },
        errorPlacement: function (error, element) {
        if (element.attr("type") == "radio") {
            if (element.attr("name") == "sexe") {
                error.insertAfter($('#errorSexe'));
            }
            else if (element.attr("name") == "competent") {
                 error.insertAfter($('#errorCompetent'));
            }
        }
        else{
            error.insertAfter(element);
        }
      }
    });
    
    $('#jours').change(function(){
        var val = $(this).val(); // on récupère la valeur de la région
        
        console.log(val);
        
        if(val !== "") {
            $('#heure').empty(); // on vide la liste des départements
            
            var filterDataRequest = $.ajax({
                url: '../controller/recupHeure.php',
                type: 'GET',
                data: 'idJour='+ val, // on envoie $_GET['IdRegion']
                dataType: 'json'
            });
            
            filterDataRequest.done(function(data) {                
                console.log("success");
                console.log(data);                
                $.each(data, function(index, value) {
                    $('#heure').append('<option value="'+ value["ID_HORAIRE"] +'">'+ value["HEURE_DEBUT"] +'</option>');
                });
            });
            
            filterDataRequest.fail(function(jqXHR, textStatus) {
                console.log( "error" );
                if (jqXHR.status === 0){alert("Not connect.n Verify Network.");}
                else if (jqXHR.status == 404){alert("Requested page not found.[404]");}
                else if (jqXHR.status == 500){alert("Internal Server Error [500].");}
                else if (textStatus === "parsererror"){alert("Requested JSON parsefailed.");}
                else if (textStatus === "timeout"){alert("Time out error.");}
                else if (textStatus === "abort"){alert("Ajax request aborted.");}
                else{alert("Uncaught Error.n" + jqXHR.responseText);}
            });
            
            filterDataRequest.always(function() {
                console.log( "complete" );
            });
        }// fin du if val est vide
    });
    
});