<?php

include_once(__DIR__."/../framework/view.class.php");
include_once(__DIR__ . "/../model/SkinObject.class.php");
include_once(__DIR__ . "/../model/Student.class.php");

$view = new View();
$outgoing = "../view/checkroom.view.php";
session_start();
if(!isset($_SESSION["id"])) {
    $outgoing = "../controler/landing.ctrl.php";
} else {
    $colorSkin= [];
    $possessedSkin = [];
    $unpossessedSkin = [];
    $selectedSkin = null;
    // Vue d'achat
    $buyView = false;
    // Récupère l'id du joueur
    $playerId = $_SESSION["id"];
    $student = Student::readStudent($playerId);
    if(isset($_POST["buy"])) {
        $idSkinToBuy = $_POST["buy"];
        $skinToBuy = SkinObject::getSkin($idSkinToBuy);
        if($student->getCurrency()>=$skinToBuy->getPrice()) {
            $skinToBuy->isBuyBy($student);
        }
    }
    // Récupère le cosmétique selectionné
    $selectedSkinId = $_POST["skin"] ?? 0;
    if($selectedSkinId != 0) { // cela vérifie que le joueur à bien cliquer sur un cosmétique
        $selectedSkin = SkinObject::getSkin($selectedSkinId); // récupère l'objet du cosmétique
        // si le joueur possède le cosmétique (il l'a acheté mais il n'en est pas forcément équipé
        if($selectedSkin->isPossessedBy($playerId)) {
            $selectedSkin->toggleSkin($playerId); // Retire le cosmétique s'il en est équipé ou lui équipe s'il ne la pas équipé
            // Récupère les cosmétiques possédés par le joueur et ceux non possédés
            $possessedSkin = SkinObject::getAllPossessedSkin($playerId);
            $unpossessedSkin = SkinObject::getAllunpossessedSkin($playerId);
            $colorSkin = SkinObject::getColorSkin();
            // Récupère le skin du joueur
            $currentSkin = SkinObject::getCurrentSkinOfPlayer($playerId);
        } else { // Le joueur ne possède pas le skinvar_dump($view);
            $buyView = true; // Le joueur a cliquer sur un skin qu'il ne possède pas, il veut surement l'acheter
            // Récupère du skin du joueur
            $currentSkin = SkinObject::getCurrentSkinOfPlayer($playerId);
            $currentSkin = $selectedSkin->previewSkin($currentSkin);
        }
    } else {
        // Récupère les cosmétiques possédés par le joueur et ceux non possédés
        $possessedSkin = SkinObject::getAllPossessedSkin($playerId);
        $unpossessedSkin = SkinObject::getAllunpossessedSkin($playerId);
        $colorSkin = SkinObject::getColorSkin();
        // Récupère du skin du joueur
        $currentSkin = SkinObject::getCurrentSkinOfPlayer($playerId);
    }


    //Gestion de la couleur de peau
    $selectedSkinId = $_POST["skinColor"] ?? 0;
    if($selectedSkinId != 0) { // cela vérifie que le joueur à bien cliquer sur une couleur
        $selectedSkin = SkinObject::getSkin($selectedSkinId); // récupère la couleur
        //Affecte la couleur au personnage
        $selectedSkin->toggleSkinColor($playerId);
        $possessedSkin = SkinObject::getAllPossessedSkin($playerId);
        $unpossessedSkin = SkinObject::getAllunpossessedSkin($playerId);
        $colorSkin = SkinObject::getColorSkin();
        // Récupère le skin du joueur
        $currentSkin = SkinObject::getCurrentSkinOfPlayer($playerId);
    }

    $view->assign("student", $student);
    $view->assign("selectedSkin", $selectedSkin);
    $view->assign("buyView", $buyView);
    $view->assign("colorSkin", $colorSkin);
    $view->assign("possessedSkin", $possessedSkin);
    $view->assign("unpossessedSkin", $unpossessedSkin);
    $view->assign("currentSkin",$currentSkin);
}
$view->display($outgoing);

?>


