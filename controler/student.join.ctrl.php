<?php

include_once(__DIR__."/../framework/view.class.php");
include_once(__DIR__."/../model/DAO.class.php");


$view = new View();
session_start();
$outgoing = "../view/student.join.view.php";
$message = "";
$playerId = $_SESSION["id"] ?? 0;
$roomCode = $_POST["code"] ?? 0;

//Si j'ai un roomcode
if (!isset($_SESSION["id"])){
    $outgoing = "../controler/landing.ctrl.php";
} else if ($roomCode) {
    $dao = DAO::get();
    $data = [$roomCode];
    $query = "SELECT partyId FROM PartyCode WHERE code = ?";
    $table = $dao->query($query,$data);


    if(!count($table)) {
        //Aucune réponse
        $message = "Salon non trouvé";
    } else {
        //Party id trouvé
        $_SESSION['roomCode'] = $roomCode;
        $partyId = $table[0][0];
        $_SESSION['partyId'] = $partyId;
        //log_session(array('roomCode' => $roomCode, "partyid" => $partyId));
        $message = "Salon trouvé ";
        $outgoing="../controler/student.lobby.ctrl.php";
    }

}


//var_dump($outgoing);
//var_dump($_SESSION);
$view->assign("message",$message);
$view->display($outgoing);

?>