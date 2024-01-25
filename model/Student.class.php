<?php
require_once(__DIR__ . '/DAO.class.php');
require_once(__DIR__ . '/User.abstract.php');

class Student extends User {

    const ROLE_ID = 1; // type de l'utilisateur dans la bd
    private int $currency;
    public function create() : void{

        if ($this->id !== -1) {
            throw new Exception("Create impossible : déjà dans la base avec cet id=" . $this->id);
        }

        $data = [];
        $data[] = $this->lastname;
        $data[] = $this->firstname;
        $data[] = $this->login;
        $data[] = $this->password;
        $data[] = 0;
        $data[] = Student::ROLE_ID;
        

        // A MODIFIER QUAND LA BD SERA FAITE
        $query = "INSERT INTO Person (lastname,name,login,password, currency, roleid) VALUES (?,?,?,?,?,?)";

        $dao = DAO::get();

        $res = $dao->exec($query,$data);
        if ($res === false) {
            throw new Exception("L'élève n'a pas été ajouté");
        }

        $this->id = $dao->lastInsertId();
        $query = "INSERT INTO currentskin VALUES (?, null, null, null, null, null, 24)";
        $data = [$this->id];
        $dao->exec($query, $data);
    }

    // return null si pas trouvé, un objet student sinon
    public static function readStudent($id) {
    
        $dao = DAO::get();
        $query = "SELECT * FROM Person WHERE id = ?";
        $data = [$id];
        $table = $dao->query($query, $data);

        if (count($table) == 0) {
            return null;
        }

        $row = $table[0];
        $student = new Student($row['lastname'],$row['name'],$row['login'],$row['password']);
        $student->setCurrency($row["currency"]);
        $student->id = $row['id'];
        return $student;

    }
    private function setCurrency(int $currency) {
        $this->currency = $currency;
    }
    public function getCurrency() : int{
        return $this->currency;
    }
    public function getClassAndTeacherName() : array {
        $dao = DAO::get();
        $query = "SELECT c.name AS class_name, p.name AS teacher_name FROM studentclass sc JOIN class c ON sc.classid = c.id JOIN classteacher ct ON c.id = ct.classid JOIN person p ON ct.teacherid = p.id WHERE sc.studentid = ?";
        $table = $dao->query($query, [$this->getId()]);
        if(count($table) == 0) {
            throw new Exception("Aucune classe trouvée pour l'étudiant n°{$this->getId()}");
        } else if(count($table) > 1) {
            throw new Exception("Plusieurs classes trouvées pour l'étudiant n°{$this->getId()}");
        } else {
            $row = $table[0];
            $result["className"] = $row["class_name"];
            $result["teacherName"] = $row["teacher_name"];
            return $result;
        }
    }
}

?>