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

elseif(!isset($_POST["stats"])){


    $currentClassId = $_POST['currentClass'] ?? null;

    if ($currentClassId == null) {
        $currentClassId = -1;
    }

    $currentClass = ClassGroup::getClassGroupFromId($currentClassId);
    $teacher = Teacher::readTeacher($_SESSION['id']);
    if(isset($_POST["modif"])){
        $view->assign("class",$currentClass);
        $view->assign("teacher", $teacher);
        $view->display("teacher.modif.ctrl.php");
    }else{
        if(isset($_POST['create'])){
            $newClass = new ClassGroup($teacher);
            $newClass->create();
        }

        $classList = ClassGroup::getClassGroupsFromTeacher($teacher);

        if(isset($_POST['deleteGroup'])){
            $currentClass->delete();
            $classList = ClassGroup::getClassGroupsFromTeacher($teacher);
            $currentClass = null;
        }


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

            if(isset($_POST['updateName'])){
                $currentClass->setName($_POST['className']);
                $classList = ClassGroup::getClassGroupsFromTeacher($teacher);
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
}
else{ //Gestion stats élève
    $student = Student::readStudent($_POST["stats"]);
    $view->assign("student",$student);
    $view->display("teacher.statStudent.view.php");
}

?>