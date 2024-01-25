<?php

include_once(__DIR__."/../framework/view.class.php");
include_once(__DIR__."/../model/SkinObject.class.php");
$view = new View();
$outgoing = "../view/home.view.php";

if(!isset($_SESSION["id"]) || $_SESSION['roleid'] != 1) {
    $outgoing = "../controler/landing.ctrl.php";
} else {
    $playerId=$_SESSION["id"];
    $currentSkin=SkinObject::getCurrentSkinOfPlayer($playerId);
    $view->assign("currentSkin", $currentSkin);
}

$view->display($outgoing);

?>
