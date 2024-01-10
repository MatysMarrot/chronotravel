<?php

require_once(__DIR__ . '/../model/Student.class.php');
require_once(__DIR__ . '/../model/Teacher.class.php');
require_once(__DIR__ . '/../model/ClassGroup.class.php');

//Test méthode getClassGroupFromTeacher
$teacher = new Teacher("Hakati","Yanis","harkaty","123");
$teacher->setId(2);
$group = ClassGroup::getClassGroupFromTeacher($teacher);
print("Groupe du prof : \n");
print("Elèves : \n");
var_dump($group);
var_dump($group[0]->getStudents());

//Test méhode getClassGroupFromStudent
$student = new Student("Chemin","Elisee","chemine","123");
$student->setId(1);
$group = ClassGroup::getClassGroupFromStudent($student);
var_dump($group)



?>