<?php
include_once(__DIR__."/../model/DAO.class.php");
include_once(__DIR__."/../model/Student.class.php");
include_once(__DIR__."/../model/ClassGroup.class.php");
include_once(__DIR__."/../framework/view.class.php");
// TODO : Tester quand il y aura les code dans la BD
//Ra69100ra.
session_start();
var_dump($_SESSION);
$dao = DAO::get();
$message = "";

// On check si le code existe
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
        var_dump($idClass);
        $idStudent = $_SESSION['id'];
        $student = Student::readStudent($idStudent);
        $class = ClassGroup::getClassGroupFromId($idClass);
        $class->insertStudent($student);
        $name = $class->getName();
        $message = "Vous avez rejoins la classe $name !";
    }
}


$view = new View();
$view->assign("message",$message);
$view->display("student.join.classgroup.view.php");

?>