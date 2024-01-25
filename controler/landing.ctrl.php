<?php
//Inclure le php
include_once(__DIR__."/../framework/view.class.php");

// Controler
$view = new View();

session_start();
if(!isset($_SESSION['id'])){
    include(__DIR__ . "/../controler/login.ctrl.php");
}
elseif($_SESSION['roleid'] == 1){
    include(__DIR__ . "/../controler/home.ctrl.php");
}
elseif($_SESSION['roleid'] == 2){
    include(__DIR__ . "/../controler/teacher.home.ctrl.php");
}

?>