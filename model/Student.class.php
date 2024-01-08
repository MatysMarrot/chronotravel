<?php

class Student extends User {

    const BD_ID = 1; // type de l'utilisateur dans la bd

    public function create() : void{

        if ($this->id !== -1) {
            throw new Exception("Create impossible : déjà dans la base avec cet id=" . $this->id);
        }

        $data = [];
        $data[] = $this->lastname;
        $data[] = $this->firstname;
        $data[] = $this->login;
        $data[] = $this->password;
        $data[] = Student::BD_ID;

        // A MODIFIER QUAND LA BD SERA FAITE
        $query = "INSERT INTO Users (lastname,firstname,login,password,privileges) VALUES (?,?,?,?,?)";

        $dao = DAO::get();

        if ($res === false) {
            throw new Exception("Le contact n'a pas été ajouté");
        }

        $this->id = $dao->lastInsertId();

    }

}

?>