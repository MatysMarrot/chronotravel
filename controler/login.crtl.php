<?php
include_once(__DIR__."/../framework/view.class.php");
include_once(__DIR__."/../model/DAO.class.php");
include_once(__DIR__."/../model/Student.class.php");

$view = new View();
$error = "";
$outgoing = "login.php";

if(count($_POST)){
    $login = $_POST['login'] ?? "";
    $password = $_POST['password'] ?? "";

    if (!$login || !$password){
        throw new Exception("Post is filled, but no credentials");
    }

    $dao = DAO::get();
    $data = [$login];
    $query = "SELECT login FROM Person WHERE login = ?";
    $table = $dao->query($query,$data);

    if(!count($table)){
        $error = "Le login $login n'existe pas !";
    }
    else {
        $query = "SELECT password FROM Person WHERE login = ?";
        $table = $dao->query($query,$data);
        password_verify($password,$table[0]['password']) ? $outgoing = "landingpage.php" : $error = "Mauvais mot de passe, réessayer";
    }

$view->assign("error",$error);
$view->display($outgoing);
    


}

?>