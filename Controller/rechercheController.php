<?php

class rechercheController{
    private $depart;
    private $arrivee;

    public function recherchePage(){
        if((isset($_POST['depart']) && !empty($_POST['depart'])) && (isset($_POST['arrivee']) && !empty($_POST['arrivee']))) {          
           $depart = $_POST['depart'];
           $arrivee = $_POST['arrivee'];
        }
       require('./View/recherche.php'); 
    }

    public function envoitBdd(){
        if(isset($_POST['heureDepart']) && isset($_POST['heureArrivee']) && isset($_POST['duree']) && isset($_POST['stationDepart']) && isset($_POST['stationArrivee']) ){
            if(!isset($_SESSION)){
                echo("Il faut vous connecter");
            } else {
                $connexion = new Connexion();
                $mail = $_SESSION['mail'];
                $id = $connexion->getId($mail);
                $db = $connexion->getDb();

                $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false); 
                try{
                    $sql = $db->prepare('INSERT INTO `trajet` (`stationDepart`,`stationArrivee`, `heureDepart`, `heureArrivee`, `duree`,`idMembre` )
                                        VALUES(?,?,?,?,?,?)');
                    $sql->execute(array($_POST['stationDepart'], $_POST['stationArrivee'], $_POST['heureDepart'],
                                                $_POST['heureArrivee'], $_POST['duree'], intval($id[0]))); 
                    echo('Merci !');
                }
                catch(Exception $e){
                    var_dump($e->getMessage());
                }
            }
        } else {
            echo('Merci !');
        }
    }
    
}