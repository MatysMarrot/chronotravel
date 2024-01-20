<?php
require_once(__DIR__ . '/../model/SkinObject.class.php');
require_once(__DIR__ . '/../model/Student.class.php');


//var_dump(SkinObject::getAllSkinObjects());

//var_dump(SkinObject::getCurrentSkinOfPlayer(107));
//var_dump(SkinObject::getCurrentSkinOfPlayer(109));

$skin1 = new SkinObject(1, "Pantalon bleu", 1000, "blue-pants.png", "pants");
$skin2 = new SkinObject(2, "Cheveux court brun", 1000, "brown-hair.png", "hair");

//var_dump($skin1->isPossessedBy(109));
//var_dump($skin2->isPossessedBy(109));

//var_dump(SkinObject::getAllPossessedSkin(109));
//var_dump(SkinObject::getAllunpossessedSkin(109));

$skin3 = new SkinObject(3, "Couronne", "1200", "crown.png", "hat");
//$skin3->isEquiped(109);
//$skin2->isEquiped(109);
//$skin2->toggleSkin(109);

//$currentSkin = [$skin3, null, null, $skin1, null];
//$skin2->previewSkin($currentSkin);

//$currentSkin = [null, $skin2, null, $skin1, null];
$skin4 = new SkinObject(3, "Couronne", 1200, "crown.png", "hat");
//$skin4->previewSkin($currentSkin);
//var_dump($currentSkin);

//$student = Student::readStudent(109);
//$skin4->isBuyBy($student);
?>