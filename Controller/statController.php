<?php

class statController{
    
    public function afficheStat(){
        $stat=new Connexion();
        //stat perso
        if(isset($_SESSION['mail'])){
            $nbTrajetsEffectues=$stat->getNbTrajetsEffectues($_SESSION['mail']);
            $nbTrajetsStation1=$stat->getNbTrajetsStation1($_SESSION['mail']);
            $nbTrajetsStation2=$stat->getNbTrajetsStation2($_SESSION['mail']);
            
            //$dureeTotalTrajet
            $lignePref = $stat->getLignePref($_SESSION['mail']);
            $stationPref1 = $stat->getStationPref($_SESSION['mail']);
            $stationPref2 = $stat->getStationPref2($_SESSION['mail']);
            
            //stat globale
            $totalLigne = $stat->getTotalLignePref();
            $moyenneSat = $stat->getMoyenneSat();
        }
        require('./View/stat.php'); 
    }
    
}
?>