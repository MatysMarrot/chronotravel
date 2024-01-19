<?php

include_once(__DIR__."/../framework/view.class.php");
include_once(__DIR__."/../model/Party.class.php");

$view = new View();

$era = Era::ANTIQUITY;

//var_dump($era);

$backgroundImages = [];

switch ($era) {
    case Era::ANTIQUITY:
        $antiquiteDirectory = "../view/img/theme/1-antiquite/";
        $backgroundImages = glob($antiquiteDirectory . '*.jpg');
        $theme = "Antiquité";
        break;
    case Era::MIDDLE_AGES:
        $moyenageDirectory = "../view/img/theme/2-moyenage/";
        $backgroundImages = glob($moyenageDirectory . '*.jpg');
        $theme = "Moyen Âge";
        break;
    case Era::MODERN_AGES:
        $moderneDirectory = "../view/img/theme/3-moderne/";
        $backgroundImages = glob($moderneDirectory . '*.jpg');
        $theme = "Époque moderne";
        break;
    case Era::CONTEMPORARY_TIMES:
        $contempDirectory = "../view/img/theme/4-contemp/";
        $backgroundImages = glob($contempDirectory . '*.jpg');
        $theme = "Époque contemporaine";
        break;
    default:
        break;
}

/*if (empty($backgroundImages)) {
    $defaultImage = "path/to/default/image.jpg";
    $backgroundImages = [$defaultImage];
}*/

$randomImage = $backgroundImages[array_rand($backgroundImages)];

$view->assign("theme", $theme);
$view->assign("backgroundImage", $randomImage);
$view->display("../view/quiz.view.php");

?>
