/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function() {
    
    $("#formCours").validate({
      rules: {
        niveau: "required",
        jour: "required",
        heure: "required",
        nombreMax: "required",
        commentaire: "required"
      },
      messages: {
        niveau: "Ce champ est requis",
        jour: "Ce champ est requis",
        heure: "Ce champ est requis",
        nombreMax: "Ce champ est requis",
        commentaire: "Ce champ est requis"
      }
    });
    
    function jsChargerHeure(element){
        var val = $(element).val(); // on récupère la valeur de la région
        
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
                    $('#heure').append('<option value="'+ value["HEURE_DEBUT"] +'">'+ value["HEURE_DEBUT"] +'</option>');
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
    }
    
    $('#jour').change(function(){
        jsChargerHeure(this);
    });
    
    jsChargerHeure('#jour');
});