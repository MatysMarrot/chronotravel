<?php
include_once(__DIR__."/../model/DAO.class.php");
include_once(__DIR__."/../model/Student.class.php");
include_once(__DIR__."/../model/ClassGroup.class.php");
include_once(__DIR__."/../framework/view.class.php");
// TODO : Tester quand il y aura les code dans la BD
//Ra69100ra.
session_start();
$dao = DAO::get();
$view = new View();
$message = "";
$currentClass = "Vous n'êtes dans aucun groupe de classe pour le moment";

// On check si le code existe
$data = [$_SESSION['id']];
$query = "SELECT classid FROM studentclass WHERE studentid = ?";
$table = $dao->query($query,$data);
$ingroup = false;

if(count($table) != 0){
    $ingroup = true;
}

if($ingroup){
    $class = ClassGroup::getClassGroupFromId($table[0][0]);
    $currentClass = "Attention, vous êtes déjà dans la classe " . $class->getName();
}

if(isset($_POST['code'])){
    $code = $_POST['code'];
    $data = [$code];
    $query = "SELECT id FROM class WHERE code = ?";
    $table = $dao->query($query,$data);

    if(count($table) == 0){
        $message = "Impossible de rejoindre la classe avec le code $code ";
    }
    else{
        $idClass = $table[0][0];
        $idStudent = $_SESSION['id'];
        $student = Student::readStudent($idStudent);
        if($ingroup){
            $class->removeStudent($student);
        }
        $class = ClassGroup::getClassGroupFromId($idClass);
        
        $class->insertStudent($student);
        $name = $class->getName();
        $message = "Vous avez rejoins la classe $name !";
        $currentClass = "Attention, vous êtes déjà dans la classe " . $class->getName();
    }
}

$view->assign("currentClass",$currentClass);
$view->assign("message",$message);
if(!isset($_SESSION)) {
    $view->display("landing.ctrl.php");
}
$view->display("student.join.classgroup.view.php");

?>