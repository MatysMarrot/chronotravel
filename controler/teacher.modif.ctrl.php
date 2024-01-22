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
    $currentClass = $_SESSION['currentClass'];
    $view->assign("currentClass", $currentClass);
    $titre = "Modifier \"".$currentClass->getName()."\"";


    if (isset($_SESSION['currentClass'])) {

        $teacher = $_SESSION['teacher'];

        if (isset($_POST['updateName'])) {
            $newName=$_POST['className'];
            $currentClass->setName($newName);
            $classList = ClassGroup::getClassGroupsFromTeacher($teacher);
            $message = "<p id='ok'>Nom de groupe modifié avec succès</p>";
            $view->assign("message",$message);
            $titre = "Modifier \"".$newName."\"";
        }
    }
    $view->assign("titre" ,$titre);
    $view->display("teacher.modif.view.php");
}
?>