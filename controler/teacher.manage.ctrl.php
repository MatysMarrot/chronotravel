<?php

include_once(__DIR__."/../model/DAO.class.php");
include_once(__DIR__."/../model/Student.class.php");
include_once(__DIR__."/../model/Teacher.class.php");
include_once(__DIR__."/../model/ClassGroup.class.php");
include_once(__DIR__."/../framework/view.class.php");

session_start();
$view = new View();
if(!isset($_SESSION["id"])) {
    $view->display("landing.ctrl.php");
} else if($_SESSION["roleid"] != 2){
    include(__DIR__."/../controler/landing.ctrl.php");
}
else{
    $view->display("teacher.manage.view.php");
}

?>