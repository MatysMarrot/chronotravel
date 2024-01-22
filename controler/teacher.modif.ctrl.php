<?php

session_start();

if(!isset($_SESSION['id']) || $_SESSION['roleid'] != 2){
    include(__DIR__ . "/../controler/landing.ctrl.php");
}
else{
    include(__DIR__."/../view/teacher.modif.view.php");
}

if(isset($_POST['updateName'])){
$currentClass->setName($_POST['className']);
$classList = ClassGroup::getClassGroupsFromTeacher($teacher);
}

?>