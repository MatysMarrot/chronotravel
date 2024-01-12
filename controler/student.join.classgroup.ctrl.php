<?php

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
    $data = [$table[0]['id']];
    $query = "SELECT teacherid FROM classteacher, class WHERE id = ? AND id = classid";
    $table = $dao->query($query,$data);
    $id = $_SESSION['id'];
    $student = Student::readStudent($id);

    


}

?>