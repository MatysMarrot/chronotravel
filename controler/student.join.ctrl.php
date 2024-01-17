<?php

include_once(__DIR__."/../framework/view.class.php");
include_once(__DIR__."/../model/DAO.class.php");

$view = new View();
session_start();
$outgoing = "../view/student.join.view.php";
$message = "";

$playerId = $_SESSION["id"] ?? 0;
$roomCode = $_POST["code"] ?? 0;

if($roomCode){
    //If the roomcode is set
    $_SESSION["roomCode"] = $roomCode;
    $outgoing = "../controler/student.lobby.ctrl.php";
} else if (isset($_SESSION["id"])) {
    //If connected
    $dao = DAO::get();
    $data = [$roomCode];
    $query = "SELECT partyId FROM PartyCode WHERE code = ?";
    $table = $dao->query($query,$data);

    if(!count($table)) {
        $message = "Salon non trouvé";
    } else {
        $_SESSION['roomCode'] = $roomCode;
        $message = "Connexion effectué ";
        $outgoing="../controler/student.lobby.ctrl.php";
    }

} else {
    //Not connected
    $outgoing = "../controler/landing.ctrl.php";
}
    


var_dump($outgoing);
$view->assign("message",$message);
$view->display($outgoing);

?>