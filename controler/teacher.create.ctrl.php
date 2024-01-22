<?php
include_once(__DIR__."/../model/DAO.class.php");
include_once(__DIR__."/../model/Student.class.php");
include_once(__DIR__."/../model/Teacher.class.php");
include_once(__DIR__."/../model/ClassGroup.class.php");
include_once(__DIR__."/../framework/view.class.php");

session_start();
$view = new View();


if(!isset($_SESSION['id']) || $_SESSION['roleid'] != 2){
    include(__DIR__ . "/../controler/landing.ctrl.php");
}
else {
    $view = new View();
    $view->display("teacher.create.view.php");
    $teacher = $_SESSION['teacher'];

    if(isset($_POST['createClass'])){
        if (isset($_POST['className'])){
            $newClass = new ClassGroup($teacher);
            $newClass->create();
            include(__DIR__ . "/../controler/teacher.manage.ctrl.php");
            $newClass->setName($_POST['className']);

        }else{
            $message = "Veuillez saisir un nom";
            $view->assign("message",$message);
        }
    }
}
?>