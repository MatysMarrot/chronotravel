<?php

include_once(__DIR__."/../framework/view.class.php");

session_start();

$view = new View();
$outgoing = "contact.view.php";

$view->display("../view/".$outgoing);

?>
