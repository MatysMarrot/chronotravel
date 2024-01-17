<?php

include_once(__DIR__."/../framework/view.class.php");

$view = new View();
$outgoing = "../view/home.view.php";

if(!isset($_SESSION["id"])) {
    $outgoing = "../controler/landing.ctrl.php";
}

$view->display($outgoing);

?>
