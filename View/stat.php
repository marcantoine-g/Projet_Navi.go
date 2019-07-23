<?php
    include_once "header.php" ;
if($_SESSION){
?>
<div id="partiestat">
    <h2>Statistiques Personnelles</h2>
    <p>Ligne préférée : <?php echo $lignePref['lignePreferee'] ?></p>
    <p>Station préférée numéro 1 : <?php echo $stationPref1['stationPreferee'] ?></p>
    <p>Station préférée numéro 2  : <?php echo $stationPref2['stationPreferee2'] ?></p>
    
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
    <script type="text/javascript">

      // Charge l'API de visualisation et le package corechart. 
      google.charts.load('current', {'packages':['corechart']});

      // Définir un rappel à exécuter lors du chargement de l'API de visualisation Google. 
      google.charts.setOnLoadCallback(drawChart);

      // Rappel qui crée et remplit une table de données,
      // instancie le graphique à secteurs, passe les données et
      // les dessine
      function drawChart() {

        // Crée la table de données.
       var data = new google.visualization.DataTable();
        data.addColumn('string', 'Question');
        data.addColumn('number', 'Nombre');
        data.addRows([
          ['Trajets effectués', <?php echo $nbTrajetsEffectues['COUNT(*)'];?>],
          ['Passages par votre station préférée', <?php echo $nbTrajetsStation1['COUNT(*)'];?>],
          ['Passages par votre 2e station préférée', <?php echo $nbTrajetsStation2['COUNT(*)'];?>]
        ]); 

        // Définir les options du graphique
        var options = {'title':'Statistiques personnelles'};

        // Instancie et dessine notre tableau, en passant quelques options.
        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }   
    </script>
    
    
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', ''],
            //essayer de faire la boucle for
            //?php for($i=0;$i<count(totalLigne);$i++){ ?>
              //['Ligne <php echo $totalLigne[$i]['lignePreferee']?>',<php echo $totalLigne[$i]['nbStation']?>],
            //php } ?>*
            ['Ligne <?php echo $totalLigne[0]['lignePreferee']?>',<?php echo $totalLigne[0]['nbStation']?>],
            ['Ligne <?php echo $totalLigne[6]['lignePreferee']?>',<?php echo $totalLigne[6]['nbStation']?>],
            ['Ligne <?php echo $totalLigne[7]['lignePreferee']?>',<?php echo $totalLigne[7]['nbStation']?>],
            ['Ligne <?php echo $totalLigne[8]['lignePreferee']?>',<?php echo $totalLigne[8]['nbStation']?>],
            ['Ligne <?php echo $totalLigne[9]['lignePreferee']?>',<?php echo $totalLigne[9]['nbStation']?>],
            ['Ligne <?php echo $totalLigne[10]['lignePreferee']?>',<?php echo $totalLigne[10]['nbStation']?>],
            ['Ligne <?php echo $totalLigne[11]['lignePreferee']?>',<?php echo $totalLigne[11]['nbStation']?>],
            ['Ligne <?php echo $totalLigne[12]['lignePreferee']?>',<?php echo $totalLigne[12]['nbStation']?>],
            ['Ligne <?php echo $totalLigne[13]['lignePreferee']?>',<?php echo $totalLigne[13]['nbStation']?>],
            ['Ligne <?php echo $totalLigne[1]['lignePreferee']?>',<?php echo $totalLigne[1]['nbStation']?>],
            ['Ligne <?php echo $totalLigne[2]['lignePreferee']?>',<?php echo $totalLigne[2]['nbStation']?>],
            ['Ligne <?php echo $totalLigne[3]['lignePreferee']?>',<?php echo $totalLigne[3]['nbStation']?>],
            ['Ligne <?php echo $totalLigne[4]['lignePreferee']?>',<?php echo $totalLigne[4]['nbStation']?>],
            ['Ligne <?php echo $totalLigne[5]['lignePreferee']?>',<?php echo $totalLigne[5]['nbStation']?>]
        ]);

        var options = {
          title: 'Quelles sont vos lignes préférées?', 
          is3D: true ,
          slices: {
            0: { color: '#FFCD00' },
            1: { color: '#003CA6' },  
            2: { color: '#837902' }, 
            3: { color: '#CF009E' }, 
            4: { color: '#FF7E2E' }, 
            5: { color: '#6ECA97' },
            6: { color: '#FA9ABA' },
            7: { color: '#E19BDF' },
            8: { color: '#B6BD00' },
            9: { color: '#003CA6' },
            10: { color: '#704B1C' },
            11: { color: '#007852' },
            12: { color: '#6EC4E8' },
            13: { color: '#62259D' },
            13: { color: '#62259D' },
         
          },   
          is3D: true,

             
          } ; 

        

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));

        chart.draw(data, options);
      }
    </script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['gauge']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['Satisfaction', <?php echo $moyenneSat[0] ?>]
        ]);

        var options = {
            
          title: 'Les utilisateurs sont-ils satisfaits?',
          width: 400, height: 120,
          redFrom: 90, redTo: 100,
          yellowFrom:75, yellowTo: 90,
          minorTicks: 5, 

        };

        var chart = new google.visualization.Gauge(document.getElementById('chart_div2'));
        chart.draw(data, options);
      }
    </script>
    
    
    
    <!--Un div qui contiendra le graphique à secteurs-->
    <div id="chart_div"></div>
    
    <h2>Statistiques Globales</h2>
    <div id="piechart_3d" style="width: 900px; height: 500px;"></div><br/>
    <div id="chart_div2" style="width: 400px; height: 120px;"></div>
</div>
<?php
    }else{
    echo "<br/> <div id='connexionstat'> <h2> Veuillez vous connecter pour accéder à cette page </h2>  <a href='./index.php?ctrl=membre&action=login'><input class='boutton2' type='submit' name='connexion' value='Connexion'> </a>  </div> ";
    }
    include_once "footer.php" ;
?>