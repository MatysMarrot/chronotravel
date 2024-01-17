<?php
//Inclure le php
include_once(__DIR__."/../framework/view.class.php");

//include(__DIR__."/../view/landingpage.php");

//var_dump($_SESSION);

// Controler
$view = new View();

session_start();
if(!isset($_SESSION['id'])){
    include(__DIR__ . "/../controler/login.ctrl.php");
}
else{
    include(__DIR__ . "/../view/home.view.php");
}



?>