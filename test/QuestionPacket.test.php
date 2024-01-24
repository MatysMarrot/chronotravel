<?php
require_once(__DIR__ . '/../serveurs/QuestionPacket.class.php');
require_once(__DIR__ . '/../serveurs/Player.class.php');

$players = array();
$players[] = new Player(1,5);
$players[] = new Player(2,5);
$players[] = new Player(3,5);
$players[] = new Player(4,5);
$questionPacket = new QuestionPacket(-1,$players,$players[0]);

var_dump($questionPacket->stringifyPlayers());
?>