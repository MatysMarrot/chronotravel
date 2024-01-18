<?php
require_once(__DIR__ . '/../model/Question.class.php');
require_once(__DIR__ . '/../model/enum/era.enum.php');


//Création d'une question aléatoire
$question = Question::getRandomQuestionByEra(Era::MODERN_AGES);
//echo $question->display();

//Récupérer le nombre de questions en DB
/*$size = Question::getQuestionsSize();
print("size : ");
print($size + PHP_EOL);*/


//Trying to get answers
$question->display();

//$question->registerQuestion("Comment s'appellent les habitants du Québec ?",2);
?>
