<?php

//Abstraite
//Mere de Eleve et Professeur

abstract class User{

    protected int $id; // Laisser la BD gérer
    protected string $lastname;
    protected string $firstname;
    protected string $login;
    protected string $password;

    public function __construct($lastname,$firstname,$login,$password){

        $this->id = -1; // Objet pas créer dans la BD
        $this->lastname = $lastname;
        $this->firstname = $firstname;
        $this->login = $login;
        $this->password = $password;
    }

    abstract public function create();


    

    


}

?>