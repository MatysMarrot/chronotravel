<?php

include_once(__DIR__."/../framework/view.class.php");

$view = new View();
$outgoing = "admin.messaging.view.php";

$view->display("../view/".$outgoing);

?>
