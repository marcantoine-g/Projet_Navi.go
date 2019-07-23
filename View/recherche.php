<?php
    include_once "header.php" ;
?>
    <div class="row">
        <div id="partierecherche" class="col-md-12">  
            <input class="recherche" type="search" name="depart" placeholder="Départ" id="input_depart" value="<?php echo($depart) ?>" disabled="disabled"><br />
            <input class="recherche" type="search" name="arrivee" placeholder="Arrivée" id="input_arrivee" value="<?php echo($arrivee) ?>" disabled="disabled"><br />
        </div>
    
        <a id='btn_retour' class='btn_perso' href="./index.php?ctrl=default&amp;action=defaultPage" onclick="localStorage.clear()">
            Nouvelle Recherche
        </a>
        <p id='test'></p>
    </div>
<?php 
    include_once "footer.php";
?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
    const trajets = JSON.parse(localStorage.getItem('trajets'));

    var duree = "";
    var modeTransport = "";
    var color="";

        $.each(trajets, function(i, trajet) {
            duree = Math.round(trajet.duration / 60) + " minutes";
            document.getElementById("partierecherche").insertAdjacentHTML(
                "beforeend",
                "<div id='" + trajet.type + "' class='divTrajet'><div class='duree'>" + duree + "</div></div>"
            );
            document.getElementById(trajet.type).insertAdjacentHTML(
                "beforeend",
                "<img class='fleche' id='fleche_"+trajet.type+"' src='./img/triangledown.png' alt='flèche'/>"
            );
            str="<div class='align-middle icone'>";
            $.each(trajet.sections, function(i2, section) {
                modeTransport = "";
                if (section.mode === "walking") {
                    modeTransport += "<img class='personne' src='./img/marcher.svg' alt='personne qui marche'/>";
                }
                if (section.type === "public_transport") {
                    modeTransport += section.display_informations.code;
                    color = section.display_informations.color;
                }
                
                if(color!==""){
                    str+="<div class='divMoyenTransport divBulleLigne' style='background-color:#"+color+"; margin-right:0.2em'>" + modeTransport + "</div>"
                    color="";
                } else {
                    str+="<div class='divMoyenTransport' >" + modeTransport + "</div>";
                }
            });
            str+="</div>";
            document.getElementById(trajet.type).insertAdjacentHTML(
                         "afterbegin", 
                         str
                );
            str="";
        });
    

    var open = false;
    var listeFleche = document.getElementsByClassName("fleche");
    var derouleDetail = document.createElement('div');
    derouleDetail.className = "derouleDetail";
    derouleDetail.id = "derouleDetail";
    var departTime = "";
    var horaireArrivee = "";
    var idTrajet = "";
    var listMarkers = new Array();
    var group;
    var mymap = null;
    var horaireDepart;
    var horaireArrivee;
    var dureeTrajet;
    var stationDepart;
    var stationArrivee;

    $.each(listeFleche, function(i, fleche){
        fleche.addEventListener('click', afficheDetail);
    });

    
    function afficheDetail(e){
        idTrajet = e.target.id.slice(7);

        // Si déjà ouvert, on supprime le contenu et l'affichage
        if(open){
            open=!open;
            while(derouleDetail.firstChild){
                derouleDetail.removeChild(derouleDetail.firstChild);
            }
            e.target.parentNode.parentNode.removeChild(derouleDetail);

        // Si non on incrémente l'affichage des données nécessaires
        } else {
            open=!open;
            e.target.parentNode.insertAdjacentElement(
                "afterend",
                derouleDetail
            );
            var tabStations = new Array();
            $.each(trajets, function(i, trajet){
                if(trajet.type==idTrajet){
                    let longueurTableau  = trajet.sections.length; 
                    let index = 0;
                    let numeroMetro = null;
                    horaireDepart = trajet.sections[0].departure_date_time.slice(9,13);
                    horaireDepart = horaireDepart.slice(0,2)+':'+horaireDepart.slice(2,4);
                    dureeTrajet = Math.round(trajet.duration / 60);

                    $.each(trajet.sections, function(j, section){
                        index++;
                        let departTime = section.departure_date_time.slice(9,13);
                        departTime = departTime.slice(0,2)+":"+departTime.slice(2,4);
                        let nomStation = "";
                        let commentaire = "";
                        let iconePersonne = "";


                        if(section.type == "public_transport"){
                            tabStations.push(section.from.name);
                            nomStation = section.from.name;
                        }                       

                        if(nomStation != ""){
                            insertBeforeDetailRow(departTime, nomStation, "departTime", "nomStation");
                            if(section.type == "public_transport"){
                                if(numeroMetro != section.display_informations.code){
                                    numeroMetro = section.display_informations.code;
                                    colorMetro = section.display_informations.color; 
                                    insertBeforeDetailRow(
                                        "<div class='divBulleLigne' style='background-color:#"+colorMetro+"'>"+
                                        numeroMetro+"</div>",
                                        "Direction "+section.display_informations.direction,
                                        "",
                                        "commentaire"
                                    );
                                }
                            }
                        }

                        if(section.mode == "walking"){
                            commentaire = "Marcher jusqu'à "+section.to.name;
                            iconePersonne = "<img class='personne_petit' src='./img/marcher.svg' alt='personne qui marche'/>";

                        }

                        if (section.type == "transfer"){
                            nomStation = section.from.name;
                            commentaire = "Correspondance";
                        } 

                        if (commentaire != "" && index != longueurTableau){
                            if (nomStation != "" || index==1){
                                nomStation = section.from.name;
                                insertBeforeDetailRow(departTime, nomStation, "departTime", "nomStation");
                            }
                            if(iconePersonne != ""){
                                insertBeforeDetailRow(iconePersonne, commentaire, "personne_petit", "commentaire");
                            } else {
                                insertBeforeDetail(commentaire, "commentaire");
                            }
                        }

                        if(index == longueurTableau){
                            if(section.from.embedded_type == "stop_point"){
                                tabStations.push(section.from.name);
                            }
                            horaireArrivee = section.arrival_date_time.slice(9,13);
                            horaireArrivee = horaireArrivee.slice(0,2)+":"+horaireArrivee.slice(2,4);
                            nomStation = section.from.name;
                            insertBeforeDetailRow(departTime, nomStation, "departTime", "nomStation");
                            if(commentaire != "") {
                                if(iconePersonne != ""){
                                    insertBeforeDetailRow(iconePersonne, commentaire, "personne_petit", "commentaire");
                                } else {
                                    insertBeforeDetail(commentaire, "commentaire");
                                }
                            }
                            insertBeforeDetailRow(horaireArrivee, section.to.name, "departTime", "nomStation");

                            stationDepart = tabStations[0];
                            stationArrivee = tabStations[tabStations.length - 1 ];

                            addMap();
                        }


                    });
                    
                }
            });
        }
        
    }

    function insertBeforeDetail(data, classe){
        derouleDetail.insertAdjacentHTML(
            "beforeend",
            "<div class='"+classe+"'>"+data+"</div>"
        );
    }

    function insertBeforeDetailRow(data1, data2, classe1, classe2){
        derouleDetail.insertAdjacentHTML(
            "beforeend",
            "<div class='row' style='justify-content:center; margin:1em 0'> <div class='"+classe1+" col-2' style='padding:0'>"+data1+"</div> <div class='"+classe2+" col-10' style='padding:0'>"+data2+"</div></div>"
        );
    }

    function insertBeforeDetailRowCom(data1, data2, classe1, classe2){
        derouleDetail.insertAdjacentHTML(
            "beforeend",
            "<div class='row' style='justify-content:center; margin:auto'> <div class='"+classe1+"'>"+data1+"</div> <div class='"+classe2+"'>"+data2+"</div></div>"
        );
    }

    // Met la Map sur la position 
    function getMap(){
        currentId = document.getElementById("derouleDetail").previousSibling.id;
        $.each(trajets, function(i, trajet){
            if (trajet.type==currentId) {
                trajet.sections.forEach(section => {
                    if (section.type!="waiting"){

                        if(section.type=="public_transport"){
                            var arrayPoints = new Array();
                            section.geojson.coordinates.forEach(element => {
                                arrayPoints.push([element[1], element[0]]);
                            });
                            L.polyline(
                                arrayPoints,
                                {color:'#'+section.display_informations.color}
                            ).addTo(mymap);
                        }
                        
                        if(section.mode=="walking"){
                            if(section.from.address) {
                                var from = [section.from.address.coord.lat, section.from.address.coord.lon];
                                L.marker([section.from.address.coord.lat, section.from.address.coord.lon]).addTo(mymap).bindPopup(section.from.name);
                            }
                            if(section.from.stop_point){
                                var from = [section.from.stop_point.coord.lat, section.from.stop_point.coord.lon];
                                L.marker([section.from.stop_point.coord.lat, section.from.stop_point.coord.lon]).addTo(mymap).bindPopup(section.from.stop_point.name);
                            }
                            if(section.to.address) {
                                var to = [section.to.address.coord.lat, section.to.address.coord.lon];
                                L.marker([section.to.address.coord.lat, section.to.address.coord.lon]).addTo(mymap).bindPopup(section.to.name);
                            }
                            if(section.to.stop_point){
                                var to = [section.to.stop_point.coord.lat, section.to.stop_point.coord.lon];
                                L.marker([section.to.stop_point.coord.lat, section.to.stop_point.coord.lon]).addTo(mymap).bindPopup(section.to.stop_point.name);
                            }

                            L.polyline([
                                from, to
                            ], {color:'black',dashArray:10, opacity: 0.75 }).addTo(mymap);
                                
                        }
                    }
                });
            }

        });

        // Permet de centrer la map sur les markers 
        mymap.eachLayer(function(marker){
            if(marker._icon){
                listMarkers.push(marker);
            }
        });
        group = new L.featureGroup(listMarkers);
        mymap.fitBounds(group.getBounds());

        <?php if(isset($_SESSION)) { ?>
            addButton();
        <?php } ?>

    }

    // Ajout de la carte
    function addMap(){
            insertBeforeDetail(
                '<div id="map" style="width: 100%; height: 40vh;"></div>',
                'map'
            );
        // Initialise la Map
            mymap = L.map('map').setView([48.8534, 2.3488], 11);
                    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
                        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                        maxZoom: 18,
                        id: 'mapbox.streets',
                        accessToken: 'pk.eyJ1IjoibWFyY2FudG9pbmUiLCJhIjoiY2p3dWhuMm9rMGxtODRhazF0b3QxMWNiMyJ9.kw_7XG7uObJT_lXD4PUACA'
                    }).addTo(mymap);
        getMap();
    }

    // Ajout d'un bouton de validation du trajet pour les statistiques
    function addButton(){
        derouleDetail = document.getElementById('derouleDetail');
        derouleDetail.insertAdjacentHTML(
            "beforeend",
            "<button type='button' id='valide' class='btn_perso' onclick='valideTrajet()'> Valider ce trajet</button>"
        );
    }

    function valideTrajet(e){

        $.post('./index.php?ctrl=recherche&action=envoitBdd',
            {
                heureDepart: horaireDepart,
                heureArrivee: horaireArrivee,
                duree : dureeTrajet,
                stationDepart : stationDepart,
                stationArrivee : stationArrivee
            },
            function(data, status){
                alert(data);
            });
    }
</script>