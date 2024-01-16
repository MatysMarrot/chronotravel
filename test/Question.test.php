<?php
require_once(__DIR__ . '/../model/Question.class.php');

//Création d'une question aléatoire
$question = Question::getRandomQuestion();
//echo $question->display();

//Récupérer le nombre de questions en DB
$size = Question::getQuestionsSize();
print("size : ");
print($size + "\n");


//Trying to get answers
$question->getAnswers();
?>
