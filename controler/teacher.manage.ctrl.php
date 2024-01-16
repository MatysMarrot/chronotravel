<?php

include_once(__DIR__."/../model/DAO.class.php");
include_once(__DIR__."/../model/Student.class.php");
include_once(__DIR__."/../model/Teacher.class.php");
include_once(__DIR__."/../model/ClassGroup.class.php");
include_once(__DIR__."/../framework/view.class.php");

session_start();
$view = new View();

if($_SESSION["roleid"] != 2){
    include(__DIR__."/../controler/landing.ctrl.php");
}
else{
    
    $currentClassId = $_POST['currentClass'] ?? null;

    if ($currentClassId == null) {
        // Définissez une valeur par défaut si 'currentClass' n'est pas défini dans $_POST
        $currentClassId = -1; // Remplacez par l'ID par défaut souhaité
    }

    $currentClass = ClassGroup::getClassGroupFromId($currentClassId);

    $teacher = Teacher::readTeacher($_SESSION['id']);

    $classList = ClassGroup::getClassGroupsFromTeacher($teacher);

    if(count($classList) == 0){
        $students = [];
        $className = "Pas de classe pour le moment ! ";
        $classList = [];
        $code = "";
    }
    else{
        if($currentClass == null){
            $currentClass = $classList[0];
        }
        
        if(isset($_POST['delete'])){
            $studentToDel = Student::readStudent($_POST['delete']);
            $currentClass->removeStudent($studentToDel);
        }

        $students = $currentClass->getStudents();
        $className = $currentClass->getName();
        $code = "Le code de la classe : " . $currentClass->getCode();

        
    }

    
    
    $view->assign("currentClass",$currentClass);
    $view->assign("code",$code);
    $view->assign("students",$students);
    $view->assign("className",$className);
    $view->assign("classList",$classList);
    $view->display("teacher.manage.view.php");
}

?>