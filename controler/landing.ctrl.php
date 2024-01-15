<?php
//Inclure le php
include_once(__DIR__."/../framework/view.class.php");

include(__DIR__."/../view/landingpage.php");

var_dump($_SESSION);

// Controler
$view = new View();
$outgoing = "landingpage.view.php";

$view->display("../view/".$outgoing);
?>