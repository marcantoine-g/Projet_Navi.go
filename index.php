<?php

session_start();
require_once('Model/Connexion.php');


$pdoBuilder = new Connexion();
$db = $pdoBuilder->getDb();
if (
        ( isset($_GET['ctrl']) && !empty($_GET['ctrl']) ) &&
        ( isset($_GET['action']) && !empty($_GET['action']) )
) {
    $ctrl = $_GET['ctrl'];
    $action = $_GET['action'];
} else {
    $ctrl = 'default';
    $action = 'defaultPage';
}
require_once('./controller/' . $ctrl . 'Controller.php');
$ctrl = $ctrl . 'Controller';
$controller = new $ctrl($db);
$controller->$action();
