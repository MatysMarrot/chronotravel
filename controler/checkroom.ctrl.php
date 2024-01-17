<?php

include_once(__DIR__."/../framework/view.class.php");

$view = new View();
$outgoing = "../view/checkroom.view.php";

if(!isset($_SESSION["id"])) {
    $outgoing = "../controler/landing.ctrl.php";
} else {
    $dao = DAO::get();
    $data = [$login];
    $query = "SELECT roleid,id,password,login FROM Person WHERE login = ?";
    $table = $dao->query($query,$data);

}

$view->display($outgoing);

?>
