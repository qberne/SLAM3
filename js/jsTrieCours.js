    
    function jsRecupCours(){
        var public = $('#public').val();
        var niveau = $('#niveau').val();
        
            $('#tableauCours').empty();
            
            var cours = '<table border=1 id="tableauConsultation"><tr><th>Niveau </th><th>Jour</th><th>Heure</th><th>Nombre de places</th><th>Commentaire</th><th>Public</th></tr>';           
            
            var filterDataRequest = $.ajax({
                url: '../controller/trieCours.php',
                type: 'GET',
                data: 'public='+ public + '&niveau='+ niveau,
                dataType: 'json'// on envoie $_GET['IdRegion']
            });
            
            filterDataRequest.done(function(data) {                
                console.log("success");
                console.log(data);
                console.log(niveau);
                console.log(public);
                $.each(data, function(index, value) {
                    cours+='<tr><td>'+ value["LIBELLE_NIVEAU"] +'</td><td>'+ value["LIBELLE_JOUR"] +'</td><td>'+value["HEURE_DEBUT"]+'</td><td>'+value["NOMBRE_PLACES_COURS"]+'</td><td>'+value["COMMENTAIRE_COURS"]+'</td><td>'+value["LIBELLE_PUBLIC"]+'</td></tr>';
                });
                
                $('#tableauCours').append(cours);
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
    }