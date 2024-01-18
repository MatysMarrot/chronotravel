<?php
require_once(__DIR__ . '/../model/SkinObject.class.php');


var_dump(SkinObject::getAllSkinObjects());

var_dump(SkinObject::getCurrentSkinOfPlayer(107));
var_dump(SkinObject::getCurrentSkinOfPlayer(109));

$skin1 = new SkinObject(1, "Pantalon bleu", 1000, "blue-pants.png", 4);
$skin2 = new SkinObject(2, "Cheveux court brun", 1000, "brown-hair.png", 2);

var_dump($skin1->isPossessedBy(109));
var_dump($skin2->isPossessedBy(109));

var_dump(SkinObject::getAllPossessedSkin(109));
var_dump(SkinObject::getAllunpossessedSkin(109));

?>