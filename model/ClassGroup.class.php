<?php

require_once(__DIR__ . '/Student.class.php');
require_once(__DIR__ . '/Teacher.class.php');

class ClassGroup{

    private int $id; // Laisser la BD gérer
    private Teacher $owner; // propriétaire du groupe de classe
    private array $students; // la liste des élèves du groupe de classe

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

    //TODO
    public function create(){}


    //TODO A TESTER
    public function insertStudent(Student $student){

        // Ajout dans l'objet
        $this->students[] = $student; 
        
        // Ajout dans la BD
        $dao = DAO::get();
        $data = [$student->getId()];
        $data[] = $this->id;
        $query = "INSERT INTO StudentClass (studentId, classId)VALUES (?,?)";

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
        $query = "SELECT id FROM ClassTeacher , Class  WHERE classId = id and teacherId = ?";

        $table = $dao->query($query,$data);

        if(count($table) == 0 ){
            throw new Exception("Ce professeur n'a pas de groupe de classe ! ");
        }
        
        $result = [];
        $studentsId = [];

        foreach($table as $classId){

            $classGroup = new ClassGroup($teacher);
            $classGroup->id = $classId['id'];
            $query = "SELECT studentId FROM Class, StudentClass WHERE id = classId";
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
        $query = "SELECT id FROM StudentClass, Class WHERE classId = id and studentId = ?";
        
        $table = $dao->query($query,$data);

        if(count($table) == 0 ){
            throw new Exception("Cet élève n'a pas de groupe de classe ! ");
        }

        $groupId = $table[0]['id'];

        $query = "SELECT teacherId FROM ClassTeacher, Class WHERE classId = id";
        $teacherIdRes = $dao->query($query);
        $teacherId = $teacherIdRes[0]['teacherid'];
        $classGroup = new ClassGroup(Teacher::readTeacher($teacherId));
        $classGroup->id = $groupId;

        $query = "SELECT studentId FROM Class c, StudentClass s WHERE id = classId";
        $table = $dao->query($query);

        foreach($table as $student){
            $classGroup->students[] = Student::readStudent($student['studentid']);
        }

        return $classGroup;




    }
}

?>