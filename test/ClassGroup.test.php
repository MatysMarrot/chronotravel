<?php

require_once(__DIR__ . '/../model/Student.class.php');
require_once(__DIR__ . '/../model/Teacher.class.php');
require_once(__DIR__ . '/../model/ClassGroup.class.php');

//Test méthode getClassGroupFromTeacher

/*
$teacher = Teacher::readTeacher(108);
$group = ClassGroup::getClassGroupsFromTeacher($teacher);
var_dump($group);
var_dump($group[0]->getStudents());
*/

//Test méhode getClassGroupFromStudent

/* 
$student = new Student("Chemin","Elisee","chemine","123");
$student->setId(3);
$group = ClassGroup::getClassGroupFromStudent($student);
var_dump($group)
*/

/*
$teacher = Teacher::readTeacher(108);
$class = ClassGroup::getClassGroupsFromTeacher($teacher);
var_dump($class);
*/

//Test méthode getClassGroupFromId
/*
$class = ClassGroup::getClassGroupFromId(-1);
var_dump($class);
*/
?>