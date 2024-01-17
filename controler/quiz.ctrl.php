<?php

include_once(__DIR__."/../framework/view.class.php");

$view = new View();

$theme = "";


$view->assign("theme", $theme);
$view->display("quiz.view.php");

?>