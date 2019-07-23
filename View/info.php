<?php
    include_once "header.php" ;
    if($_SESSION['satisfait'] == 0){ $sati  = "non" ; }else{ $sati = "oui";}
?> 


    <div id="infocompte">
        <div class="row"> <div class="forminfo">  <?php echo '<span class="col-4" > Mail </span> <span class="col-8" >  '.$_SESSION['mail'].'</span>' ?> </div>  <a href="./index.php?ctrl=membre&action=updateInfoPerso"> <img width="30px" src="./img/pen.svg"/>  </a> </div>  <br/>
        
        <div class="row"> <div class="forminfo">  <?php echo '<span class="col-4" > Mot de passe </span> <span class="col-8" >********</span>' ?> </div>  <a href="./index.php?ctrl=membre&action=updateInfoPerso"> <img width="30px" src="./img/pen.svg"/>  </a> </div>  <br/>
        
        <div class="row"> <div class="forminfo">  <?php echo '<span class="col-4" > Nom </span> <span class="col-8" >  '.$_SESSION['nom'].'</span>' ?> </div>  <a href="./index.php?ctrl=membre&action=updateInfoPerso"> <img width="30px" src="./img/pen.svg"/>  </a> </div>  <br/>

        <div class="row"> <div class="forminfo"> <?php echo '<span class="col-4"> Prénom </span> <span class="col-8"> '.$_SESSION['prenom'].'</span> ' ?> </div> <a href="./index.php?ctrl=membre&action=updateInfoPerso"> <img width="30px" src="./img/pen.svg"/>  </a> </div> <br />

        <div class="row"> <div class="forminfo"> <?php echo '<span class="col-4"> Adresse </span> <span class="col-8">'.$_SESSION['adresse'].'</span>' ?> </div> <a href="./index.php?ctrl=membre&action=updateInfoPerso">  <img width="30px" src="./img/pen.svg"/>  </a> </div> <br />

        <div class="row"> <div class="forminfo"> <?php echo '<span class="col-4"> Ville </span> <span class="col-8" > '.$_SESSION['ville'].'</span>' ?> </div> <a href="./index.php?ctrl=membre&action=updateInfoPerso">  <img width="30px" src="./img/pen.svg"/>  </a> </div> <br />

        <div class="row"> <div class="forminfo"> <?php echo ' <span class="col-4" > Date de Naissance </span> <span class="col-8"> '.$_SESSION['dateNaissance'].'</span>' ?> </div> <a href="./index.php?ctrl=membre&action=updateInfoPerso">  <img width="30px" src="./img/pen.svg"/>  </a></div> <br />

        <div class="row"> <div class="forminfo"> <?php echo ' <span class="col-4" > Tel </span> <span class="col-8" > '.$_SESSION['telephone'].'</span>' ?> </div>  <a href="./index.php?ctrl=membre&action=updateInfoPerso">  <img width="30px" src="./img/pen.svg"/>  </a></div> <br />

        <div class="row"> <div class="forminfo"> <?php echo '<span class="col-4"> Ligne preferée </span> <span class="col-8" > '.$_SESSION['lignePreferee'].'</span>' ?> </div>  <a href="./index.php?ctrl=membre&action=updateInfoPerso">  <img width="30px" src="./img/pen.svg"/>  </a></div> <br />

        <div class="row"> <div class="forminfo"> <?php echo '<span class="col-4"> Station preferée </span> <span class="col-8" style="display:flex;" > '.$_SESSION['stationPreferee'].'</span>' ?> </div>  <a href="./index.php?ctrl=membre&action=updateInfoPerso">  <img width="30px" src="./img/pen.svg"/>  </a></div><br />

        <div class="row"> <div class="forminfo"> <?php echo '<span class="col-4" > Station preferée 2 </span> <span class="col-8" style="display:flex;"> '.$_SESSION['stationPreferee2'].'</span>' ?> </div> <a href="./index.php?ctrl=membre&action=updateInfoPerso">  <img width="30px" src="./img/pen.svg"/>  </a></div><br />

        <div class="row"> <div class="forminfo"> <?php echo '<span class="col-4" > Satisfait </span> <span class="col-8"> '.$sati.'</span>' ?> </div> <a href="./index.php?ctrl=membre&action=updateInfoPerso">  <img width="30px" src="./img/pen.svg"/>  </a></div><br />
        
    </div>
     
    

<?php
    include_once "footer.php" ;
?>