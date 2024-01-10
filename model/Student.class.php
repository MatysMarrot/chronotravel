<?php
require_once(__DIR__ . '/DAO.class.php');
require_once(__DIR__ . '/User.abstract.php');

class Student extends User {

    const ROLE_ID = 1; // type de l'utilisateur dans la bd

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
        $query = "INSERT INTO Person (lastname,name,login,password,roleid) VALUES (?,?,?,?,?)";

        $dao = DAO::get();

        $res = $dao->exec($query,$data);

        if ($res === false) {
            throw new Exception("L'élève n'a pas été ajouté");
        }

        $this->id = $dao->lastInsertId();

    }

    public static function readStudent(int $id) : Student{
    
        $dao = DAO::get();
        $query = "SELECT * FROM Person WHERE id = ?";
        $data = [$id];
        $table = $dao->query($query, $data);

        if (count($table) == 0) {
            throw new Exception("Elève non trouvé id=$id");
        }

        $row = $table[0];
        $student = new Student($row['lastname'],$row['name'],$row['login'],$row['password']);
        $student->id = $row['id'];
        return $student;

    }

}

?>