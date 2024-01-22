<?php
require_once(__DIR__ . '/../serveurs/MovePacket.class.php');
require_once(__DIR__ . '/../serveurs/Player.class.php');



$players = array();
$players[] = new Player(1,5);
$players[] = new Player(2,5);
$players[] = new Player(3,5);
$players[] = new Player(4,5);

$players[0]->

$movePacket1 = new MovePacket($players[0]->getId(),5,$players);


var_dump($movePacket1->stringify());


?>