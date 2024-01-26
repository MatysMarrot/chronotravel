<?php

//Abstraite
//Mere de Eleve et Professeur

abstract class User {


    protected int $id; // Laisser la BD gérer
    protected string $lastname; //Nom de famille
    protected string $firstname; //Prénom
    protected string $login; //Login
    protected string $password; //Mot de passe

    public function __construct($lastname,$firstname,$login,$password){

        $this->id = -1; // Objet pas créer dans la BD
        $this->lastname = $lastname;
        $this->firstname = $firstname;
        $this->login = $login;
        $this->password = $password;
    }

    //TODO 
    public function compareTo(User $s2){
        if($this->getLastname() == $s2->getLastname() && $this->getFirstName() == $s2->getFirstName() && $this->getLogin() == $s2->getLogin() && $this->getPassword() 
        == $s2->getPassword()){return 0;}
        return -1;
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