<?php

require_once(__DIR__ . '/Student.class.php');
require_once(__DIR__ . '/Teacher.class.php');
require_once(__DIR__ . '/../controler/utils/Utils.php');

class ClassGroup{

    private int $id; // Laisser la BD gérer
    private Teacher $owner; // propriétaire du groupe de classe
    private array $students; // la liste des élèves du groupe de classe
    private string $name;
    private string $code;

    public function __construct(Teacher $owner){
        $this->owner = $owner;
    }

    public function getStudents(){
        return $this->students;
    }

    public function getId(){
        return $this->id;
    }

    public function getOwner(){
        return $this->owner;
    }

    public function getName(){
        return $this->name;
    }

    public function getCode(){
        return $this->code;
    }

    //TODO a tester
    public function create(){
        $dao = DAO::get();
        $data = [generateRandomCode()];
        $query = "INSERT INTO class (code) VALUES (?)";
        $res = $dao->exec($query,$data);
    }


    // AJOUTE UN STUDENT DANS LA DB
    public function insertStudent(Student $student){

        
        // Ajout dans la BD
        $dao = DAO::get();
        $data = [$student->getId()];
        $data[] = $this->id;
        $query = "INSERT INTO studentclass (studentId, classId)VALUES (?,?)";

        $res = $dao->exec($query,$data);

        if($res === false){
            throw new Exception("Erreur, l'ajout d'un étudiant dans la classe ne s'est pas déroulé correctement");
        }


    }

    //AJOUTE LE STUDENT DANS L'ATRIBUT DE L'OBJECT COURANT DANS STUDENTS
    public function addStudent(Student $tudent){
        $this->students[] = $student; 
    }

    //Retourne la liste des groupes de classe d'un professeur ou une liste vide si rien trouvé
    public static function getClassGroupsFromTeacher(Teacher $teacher) : array {

        $dao = DAO::get();
        $teacherId = $teacher->getId();
        $data = [$teacherId];
        $query = "SELECT code,name,id FROM classteacher , Class  WHERE classId = id and teacherId = ?";

        $table = $dao->query($query,$data);

        if(count($table) == 0 ){
            //renvoie une array vide si il n'ya pas de classe
            return [];
        }
        
        $result = [];
        $studentsId = [];

        foreach($table as $row){

            $classGroup = new ClassGroup($teacher);
            $classGroup->code = $row['code'];
            $classGroup->name = $row['name'];
            $classGroup->id = $row['id'];
            $query = "SELECT studentId FROM Class, studentclass WHERE id = classId";
            $studentsId = $dao->query($query);
            var_dump($studentsId);
            foreach($studentsId as $studentId){
                var_dump($studentId);

                $student = Student::readStudent($studentId['studentid']);
                $classGroup->students[] = $student;

            }

            $result[] = $classGroup;

        }

        return $result;

    }

    // Renvoie un objet ClassGroup ou null si pas trouvé
    public static function getClassGroupFromStudent(Student $student){

        $dao = DAO::get();
        $studentId = $student->getId();
        $data = [$studentId];
        $query = "SELECT code,name,id FROM StudentClass, Class WHERE classId = id and studentId = ?";
        
        $table = $dao->query($query,$data);

        if(count($table) == 0 ){
            //renvoie null si il n'ya pas de classe
            return null;
        }

        $name = $table[0]['name'];
        $groupId = $table[0]['id'];
        $code = $table[0]['code'];

        $query = "SELECT teacherId FROM ClassTeacher, Class WHERE classId = id";
        $teacherIdRes = $dao->query($query);
        $teacherId = $teacherIdRes[0]['teacherid'];
        $classGroup = new ClassGroup(Teacher::readTeacher($teacherId));
        $classGroup->code = $code;
        $classGroup->name = $name;
        $classGroup->id = $groupId;

        $query = "SELECT studentId FROM Class c, StudentClass s WHERE id = classId";
        $table = $dao->query($query);

        foreach($table as $student){
            $classGroup->students[] = Student::readStudent($student['studentid']);
        }

        return $classGroup;

    }

    //Renvoie un objet ClassGroup ou null si pas trouvé
    public static function getClassGroupFromId($id){
        
        $dao = DAO::get();
        $data = [$id];
        $query = "SELECT code,name,teacherid FROM classteacher t, class c WHERE id = ? AND t.classid = id" ;
        $table = $dao->query($query,$data);

        if(count($table) == 0){
            //return null si il n'y a pas de classe avec cette id
            return null;
        }

        $teacher = Teacher::readTeacher($table[0]['teacherid']);
        $class = new ClassGroup($teacher);
        $class->code = $table[0]['code'];
        $class->name = $table[0]['name'];
        $class->id = $id;

        $query = "SELECT studentid from studentclass, class WHERE id = ? AND classid = id";
        $table = $dao->query($query,$data);
        if(count($table) != 0){
            foreach($table as $row){
                $class->students[] = Student::readStudent($row['studentid']);
            }
        }

        return $class;
    }

    public function removeStudent(Student $student){

        $dao = DAO::get();
        $data = [$student->getId()];
        $query = "DELETE FROM studentclass WHERE studentid = ?";
        $res = $dao->exec($query,$data);

    }
}

?>