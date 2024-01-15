<?php
require_once(__DIR__ . '/../model/Question.class.php');

//Création d'une question aléatoire
$question = Question::getRandomQuestion();
echo $question->display();