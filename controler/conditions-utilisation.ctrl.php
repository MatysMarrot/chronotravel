<?php

include_once(__DIR__."/../framework/view.class.php");

$view = new View();
$outgoing = "condition-utilisation.view.php";

$view->display("../view/".$outgoing);

?>