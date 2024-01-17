<?php
include_once(__DIR__ . "/../framework/view.class.php");
var_dump($_SESSION);
$formulaireComplet = isset($_SESSION['login']) && isset($_SESSION['id']) && isset($_SESSION['roomCode']);

$view = new View();

if (!$formulaireComplet){
    //pas connecté
    $view->display("../controler/landing.ctrl.php");
}

$view->display("../view/waitroom.view.php");

