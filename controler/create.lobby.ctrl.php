<?php
include_once(__DIR__ . "/../controler/utils/Utils.php");
include_once(__DIR__ . "/../model/DAO.class.php");
include_once(__DIR__ . "/../model/Student.class.php");
include_once(__DIR__ . "/../model/Party.class.php");

session_start();
if(!isset($_SESSION['id']) || $_SESSION['roleid'] != 1){
    include(__DIR__ . "/../controler/landing.ctrl.php");
}

else{
    $party = new Party($_SESSION['id']);
    $party->create();
    include(__DIR__ . "/../controler/student.lobby.ctrl.php");

}




?>