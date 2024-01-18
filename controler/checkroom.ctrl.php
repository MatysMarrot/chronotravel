<?php

include_once(__DIR__."/../framework/view.class.php");
include_once(__DIR__ . "/../model/SkinObject.class.php");

$view = new View();
$outgoing = "../view/checkroom.view.php";
session_start();
if(!isset($_SESSION["id"])) {
    $outgoing = "../controler/landing.ctrl.php";
} else {
    // Récupère l'id du joueur
    $playerId = $_SESSION["id"];
    // Récupère les cosmétiques possédés par le joueur
    $possessedSkin = SkinObject::getAllPossessedSkin($playerId);
    $unpossessedSkin = SkinObject::getAllunpossessedSkin($playerId);
    // Récupère du skin du joueur
    $currentSkin = SkinObject::getCurrentSkinOfPlayer($playerId);
    // Récupère le cosmétique selectionné
    $selectedSkin = $_POST["skin"] ?? 0;
    // Check si le joueur possède le cosmétique

    $view->assign("possessedSkin", $possessedSkin);
    $view->assign("unpossessedSkin", $unpossessedSkin);
    $view->assign("currentSkin",$currentSkin);
}

$view->display($outgoing);

?>
