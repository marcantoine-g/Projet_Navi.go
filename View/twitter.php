<?php
    include_once "header.php" ;
?>


<div id="partietwitter" > 
    
    <br/> 
    
    <h2> TWITTER </h2>
    
    <br/> 
    
    <h6> Cliquez sur le numéro pour afficher le fil twitter </h6>

<?php
        
        for($i=0;$i<$total;$i++){
            echo "<a href='./index.php?ctrl=twitter&action=afficheTwitter2&num=$i'><img src='$tab[$i]'/></a>";
        }
?>        


    
</div>
    
    
    
 <?php   
    include_once "footer.php" ;
?>