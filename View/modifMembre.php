<?php
    include_once "header.php" ;
?>     

    <form id="modifinfocompte" action="./index.php?ctrl=membre&action=sauvInforPerso" method="post" name="modifinfocompte">

        <div class="row" style='margin-bottom:2%'> <div class="formmodifinfo"> <span class="col-4" > Mail </span> <span class="col-8" > <input type="text" name="mail" value="<?php echo $_SESSION['mail']; ?>" placeholder="<?php echo $_SESSION['mail']; ?>"> </span> </div> </div><br />
        
        <div class="row" style='margin-bottom:2%'> <div class="formmodifinfo"> <span class="col-4" > Mot de passe </span> <span class="col-8" > <input type="password" name="password" value="********" placeholder="*******"> </span> </div> </div><br />
        
        <div class="row" style='margin-bottom:2%'> <div class="formmodifinfo"> <span class="col-4" width="200px" > Nom </span> <span class="col-8" >    <input type="text" name="nom" value="<?php echo $_SESSION['nom']; ?>" placeholder="<?php echo $_SESSION['nom']; ?>"> </span> </div> </div> <br />
        
        <div class="row" style='margin-bottom:2%'> <div class="formmodifinfo"> <span class="col-4" > Prénom </span> <span class="col-8" > <input type="text" name="prenom" value="<?php echo $_SESSION['prenom']; ?>" placeholder="<?php echo $_SESSION['prenom']; ?>"> </span> </div> </div><br />
        
        <div class="row" style='margin-bottom:2%'> <div class="formmodifinfo"> <span class="col-4" > Adresse </span> <span class="col-8" > <input type="text" name="adresse" value="<?php echo $_SESSION['adresse']; ?>" placeholder="<?php echo $_SESSION['adresse']; ?>"> </span> </div> </div><br />
        
        <div class="row" style='margin-bottom:2%'> <div class="formmodifinfo"> <span class="col-4" > Ville </span> <span class="col-8" > <input type="text" name="ville" value="<?php echo $_SESSION['ville']; ?>" placeholder="<?php echo $_SESSION['ville']; ?>"> </span> </div> </div><br />
        
        <div class="row" style='margin-bottom:2%'> <div class="formmodifinfo"> <span class="col-4" > Date de Naissance </span> <span class="col-8" > <input type="text" name="dateNaissance" value="<?php echo ($_SESSION['dateNaissance']); ?>" placeholder="<?php echo ($_SESSION['dateNaissance']); ?>"> </span> </div> </div><br />
        
        <div class="row" style='margin-bottom:2%'> <div class="formmodifinfo"> <span class="col-4" > Téléphone </span> <span class="col-8" > <input type="text" name="telephone" value="<?php echo $_SESSION['telephone'];?>" placeholder="<?php echo ($_SESSION['telephone']); ?>"> </span> </div> </div><br />
        
        <div class="row" style='margin-bottom:2%'> <div class="formmodifinfo"> <span class="col-4" > Ligne préférée </span> <span class="col-8" > <input type="text" name="lignePreferee" value="<?php echo ($_SESSION['lignePreferee']); ?>" placeholder="<?php echo ($_SESSION['lignePreferee']); ?>"> </span> </div> </div><br />

        <div class="row" style='margin-bottom:2%'> <div class="formmodifinfo"> <span class="col-4" >Station préférée </span> <span class="col-8 spanStation" > <input id="stationPref1" type="search" name="stationPreferee" value="<?php echo($_SESSION['stationPreferee']); ?>" placeholder="<?php echo($_SESSION['stationPreferee']);?>"> </span> </div> </div><br />

        <div class="row" style='margin-bottom:6%'> <div class="formmodifinfo"> <span class="col-4" > Satisfait ? (0 pour non, 1 pour oui) </span> <span class="col-8"  > <input type="text" name="satisfait" value="<?php echo ($_SESSION['satisfait']); ?>" placeholder="<?php echo ($_SESSION['satisfait']);?>"> </span> </div> </div><br />

        <div class="row"> <div class="formmodifinfo"> <span class="col-4" > Station préférée 2 </span> <span class="col-8 spanStation"> <input id="stationPref2" type="search" name="stationPreferee2" value="<?php echo ($_SESSION['stationPreferee2']); ?>" placeholder="<?php echo ($_SESSION['stationPreferee2']); ?>"> </span> </div> </div><br />

        <input id="bouttonmodif" type="button" name="ajouter" value="Ajouter" onclick="verifClick()">
        
    </form>

<script>

var placesDataset = placesAutocompleteDataset({
    appId: "plZ6ZC3CU96B",
    apiKey: "c87e3c4fbfc80ea56598fe67a55f8701",
    algoliasearch: algoliasearch,
    templates: {
      header: '<div class="ad-example-header">Suggestions</div>',
      suggestion: function(suggestion) {
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
    hitsPerPage: 5,
    type: 'trainStation'
  });

    var autocompleteStationPref1 = autocomplete(
            stationPref1,
            {
                hint: false,
                debug: true,
                cssClasses: {prefix: "ac-input"}, // Les classes css 
                autoselect: true,
                autoselectOnBlur: true,
                openOnFocus : true,
                minLength: 3
            },
            [placesDataset]
    );

    var autocompleteStationPref2 = autocomplete(
            stationPref2,
            {
                hint: false,
                debug: true,
                cssClasses: {prefix: "ac-input"}, // Les classes css 
                autoselect: true,
                autoselectOnBlur: true,
                openOnFocus : true,
                minLength: 3
            },
            [placesDataset]
    );

    var autocompleteChangeEvents = ["selected", "autocompleted"];

    var boolPref1 = false;
    var boolPref2 = false;

    autocompleteChangeEvents.forEach(function (eventName) {
        autocompleteStationPref1.on("autocomplete:" + eventName, function (
            event,
            suggestion,
            datasetName
        ) {
            if(eventName == "selected"){
                console.log(suggestion);
                boolPref1 = true;
                nomStation1 = suggestion.name+" ("+suggestion.city+")";
                autocompleteStationPref1.autocomplete.setVal(nomStation1);
            }
        });
    });

    autocompleteChangeEvents.forEach(function (eventName) {
        autocompleteStationPref2.on("autocomplete:" + eventName, function (
            event,
            suggestion,
            datasetName
        ) {
            if(eventName == "selected"){
                console.log(suggestion);
                boolPref2 = true;
                nomStation2 = suggestion.name+" ("+suggestion.city+")";
                autocompleteStationPref2.autocomplete.setVal(nomStation2);
            }
        });
    });

    // Modifier l'input pour vérifier si les valeurs sont a true avant d'accepter (la personne doit choisir parmis les suggestions)
    function verifClick(){
        if (boolPref1 && boolPref2){
            document.forms.modifinfocompte.submit();
        } else {
            alert("Il faut choisir une station à partir des suggestions");
        }
    }

</script>

<?php
    if (isset($erreur)) echo '<br />',$erreur;
    include_once "header.php" ;
?>