<?php

include_once(__DIR__."/../framework/view.class.php");
include_once(__DIR__."/../model/Party.class.php");

$view = new View();

$era = Era::ANTIQUITE;
$theme = $era->value;

//var_dump($theme);

$backgroundImages = [];

switch ($era) {
    case Era::ANTIQUITE:
        $antiquiteDirectory = "../view/img/theme/1-antiquite/";
        $backgroundImages = glob($antiquiteDirectory . '*.jpg');
        break;
    case Era::MOYENAGE:
        $moyenageDirectory = "/../view/img/theme/2-moyenage/";
        $backgroundImages = glob($moyenageDirectory . '*.jpg');
        break;
    default:
        break;
}

if (empty($backgroundImages)) {
    $defaultImage = "path/to/default/image.jpg";
    $backgroundImages = [$defaultImage];
}

$randomImage = $backgroundImages[array_rand($backgroundImages)];

$view->assign("theme", $theme);
$view->assign("backgroundImage", $randomImage);
$view->display("quiz.view.php");



?>
