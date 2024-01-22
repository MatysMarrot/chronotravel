<?php
include_once(__DIR__ . "/../controler/utils/Utils.php");
include_once(__DIR__ . "/../model/DAO.class.php");
include_once(__DIR__ . "/../model/Student.class.php");
include_once(__DIR__ . "/../model/Party.class.php");
include_once(__DIR__ . "/../framework/view.class.php");

$view = new View();

session_start();
if(!isset($_SESSION['id']) || $_SESSION['roleid'] != 1){
    $view->display("../controler/landing.ctrl.php");
}

else{
    $party = new Party($_SESSION['id']);
    $party->create();
    $view->display("../controler/student.lobby.ctrl.php");
}




?>