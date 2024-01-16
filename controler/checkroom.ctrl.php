<?php

include_once(__DIR__."/../framework/view.class.php");

$view = new View();
$outgoing = "../view/checkroom.view.php";

/*if(!isset($_SESSION["id"])) {
    $outgoing = "../controler/landing.ctrl.php";
}*/

$view->display($outgoing);

?>
