<?php
include_once "header.php"
?>

<div class="row">
    <div id="partieaccueil" class="col-md-12">

        <div id="map" style="width: 100%; height: 40vh;"></div>

        <form action="index.php?ctrl=recherche&action=recherchePage" method="post" name="myform">

            <div class="recherche">
                <input class="recherche2" type="search" name="depart" placeholder="Départ" id="input_depart" value="" required>
                
                    
                        <?php if(isset($_SESSION['mail'])){ 
                            echo ("
                        <button class='boutonfav' type='button' style='border: 0; background: transparent' id='bouton_depart' onclick='afficheDepartFavoris()'> <img class='favoris' src='./img/favori.svg' alt='favori' /> </button>    
                        <select id='select_depart' style='visibility:hidden;'>
                            <option></option>
                            <option id='depart1'>".$departFavori1['stationPreferee']."</option>
                            <option id='depart2'>".$departFavori2['stationPreferee2']."</option>
                        </select>
                        ");
                } ?>
                    
            </div>



            <br />
            <div class="recherche"> 
                <input class="recherche2" type="search" name="arrivee" placeholder="Arrivée" id="input_arrivee" value="" required>
                <?php if(isset($_SESSION['mail'])){
                    echo("
                    
                <button class='boutonfav' type='button' style='border: 0; background: transparent' onclick='afficheArriveesFavorites()'> <img src='./img/favori.svg' class='favoris' alt='favori' /> </button>
                        <select id='select_arrivee' style='visibility:hidden;'>
                            <option></option>
                            <option id='arrivee1'>".$arretFavori1['stationPreferee']."</option>
                            <option id='arrivee2'>".$arretFavori2['stationPreferee2']."</option>
                        </select>
                    ");
                } ?>
            </div>


            <br />                
            <input class="boutton3" type="button" name="connexion" value="GO !" onclick='clickButton()'>
        </form>
    </div>
</div>    

<?php
include_once "footer.php"
?>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

<script>
                // Fonction qui va afficher les stations préférées dans un menu déroulant via le bouton favoris
                function afficheDepartFavoris() {
                    liste_depart = document.getElementById('select_depart');
                    liste_depart.setAttribute("style", "visibility:true");
                    liste_depart.addEventListener("change", function () {
                        document.getElementById("input_depart").value = liste_depart.options[liste_depart.selectedIndex].value;
                        autocompleteDepart.autocomplete.open();
                    });
                }

                function afficheArriveesFavorites() {
                    liste_arrivee = document.getElementById('select_arrivee');
                    liste_arrivee.setAttribute("style", "visibility:true");
                    liste_arrivee.addEventListener("change", function () {
                        document.getElementById("input_arrivee").value = liste_arrivee.options[liste_arrivee.selectedIndex].value;
                        autocompleteArrivee.autocomplete.open();
                    });
                }
</script>    
<script>
// SECTION MAP
////////////////
    window.onload = getPosMap;
    var mymap = null;
    var latPos, lngPos = null;
    var input_depart = document.getElementById('input_depart');
    var input_arrivee = document.getElementById('input_arrivee');


    // Initialise la Map
    mymap = L.map('map').setView([48.8534, 2.3488], 11);
    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox.streets',
        accessToken: 'pk.eyJ1IjoibWFyY2FudG9pbmUiLCJhIjoiY2p3dWhuMm9rMGxtODRhazF0b3QxMWNiMyJ9.kw_7XG7uObJT_lXD4PUACA'
    }).addTo(mymap);


    // Recupère la position
    function getPosMap() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(succesMap, errorMap);
        } else {
            alert("Votre navigateur ne supporte pas la géolocalisation");
        }
    }

    // Met la Map sur la position 
    function succesMap(pos) {
        latPos = pos.coords.latitude;
        lngPos = pos.coords.longitude;
        mymap.setView([latPos, lngPos], 15);
        L.marker([latPos, lngPos]).addTo(mymap);
    }

    function errorMap(err) {
        console.log(err);
    }
    ;


