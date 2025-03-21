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
    $_SESSION['teacher'] = $teacher;
    if(isset($_POST["modif"])){
        $_SESSION['teacher'] = $teacher;
        $_SESSION['currentClass'] = $currentClass;
        include(__DIR__."/../controler/teacher.modif.ctrl.php");

    }elseif(isset($_POST['createPage'])){
            include(__DIR__."/../controler/teacher.create.ctrl.php");
    }else{

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


            $students = $currentClass->getStudents();
            $className = $currentClass->getName();
            $code = "Code : " . $currentClass->getCode();


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
    $view->display("../controler/teacher.studentstat.ctrl.php");
}

?>