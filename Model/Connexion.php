<?php

class Connexion {

    private $host;
    private $dbname;
    private $username;
    private $password;
    private $db;

    public function __construct() {

        $this->username = 'root';
        $this->password = 'root'; //root pour MAMP et mysql pour AMPSS
        
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=ptut', $this->username, $this->password);
        } catch (Exception $ex) {
            echo "<script>alert(\"Problème de connexion\")</script> " . $ex->getMessage();
        }
    }
    
    /**
     * Connexion à la base de données
     * @return query
     */
    function getDb() {
        return $this->db;
    }
    
    /**
     * Retourne combien il y a de membre pour un mot de passe et un mail donnée
     * @param type $mail
     * @param type $password
     * @return int
     */
    function getMembre($mail,$password){
        $sql = $this->db->prepare('SELECT count(*) FROM membre WHERE mail= ? AND password=?');
		$sql->execute(array($mail,md5($password)));
        return $sql->fetch();
    }
    
    /**
     * Ajoute un membre à la bdd
     * @param type $nom
     * @param type $prenom
     * @param type $mail
     * @param type $password
     */
    function insertMembre($nom,$prenom,$mail,$password){
        $sql = $this->db->prepare('INSERT INTO membre(nom,prenom,mail,password) VALUES(?,?,?,?)');
        $sql->execute(array($nom,$prenom,$mail,md5($password)));        
    }

    /**
     * Modifie un membre dans la bdd
     * @param type $nom
     * @param type $prenom
     * @param type $adr
     * @param type $vil
     * @param type $dateNai
     * @param type $tel
     * @param type $lignePref
     * @param type $staPref
     * @param type $satis
     * @param type $statPref2
     * @param type $mail
     */
    function update($newMail,$password,$nom,$prenom,$adr,$vil,$dateNai,$tel,$lignePref,$staPref,$satis,$statPref2,$mail){
        $sql = $this->db->prepare('
        UPDATE membre SET 
        mail = ?,
        password = ?,
        nom = ?,
        prenom = ?,
        adresse = ? ,
        ville = ?,
        dateNaissance = ?,
        telephone= ?,
        lignePreferee=?,
        stationPreferee=?,
        satisfait=?,
        stationPreferee2=?
        where mail=?
        ');
        $sql->execute(array($newMail,$password,$nom,$prenom,$adr,$vil,$dateNai,$tel,$lignePref,$staPref,$satis,$statPref2,$mail)); 
    }
    
    /**
     * Retourne le nom du membre
     * @param type $mail
     * @return type
     */
    function getNom($mail){
        $sql = $this->db->prepare('SELECT nom FROM membre WHERE mail=?');
        $sql->execute(array($mail));
        return $sql->fetch();
    }
    
    /**
     * Retourne le prenom du membre
     * @param type $mail
     * @return type
     */
    function getPrenom($mail){
        $sql = $this->db->prepare('SELECT prenom FROM membre WHERE mail=?');
        $sql->execute(array($mail));
        return $sql->fetch();
    }
    
    /**
     * Retourne le mail du membre
     * @param type $mail
     * @return type
     */
    function getMail($mail){
        $sql = $this->db->prepare('SELECT mail FROM membre WHERE mail=?');
        $sql->execute(array($mail));
        return $sql->fetch();
    }
    
    /**
     * Retourne le mot de passe du membre
     * @param type $mail
     * @return type
     */
    function getPassword($mail){
        $sql = $this->db->prepare('SELECT password FROM membre WHERE mail=?');
        $sql->execute(array($mail));
        return $sql->fetch();
    }
    
    /**
     * Retourne l'adresse du membre
     * @param type $mail
     * @return type
     */
    function getAdresse($mail){
        $sql = $this->db->prepare('SELECT adresse FROM membre WHERE mail=?');
        $sql->execute(array($mail));
        return $sql->fetch();
    }
    
    /**
     * Retourne la ville du membre
     * @param type $mail
     * @return type
     */
    function getVille($mail){
        $sql = $this->db->prepare('SELECT ville FROM membre WHERE mail=?');
        $sql->execute(array($mail));
        return $sql->fetch();
            
    }
    
    /**
     * Retourne la date de naissance du membre
     * @param type $mail
     * @return type
     */
    function getDateNais($mail){
        $sql = $this->db->prepare('SELECT dateNaissance FROM membre WHERE mail=?');
        $sql->execute(array($mail));
        return $sql->fetch();
    }
    
    /**
     * Retourne le téléphone du membre
     * @param type $mail
     * @return type
     */
    function getTel($mail){
        $sql = $this->db->prepare('SELECT telephone FROM membre WHERE mail=?');
        $sql->execute(array($mail));
        return $sql->fetch();
    }
    
    /**
     * Retourne la ligne préférée du membre
     * @param type $mail
     * @return type
     */
    function getLignePref($mail){
        $sql = $this->db->prepare('SELECT lignePreferee FROM membre WHERE mail=?');
        $sql->execute(array($mail));
        return $sql->fetch();
    }
    
    /**
     * Retourne la station préférée numéro 1 du membre
     * @param type $mail
     * @return type
     */
    function getStationPref($mail){
        $sql = $this->db->prepare('SELECT stationPreferee FROM membre WHERE mail=?');
        $sql->execute(array($mail));
        return $sql->fetch();
    }
    
    /**
     * Retourne si le membre est satisfait du service
     * @param type $mail
     * @return type
     */
    function getSatisfait($mail){
        $sql = $this->db->prepare('SELECT satisfait FROM membre WHERE mail=?');
        $sql->execute(array($mail));
        return $sql->fetch();
    }
    
    /**
     * Retourne la station préférée numéro 2 du membre
     * @param type $mail
     * @return type
     */
    function getStationPref2($mail){
        $sql = $this->db->prepare('SELECT stationPreferee2 FROM membre WHERE mail=?');
        $sql->execute(array($mail));
        return $sql->fetch();
    }
    
    /**
     * Retourne le nombre de trajet effectué du membre
     * @param type $mail
     * @return type
     */
    function getNbTrajetsEffectues($mail){
        $sql = $this->db->prepare('SELECT COUNT(*) FROM trajet t,membre m WHERE m.id=t.idMembre and m.mail =?');
        $sql->execute(array($mail));
        return $sql->fetch();      
    }
    
    /**
     * Retourne le nombre de trajet effectué par la sation preferée numéro 1 du membre
     * @param type $mail
     * @return type
     */
    function getNbTrajetsStation1($mail){
        $sql = $this->db->prepare('SELECT COUNT(*) FROM membre m,trajet t WHERE m.id=t.idMembre and m.stationPreferee=t.stationDepart or m.stationPreferee=t.stationArrivee and m.mail =?');
        $sql->execute(array($mail));
        return $sql->fetch();
    }
    
    /**
     * Retourne le nombre de trajet effectué par la sation preferée numéro 2 du membre
     * @param type $mail
     * @return type
     */
    function getNbTrajetsStation2($mail){
        $sql = $this->db->prepare('SELECT COUNT(*) FROM trajet t,membre m WHERE m.id=t.idMembre and m.stationPreferee2=t.stationDepart or m.stationPreferee2=t.stationArrivee and m.mail =?');
        $sql->execute(array($mail));
        return $sql->fetch();
    }
    
    /**
     * Retourne le total des lignes préférés des membres de la bdd
     * @return type
     */
    function getTotalLignePref(){
        $sql = $this->db->query('SELECT count(*) as nbStation,lignePreferee FROM membre GROUP BY lignePreferee');
        return $sql->fetchAll();
    }
    function getId($mail){
        $sql = $this->db->prepare('SELECT id FROM membre WHERE mail =?');
        $sql->execute(array($mail));
        return $sql->fetch();
    }
    
    /**
     * Retourne la moyenne des satisfaction des utilisateurs
     * @return type
     */
    function getMoyenneSat(){
        $sql = $this->db->query('SELECT avg(sa.nbSat) FROM (SELECT count(*) nbSat FROM membre GROUP BY satisfait) sa');
        return $sql->fetch();
    }
    
}



