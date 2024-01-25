<?php
require_once(__DIR__ . '/../model/Stat.class.php');
require_once(__DIR__ . '/../model/StatPerGame.class.php');

$myStat = Stat::getStatOf(114);
var_dump($myStat);
?>

