<?php

class Teacher extends User {

    const ROLE_ID = 2; // type de l'utilisateur dans la bd

    public function create() : void{

        if ($this->id !== -1) {
            throw new Exception("Create impossible : déjà dans la base avec cet id=" . $this->id);
        }

        $data = [];
        $data[] = $this->lastname;
        $data[] = $this->firstname;
        $data[] = $this->login;
        $data[] = $this->password;
        $data[] = Student::ROLE_ID;

        // A MODIFIER QUAND LA BD SERA FAITE
        $query = "INSERT INTO Users (lastname,firstname,login,password,privileges) VALUES (?,?,?,?,?)";

        $dao = DAO::get();

        $res = $dao->exec($query,$data);

        if ($res === false) {
            throw new Exception("Le contact n'a pas été ajouté");
        }

        $this->id = $dao->lastInsertId();

    }

    public static function readTeacher(int $id) : Teacher{
    
        $dao = DAO::get();
        $query = "SELECT * FROM User WHERE id = ?";
        $table = $dao->query($query, $id);

        if (count($table) == 0) {
            throw new Exception("Contact non trouvé id=$id");
        }

        $row = $table[0];
        $teacher = new Teacher($row['lastname'],$row['firstname'],$row['login'],$row['password']);
        $teacher->id = $row['id'];
        return $teacher;

    }

}

?>