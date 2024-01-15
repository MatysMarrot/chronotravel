<?php

include_once(__DIR__."/../framework/view.class.php");
include_once(__DIR__."/../model/DAO.class.php");

$view = new View();
session_start();
$outgoing = "student.join.view.php";
$message = "Pas d'info dans le POST";

if(count($_POST)) {
    $playerId = $_POST["playerId"] ?? 0;
    $roomCode = $_POST["code"] ?? 0;

    $dao = DAO::get();
    $data = [$roomCode];
    $query = "SELECT partyId FROM PartyCode WHERE code = ?";
    $table = $dao->query($query,$data);

    if(!count($table)) {
        $message = "Salon non trouvé";
    } else {
        $_SESSION['playerId'] = $playerId;
        $_SESSION['roomCode'] = $roomCode;
        $_SESSION['playerName'] = $playerName;
        $message = "Connexion effectué ";
        $outgoing="student.lobby.ctrl.php";
    }
}

$view->assign("message",$message);
$view->display("../view/".$outgoing);

?>