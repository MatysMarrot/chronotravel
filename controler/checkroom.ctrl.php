<?php

include_once(__DIR__."/../framework/view.class.php");
include_once(__DIR__ . "/../model/SkinObject.class.php");

$view = new View();
$outgoing = "../view/checkroom.view.php";
session_start();
if(!isset($_SESSION["id"])) {
    $outgoing = "../controler/landing.ctrl.php";
} else {
    $playerId = $_SESSION["id"];
    $allSkins = SkinObject::getAllSkinObjects();
    $currentSkin = SkinObject::getCurrentSkinOfPlayer($playerId);

    $view->assign("currentSkin",$currentSkin);
    $view->assign("allSkins",$allSkins);
}

$view->display($outgoing);

?>
