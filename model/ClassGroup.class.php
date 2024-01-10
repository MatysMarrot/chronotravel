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

    //TODO
    public function create(){}


    //TODO
    public function insertStudent(){}

    //Retourne la liste des groupes de classe d'un professeur
    //TODO Tester cette fonction
    public static function getClassGroupFromTeacher(Teacher $teacher) : array {

        $dao = DAO::get();
        $teacherId = $teacher->getId();
        $data = [$teacherId];
        $query = "SELECT id FROM ClasseProf p, Class c WHERE classId = id and teacherId = ?";

        $table = $dao->query($query,$data);

        if(count($table) == 0 ){
            throw new Exception("Ce professeur n'a pas de groupe de classe ! ");
        }
        
        $result = [];
        $studentsId = [];

        foreach($table as $classId){

            $classGroup = new ClassGroup($teacher);
            $classGroup->id = $classId['id'];
            $query = "SELECT studentId FROM Class c, StudentClass s WHERE id = classId";
            $studentsId = $dao->query($query);

            foreach($studentsId as $studentId){

                $student = Student::readStudent($studentId['studentId']);
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
        $query = "SELECT id FROM StudentClass s, Class c WHERE classId = id and studentId = ?";
        
        $table = $dao->query($query,$studentId);

        if(count($table) == 0 ){
            throw new Exception("Cet élève n'a pas de groupe de classe ! ");
        }

        $groupId = $table[0]['id'];

        $query = "SELECT teacherId FROM ClasseProf p, Class c WHERE classId = id";
        $teacherIdRes = $dao->query($query);
        $teacherId = $teacherIdRes[0]['teacherId'];
        $classGroup = new GroupClass(Teacher::readTeacher($teacherId));
        $classGroup->id = $groupId;

        $query = "SELECT studentId FROM Class c, StudentClass s WHERE id = classId";
        $table = $dao->query($query);

        foreach($table as $student){
            $classGroup->students[] = Student::readStudent($student['studentId']);
        }

        return $classGroup;




    }
}

?>