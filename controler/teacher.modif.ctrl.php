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
    $view->assign("titre" ,$titre);
    $view->display("teacher.modif.view.php");

    if (isset($_SESSION['currentClass'])) {

        $teacher = $_SESSION['teacher'];

        if (isset($_POST['updateName'])) {
            $currentClass->setName($_POST['className']);
            $classList = ClassGroup::getClassGroupsFromTeacher($teacher);
            header("Location: ".$_SERVER['PHP_SELF']);
        }
    }
}
?>