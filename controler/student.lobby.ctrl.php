<?php
include_once(__DIR__ . "/../framework/view.class.php");
$formulaireComplet = isset($_SESSION['login']) && isset($_SESSION['id']) && isset($_SESSION['roomCode']);

$view = new View();
if (!$formulaireComplet){
    //pas connecté
    $view->display("../controler/landing.ctrl.php");
}
$dao = DAO::get();
$data = [$_SESSION['roomCode']];
$query = "SELECT creatorid FROM party p, partycode c WHERE code = ? AND partyid = id ";
$table = $dao->query($query,$data);
$isOwner =$table[0][0] == $_SESSION['id'] ?? false;
$view->assign("isOwner", $isOwner);
$view->display("../view/waitroom.view.php");

