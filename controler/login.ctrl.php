<?php
include_once(__DIR__."/../framework/view.class.php");
include_once(__DIR__."/../model/DAO.class.php");
include_once(__DIR__."/../model/Student.class.php");
include_once(__DIR__."/utils/Utils.php");

$view = new View();
session_start();

$error = "";
$outgoing = "login.view.php";

if(count($_POST)){
    $login = $_POST['login'] ?? "";
    $password = $_POST['password'] ?? "";

    if (!$login || !$password){
        throw new Exception("Post is filled, but no credentials");
    }

    $dao = DAO::get();
    $data = [$login];
    $query = "SELECT roleid,id,password,login FROM Person WHERE login = ?";
    $table = $dao->query($query,$data);

    if(!count($table)){
        $error = "Le login $login n'existe pas !";
    }
    else {
        $reussite = false;
        ($reussite = password_verify($password,$table[0]['password'])) ? $outgoing = "../controler/home.ctrl.php" : $error = "Mauvais mot de passe, réessayer";
        $id = $table[0]['id'];
        $roleid = $table[0]['roleid'];
        $reussite ? log_session(array("id" => $id,"login" => $login, "password" => $table[0]['password'], "roleid" => $roleid)) : "" ;
    }

}

$view->assign("error",$error);
$view->display($outgoing);

?>