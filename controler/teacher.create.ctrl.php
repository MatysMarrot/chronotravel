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

    $teacher = $_SESSION['teacher'];

    if (isset($_POST['createClass'])) {
        if (isset($_POST['newClassName']) && $_POST['newClassName'] != null) {
            $newClass = new ClassGroup($teacher);
            $newClass->create($_POST['newClassName']);
            $message = "<p id='ok'>Groupe de classe créé avec succès</p>";
            $view->assign("message",$message);
        }else{
            $message = "<p id='signal'>Veuillez saisir un nom</p>";
            $view->assign("message",$message);
        }
    }
    $view->display("teacher.create.view.php");
}
?>