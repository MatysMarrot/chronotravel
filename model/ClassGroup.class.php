<?php

require_once(__DIR__ . '/Student.class.php');
require_once(__DIR__ . '/Teacher.class.php');

class ClassGroup{

    private int $id; // Laisser la BD gérer
    private Teacher $owner; // propriétaire du groupe de classe
    private array $students; // la liste des élèves du groupe de classe
    private string $name;

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

    public function setName(string $name){
        $this->name = $name;
    }

    //TODO
    public function create(){
        
    }


    //TODO A TESTER
    public function insertStudent(Student $student){

        // Ajout dans l'objet
        $this->students[] = $student; 
        
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

    //Retourne la liste des groupes de classe d'un professeur
    //TODO Tester cette fonction
    public static function getClassGroupsFromTeacher(Teacher $teacher) : array {

        $dao = DAO::get();
        $teacherId = $teacher->getId();
        $data = [$teacherId];
        $query = "SELECT name,id FROM classteacher , Class  WHERE classId = id and teacherId = ?";

        $table = $dao->query($query,$data);

        if(count($table) == 0 ){
            throw new Exception("Ce professeur n'a pas de groupe de classe ! ");
        }
        
        $result = [];
        $studentsId = [];

        foreach($table as $row){

            $classGroup = new ClassGroup($teacher);
            $classGroup->setName($row['name']);
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

    public static function getClassGroupFromStudent(Student $student) : ClassGroup{

        $dao = DAO::get();
        $studentId = $student->getId();
        $data = [$studentId];
        $query = "SELECT name,id FROM StudentClass, Class WHERE classId = id and studentId = ?";
        
        $table = $dao->query($query,$data);

        if(count($table) == 0 ){
            throw new Exception("Cet élève n'a pas de groupe de classe ! ");
        }

        $name = $table[0]['name'];
        $groupId = $table[0]['id'];

        $query = "SELECT teacherId FROM ClassTeacher, Class WHERE classId = id";
        $teacherIdRes = $dao->query($query);
        $teacherId = $teacherIdRes[0]['teacherid'];
        $classGroup = new ClassGroup(Teacher::readTeacher($teacherId));
        $classGroup->setName($name);
        $classGroup->id = $groupId;

        $query = "SELECT studentId FROM Class c, StudentClass s WHERE id = classId";
        $table = $dao->query($query);

        foreach($table as $student){
            $classGroup->students[] = Student::readStudent($student['studentid']);
        }

        return $classGroup;

    }

    // TODO : A tester
    public static function getClassGroupFromId($id) : ClassGroup{
        
        $dao = DAO::get();
        $data = [$id];
        $query = "SELECT name teacherid, studentid FROM classteacher t, studentclass s, class c WHERE id = ? AND t.classid = id AND  s.classid = id" ;
        $table = $dao->query($query,$data);
        $teacher = Teacher::readTeacher($table[0]['teacherid']);
        $class = new ClassGroup($teacher);

        foreach($table as $row){
            $class->insertStudent(Student::readStudent($row['studentid']));
        }

        return $class;
    }
}

?>