// SECTION AUTOCOMPLETION
///////////////////////////

    // Connexion à l'API d'Algolia
    const client = algoliasearch(
            "NGHXUDQIUT",
            "9b9d3898db2d1af1ac1451e042319b6c"
            );
    // Voir le dashboard pour modifier des infos
    const index = client.initIndex("mesCoords");

    // Clef de l'API Navitia
    var sandboxToken = "fe15dc43-d76a-4788-897f-100247da13df";
    var latTo = null;
    var latFrom = null;
    var lngTo = null;
    var lngFrom = null;
    var fromTo = "";
    var boolPosD = false;
    var boolPosA = false;

    input_depart.addEventListener('change', change);
    input_depart.addEventListener('blur', change);
    input_arrivee.addEventListener('change', change);
    input_arrivee.addEventListener('blur', change);

    // Pour fixer l'effacement du champs, on ne sait pas pourquoi ...
    function change(e) {
        if (e.target.id == 'input_depart') {
            if (boolPosD == true) {
                setTimeout(() => {
                    e.target.value = "Ma Position";
                    e.target.nextSibling.focus();
                }, 10);
            }
        }
        if (e.target.id == 'input_arrivee') {
            if (boolPosA == true) {
                setTimeout(() => {
                    e.target.value = "Ma Position";
                }, 10);
            }
        }
    }

    // Initialisation de l'objet d'autocomplétion des lieux
    var placesDataset = placesAutocompleteDataset({
        appId: "plZ6ZC3CU96B",
        apiKey: "c87e3c4fbfc80ea56598fe67a55f8701",
        algoliasearch: algoliasearch,
        templates: {
            header: '<div class="ac-header">Suggestions</div>',
            suggestion: function (suggestion) {
                let type = "";
                if (suggestion.type === "trainStation") {
                    type = "<img width='5%' height='5%' src='./img/subway.png' alt='icone d'un métro'/>";
                }
                if (suggestion.type === "city" || suggestion.type === "address") {
                    type = "<img width='5%' height='5%' src='./img/city.png' alt='icone d'un batiment'/>"
                }
                if (suggestion.type === "busStop") {
                    type = "<img width='5%' height='5%' src='./img/bus.png' alt='icone d'un bus'/>";
                }
                return type + " " + suggestion.value;
            }
        },
        language: "fr",
        countries: ["fr"],
        useDeviceLocation: true,
        aroundRadius: 70000,
        hitsPerPage: 3
    });

    // Initialisation de l'objet d'autocomplétion de la Position
    var coordoDataset = {
        source: autocomplete.sources.hits(index, {hitsPerPage: 1}),
        displayKey: "name",
        name: "coords",
        templates: {
            header: '<div class="ac-header">Ma Position</div>',
            suggestion: function (suggestion) {
                return suggestion.title;
            }
        }
    };

    // Concaténation des deux
    var autocompleteDepart = autocomplete(
            input_depart,
            {
                hint: false,
                debug: true,
                cssClasses: {prefix: "ac-input"}, // Les classes css 
                autoselect: true,
                autoselectOnBlur: true,
                openOnFocus : true,
                minLength: 3
            },
            [coordoDataset, placesDataset]
            );

    var autocompleteArrivee = autocomplete(
            input_arrivee,
            {
                hint: false,
                debug: true,
                cssClasses: {prefix: "ac-input"},
                autoselect: true,
                autoselectOnBlur: true,
                minLength: 3
            },
            [coordoDataset, placesDataset]
            );

    var autocompleteChangeEvents = ["selected", "autocompleted"];

    // Comportements selon certains évènements
    autocompleteChangeEvents.forEach(function (eventName) {
        autocompleteDepart.on("autocomplete:" + eventName, function (
            event,
            suggestion,
            datasetName
        ) {
            if (datasetName === "coords") {
                console.log(suggestion);
                boolPosD = true;
                fromTo = "from";
                getPos(event);
            }
            if (datasetName === "places") {
                console.log(suggestion);
                boolPosD = false;
                search("from", suggestion.latlng);
            }
        });

        autocompleteArrivee.on("autocomplete:" + eventName, function (
                event,
                suggestion,
                datasetName
                ) {
            if (datasetName === "coords") {
                console.log(suggestion);
                boolPosA = true;
                fromTo = "to";
                getPos(event);
            }
            if (datasetName === "places") {
                console.log(suggestion);
                console.log(suggestion.latlng);
                boolPosA = false;
                search("to", suggestion.latlng);
            }
        });
    });


    // Récupère la position

    function getPos(e) {
        if (navigator.geolocation) {
            if (e.target.id === "btn_depart" || e.target.id === "input_depart") {
                fromTo = "from";
            } else if (e.target.id === "btn_arrivee" || e.target.id === "input_arrivee") {
                fromTo = "to";
            }
            navigator.geolocation.getCurrentPosition(succes, error);
        } else {
            alert("Votre navigateur ne supporte pas la géolocalisation");
        }
    }

    function succes(pos) {
        latPos = pos.coords.latitude;
        lngPos = pos.coords.longitude;
        index.partialUpdateObject(
                {
                    coords: [latPos, lngPos],
                    objectID: "1533086121"
                },
                (err, content) => {
            if (err)
                throw err;
        }
        );
        if (fromTo === "from") {
            latFrom = latPos;
            lngFrom = lngPos;
        } else {
            latTo = latPos;
            lngTo = lngPos;
        }
    }

    function error(err) {
        console.log(err);
    }

    // Met à jours les valeurs qui seront passées à l'URL
    function search(where, latlng) {
        if (where === "to") {
            latTo = latlng.lat;
            lngTo = latlng.lng;
        } else if (where === "from") {
            latFrom = latlng.lat;
            lngFrom = latlng.lng;
        }
    }

    // Fonction qui appelle l'API Navitia et passe le resultat localement, et submit le formulaire
    function clickButton() {
        setTimeout(() => {
            console.log('click');
        }, (10));
        if (latTo && latFrom) {
            var url = "https://api.navitia.io/v1/coverage/fr-idf/journeys?from=" + lngFrom + ";" + latFrom + "&to=" + lngTo + ";" + latTo + "&count=3";
            console.log(url);
            $.ajax({
                type: "GET",
                url: url,
                dataType: "json",
                headers: {
                    Authorization: "Basic " + btoa(sandboxToken)
                },
                success: function (results) {
                    localStorage.setItem('trajets', JSON.stringify(results.journeys));
                    document.forms.myform.submit();
                },
                error: function (xhr, textStatus, errorThrown) {
                    alert(
                            'Error when trying to process isochron: "' +
                            textStatus +
                            '", "' +
                            errorThrown +
                            '"'
                            );
                }
            });
        } else {
            alert("entrer un depart et une arrivée");
            console.log(latTo + " " + latFrom);
        }
    }
    ;

</script>
