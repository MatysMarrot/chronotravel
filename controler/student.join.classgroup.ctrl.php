<?php
// TODO : Tester quand il y aura les code dans la BD
$code = $_POST['code'] ?? '';

$dao = DAO::get();

// On check si le code existe

$data = [$code];
$query = "SELECT name,id,code FROM class WHERE code = ?";
$table = $dao->query($query,$data);


if(count($table) == 0){
    $message = "Il n'y a pas de classe avec ce code !";
}
else{
    $idClass = [$table[0]['id']];
    $idStudent = $_SESSION['id'];
    $student = Student::readStudent($idStudent);
    $class = ClassGroup::getClassGroupFromId($idClass);
    $class->insertStudent($student);
    $name = $class->getName();
    $message = "Vous avez rejoins la classe $name !";
}

$view = new View();
$view->assign("message",$message);
$view->display("student.joinc.classgroup.view.php");

?>