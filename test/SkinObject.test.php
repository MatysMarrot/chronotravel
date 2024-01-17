<?php
require_once(__DIR__ . '/../model/SkinObject.class.php');


var_dump(SkinObject::getAllSkinObjects());

var_dump(SkinObject::getCurrentSkinOfPlayer(107));
var_dump(SkinObject::getCurrentSkinOfPlayer(109));


?>