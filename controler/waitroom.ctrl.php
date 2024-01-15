<?php

include_once(__DIR__."/../framework/view.class.php");
include_once(__DIR__."/../model/DAO.class.php");

$view = new View();
session_start();
$outgoing = "student.join.view.php";
$message = "";

if(count($_POST)) {
    $playerId = $_SESSION["id"] ?? 0;
    $roomCode = $_POST["code"] ?? 0;

    $dao = DAO::get();
    $data = [$roomCode];
    $query = "SELECT partyId FROM PartyCode WHERE code = ?";
    $table = $dao->query($query,$data);

    if(!count($table)) {
        $message = "Salon non trouvé";
    } else {
        $_SESSION['roomCode'] = $roomCode;
        $message = "Connexion effectué ";
        $outgoing="student.lobby.ctrl.php";
    }
}

$view->assign("message",$message);
$view->display("../view/".$outgoing);

?>