    function addParticipation(idCours, idEnfant) {                
        var filterDataRequest = $.ajax({
            url: '../controller/attribution-cours.php',
            type: 'GET',
            data: 'action=2&idEnfant='+ idEnfant + '&idCours='+ idCours // on envoie $_GET['IdRegion']
        });

        filterDataRequest.done(function() {                
            console.log("success");
            jsRecupCours('#listEnfants');
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
    }
    
    function delParticipation(idCours, idEnfant) {                
        var filterDataRequest = $.ajax({
            url: '../controller/attribution-cours.php',
            type: 'GET',
            data: 'action=3&idEnfant='+ idEnfant + '&idCours='+ idCours // on envoie $_GET['IdRegion']
        });

        filterDataRequest.done(function() {                
            console.log("success");
            jsRecupCours('#listEnfants');
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
    }
    
    function jsRecupCours(element){
        var val = $(element).val(); // on récupère la valeur de la région
        
        console.log(val);
        
        if(val !== "") {
            $('#coursDispo').empty();
            $('#coursInscrit').empty();
            
            var dispo = '<h1>Cours disponnibles</h1><table border=1 id="tableauConsultation"><tr><th>Niveau</th><th>Jour</th><th>Heure</th><th>Nb</th><th>Com</th><th>Ajouter</th></tr>';
            var inscrit = '<h1>Cours inscrits</h1><table border=1 id="tableauConsultation"><tr><th>Niveau</th><th>Jour</th><th>Heure</th><th>Nb</th><th>Com</th><th>Retirer</th></tr>';           
            
            var filterDataRequest = $.ajax({
                url: '../controller/attribution-cours.php',
                type: 'GET',
                data: 'action=1&idEnfant='+ val, // on envoie $_GET['IdRegion']
                dataType: 'json'
            });
            
            filterDataRequest.done(function(data) {                
                console.log("success");
                console.log(data);
                $.each(data[0], function(index, value) {
                    dispo+='<tr><td>'+ value["LIBELLE_NIVEAU"] +'</td><td>'+ value["LIBELLE_JOUR"] +'</td><td>'+value["HEURE_DEBUT"]+'</td><td>'+value["NOMBRE_PLACES_COURS"]+'</td><td>'+value["COMMENTAIRE_COURS"]+'</td><td><a href="#" onclick="addParticipation('+value["ID_COURS"]+', '+$(element).val()+')"><img src="../img/add.png" alt="croix ajout"/></a></td></tr>';
                });

                $.each(data[1], function(index, value) {
                    inscrit+='<tr><td>'+ value["LIBELLE_NIVEAU"] +'</td><td>'+ value["LIBELLE_JOUR"] +'</td><td>'+value["HEURE_DEBUT"]+'</td><td>'+value["NOMBRE_PLACES_COURS"]+'</td><td>'+value["COMMENTAIRE_COURS"]+'</td><td><a href="#" onclick="delParticipation('+value["ID_COURS"]+', '+$(element).val()+')"><img src="../img/delete.png" alt="croix retirer"/></a></td></tr>'
                });
                $('#coursInscrit').append(inscrit+'</table>');
                $('#coursDispo').append(dispo+'</table>');
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
    
    $(function () {

    $('#listEnfants').change(function(){
        jsRecupCours(this);
    });
    
    jsRecupCours('#listEnfants');
});