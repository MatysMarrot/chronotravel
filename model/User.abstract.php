<?php

//Abstraite
//Mere de Eleve et Professeur

abstract class User implements Comparable {


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

    //TODO 
    public function compareTo(User $value){
        if($s1->getLastname() == $s2->getLastname() && $s1->getFirstName() == $s2->getFirstName() && $s1->getLogin() == $s2->getLogin() && $s1->getPassword() 
        == $s2->getPassword()){return 0;}

    }

    abstract public function create();

    public function getLastname(){
        return $this->lastname;
    }

    public function getFirstname(){
        return $this->firstname;
    }

    public function getLogin(){
        return $this->login;
    }

    public function getPassword(){
        return $this->password;
    }

    public function getId(){
        return $this->id;
    }

    

    

    


}

?>