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
    // Récupère tous les cosmétiques disponibles
    $allSkins = SkinObject::getAllSkinObjects();
    // Récupère du skin du joueur
    $currentSkin = SkinObject::getCurrentSkinOfPlayer($playerId);
    // Récupère le cosmétique selectionné
    $selectedSkin = $_POST["skin"] ?? 0;
    // Check si le joueur possède le cosmétique
    var_dump($selectedSkin);
    $view->assign("currentSkin",$currentSkin);
    $view->assign("allSkins",$allSkins);
}

$view->display($outgoing);

?>
