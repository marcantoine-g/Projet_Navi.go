<?php
    include_once "header.php" 
?>
<div class="formulaire">
    
    <h2 class="titre"> INSCRIPTION </h2> <br />
    
    <form action="index.php?ctrl=membre&action=doInscription" method="post">
        
        <input class="entree" type="text" name="nom" placeholder="Nom" required value="<?php if (isset($_POST['nom'])) echo htmlentities(trim($_POST['nom'])); ?>"><br />
        
        <input type="text" class="entree" name="prenom" placeholder="Prénom" required value="<?php if (isset($_POST['prénom'])) echo htmlentities(trim($_POST['prénom'])); ?>"><br />
        
        <input type="text" class="entree" name="mail" placeholder="Email" required value="<?php if (isset($_POST['mail'])) echo htmlentities(trim($_POST['mail'])); ?>"><br />
        
        <input type="password" class="entree" name="password" placeholder="Mot de passe" required  value="<?php if (isset($_POST['password'])) echo htmlentities(trim($_POST['password'])); ?>"><br />
        
        <input type="password" class="entree" name="password_confirm" placeholder="Confirmation du mot de passe" required  value="<?php if (isset($_POST['password_confirm'])) echo htmlentities(trim($_POST['password_confirm'])); ?>"><br />
        
        <input class="boutton2" type="submit" name="inscription" value="Inscription">
    </form>
<?php
if (isset($erreur)) echo '<br />',$erreur;
?>
    </div>

<?php
    include_once "footer.php" 
?>