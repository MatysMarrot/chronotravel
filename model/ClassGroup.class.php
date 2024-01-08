<?php

class ClassGroup{

    private int $id; // Laisser la BD gérer
    private Teacher $owner; // propriétaire du groupe de classe
    private array $students; // la liste des élèves du groupe de classe

    public function __construct(Teacher $owner){
        $this->owner = $owner;
    }


    //TODO
    public function create(){}


    //TODO
    public function insertStudent(){}
}

?>