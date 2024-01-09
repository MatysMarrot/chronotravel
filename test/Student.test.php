<?php

require_once(__DIR__ . '/../model/Student.class.php');

try{
    print("Vérification de la création d'un élève");
    $student = new Student("Meriche","Mazine","merichem","123");
    $student->create();
    $expected = Student::readStudent($student->getId());
    
    if($student != $expected){
        throw new Exception("Erreur lors de la création d'un élève");
    }

}catch(Exception $e){

}


?>