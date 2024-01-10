<?php

require_once(__DIR__ . '/../model/Student.class.php');

//PARTIE LECTURE D'UN STUDENT //////////////////////////////////////////////////////////////////////////////////////////

//Test lecture d'un élève présent dans la BD
try{
    print("Vérification de la lecture d'un élève \n"); //TODO insérer un élève dans la BD 1/1/Chemin/Elisee/chemine/123/
    $student = new Student("Chemin","Elisee","chemine","123");
    $studentRequest = Student::readStudent(3);

    if($student->compareTo($studentRequest) != 0 ){
        throw new Exception("Erreur lors de la lecture, mauvais élèves lues\n");
    }
    else{
        print("Réussi à lire un élève \n");
    }

}catch(Exception $e){

    print($e);
    print("Premier élève : \n");
    print("Elève après la requête :\n");

}

//Test lecture avec un élève pas présent dans la base
try{
    print("Vérification lecture élève pas présent dans la BD\n");
    Student::readStudent(1000);
    print("Erreur, l'exception n'a pas été lever\n");
}catch(Exception $e){
    print("Exception levé, test réussi\n");
}


// PARTIE CREATION D'UN STUDENT ////////////////////////////////////////////////////////////////////////////////////////////

//Création d'un élève pas présent dans la BD
try{
    print("Vérification de la création d'un élève\n");
    $student = new Student("Meriche","Mazine","merichem","123");
    $student->create();
    $expected = Student::readStudent($student->getId());
    
    if($student != $expected){
        throw new Exception("Erreur lors de la création d'un élève\n");
    }

}catch(Exception $e){
    print($e);
    print("Premier student :\n");
    print("Student attendu : \n");
}

//Création d'un élève déjà présent dans la BD
try{
    print("Vérification de la non possibilité de créer un élève déjà créer\n");
    $student->create();
    print("Erreur, devrait renvoyer une Exception\n");
}catch(Exception $e){
    print("Exception levé, test réussi\n");
}


?>