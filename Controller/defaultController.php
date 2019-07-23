<?php

class defaultController {

    public function defaultPage() {
        $donnees = new Connexion();
        if($_SESSION){
            $departFavori1 = $donnees->getStationPref($_SESSION['mail']);
            $departFavori2 = $donnees->getStationPref2($_SESSION['mail']);
            $arretFavori1 = $donnees->getStationPref($_SESSION['mail']);
            $arretFavori2 = $donnees->getStationPref2($_SESSION['mail']);
        }
        require('./View/default.php');
    }

}
