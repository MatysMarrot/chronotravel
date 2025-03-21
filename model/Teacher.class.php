<?php
require_once(__DIR__ . '/DAO.class.php');
require_once(__DIR__ . '/User.abstract.php');

class Teacher extends User {

    const ROLE_ID = 2; // type de l'utilisateur dans la bd

    /**
     * @return void
     * @throws Exception
     * Crée un prof dans la base de donnée à partir de l'objet
     */
    public function create() : void{

        if ($this->id !== -1) {
            throw new Exception("Create impossible : déjà dans la base avec cet id=" . $this->id);
        }

        $data = [];
        $data[] = $this->lastname;
        $data[] = $this->firstname;
        $data[] = $this->login;
        $data[] = $this->password;
        $data[] = Teacher::ROLE_ID;

        $query = "INSERT INTO Person (lastname,name,login,password,roleID) VALUES (?,?,?,?,?)";

        $dao = DAO::get();

        $res = $dao->exec($query,$data);

        if ($res === false) {
            throw new Exception("Le prof n'a pas été ajouté");
        }

        $this->id = $dao->lastInsertId();

    }

    /**
     * @param $id
     * @return Teacher
     * @throws Exception
     * Renvoie un prof à partir de son id
     */
    public static function readTeacher($id) : Teacher{
    
        $dao = DAO::get();
        $query = "SELECT * FROM Person WHERE id = ?";
        $data = [$id];
        $table = $dao->query($query, $data);

        if (count($table) == 0) {
            throw new Exception("Prof non trouvé id=$id");
        }

        $row = $table[0];
        $teacher = new Teacher($row['lastname'],$row['name'],$row['login'],$row['password']);
        $teacher->id = $row['id'];
        return $teacher;

    }

}

?>