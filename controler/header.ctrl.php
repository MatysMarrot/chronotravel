<?php

//Si pas connecté
include(__DIR__."/../view/header.unknown.viewpart.php");

//Si élève connecté
include(__DIR__."/../view/header.student.viewpart.php");

//Si professeur connecté
include(__DIR__."/../view/header.teacher.viewpart.php");


?>