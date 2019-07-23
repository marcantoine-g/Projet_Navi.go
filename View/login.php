<?php
    include_once "header.php" 
?>

    <div class="formulaire">
        
    <h2 class="titre"> CONNEXION </h2> <br/> 
        
        <form action="index.php?ctrl=membre&action=doLogin" method="post">
            
            <input class="entree" type="text" name="mail" placeholder="Email" required value="<?php if (isset($_POST['mail'])) echo htmlentities(trim($_POST['mail'])); ?>"><br />
            
            <div class="erreurs"> <?php if (isset($erreur)) echo htmlentities(trim($erreur)); ?> </div>
            
            <input class="entree" type="password" name="password" placeholder="Mot de passe" required value="<?php if (isset($_POST['password'])) echo htmlentities(trim($_POST['mail'])); ?>"><br />
            
            <input class="boutton2" type="submit" name="connexion" value="Connexion">
            
            </form>
            
            <a class="boutton2" href="./index.php?ctrl=membre&action=inscription"> Pas encore inscrit ? </a>
        </div>
<?php
if(isset($erreur)) echo '<br /><br />',$erreur;
?>




<?php
    include_once "footer.php" 
?>