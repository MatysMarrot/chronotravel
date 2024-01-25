<?php

require_once(__DIR__ . '/Student.class.php');
require_once(__DIR__ . '/Teacher.class.php');
require_once(__DIR__ . '/../controler/utils/Utils.php');

class ClassGroup{

    private int $id; // Laisser la BD gérer
    private Teacher $owner; // propriétaire du groupe de classe
    private array $students = []; // la liste des élèves du groupe de classe
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

    public function setName($name){
        $dao = DAO::get();
        $this->name = $name;
        $data = [$name,$this->id];
        $query = "UPDATE class SET name = ? WHERE id = ?";
        $res = $dao->exec($query,$data);
    }


    /**
     * @param $name
     * @return void
     * Crée une classe dans la base de donnée à partir de l'objet
     */
    public function create($name){
        $dao = DAO::get();
        $code  = generateRandomCode();

        //vérification que le code est unique
        $data = [$code];
        $query = "SELECT code FROM class WHERE code = ?";
        $table = $dao->query($query,$data);

        while(count($table) != 0){
            $code = generateRandomCode();
            $data = [$code];
            $table = $dao->query($query,$data);
        }

        $this->code = $code;
        $this->name = $name;

        $query = "INSERT INTO class (name,code) VALUES ('$name',?)";
        $res = $dao->exec($query,$data);

        $data = [$dao->lastInsertId(),$this->owner->getId()];
        $query = "INSERT INTO classteacher (classid,teacherid) VALUES(?,?)";
        $res = $dao->exec($query,$data);
    }

    /**
     * @return void
     * Supprime la classe associé dans la base de donnée
     */
    public function delete(){
        $dao = DAO::get();
        $data = [$this->id];
        $query = "DELETE FROM studentclass WHERE classid = ?";
        $res = $dao->exec($query,$data);
        $query = "DELETE FROM classteacher WHERE classid = ?";
        $res = $dao->exec($query,$data);
        $query = "DELETE FROM class WHERE id = ?";
        $res = $dao->exec($query,$data);
    }


    // AJOUTE UN STUDENT DANS LA DB

    /**
     * @param Student $student
     * @return void
     * @throws Exception
     * Ajoute un étudiant à la classe dans la base de donnée
     */
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

    /**
     * @param Student $student
     * @return void
     * Ajoute un élève dans un attribut array de l'objet
     */
    public function addStudent(Student $student){
        $this->students[] = $student; 
    }

    /**
     * @param Teacher $teacher
     * @return array
     * Retourne la liste des groupes de classes ClassGroup d'un professeur si il y'en a, retourne une liste vide si rien n'est trouvé
     */
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
            $data = [$row['id']];
            $query = "SELECT studentId FROM Class, studentclass WHERE id = classId AND classId = ?";
            $studentsId = $dao->query($query,$data);
            foreach($studentsId as $studentId){
                $student = Student::readStudent($studentId['studentid']);
                $classGroup->students[] = $student;

            }

            $result[] = $classGroup;

        }

        return $result;

    }

    /**
     * @param Student $student
     * @return ClassGroup|null
     * @throws Exception
     * Renvoie le groupe de classe ClassGroup de l'élève, renvoie null si il y en a pas
     */
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

        $data = [$groupId];
        $query = "SELECT teacherId FROM ClassTeacher, Class WHERE classId = id and classid = ?";
        $teacherIdRes = $dao->query($query,$data);
        $teacherId = $teacherIdRes[0]['teacherid'];
        $classGroup = new ClassGroup(Teacher::readTeacher($teacherId));
        $classGroup->code = $code;
        $classGroup->name = $name;
        $classGroup->id = $groupId;

        $query = "SELECT studentId FROM Class c, StudentClass s WHERE id = classId AND classid = ?";
        $table = $dao->query($query,$data);

        foreach($table as $student){
            $classGroup->students[] = Student::readStudent($student['studentid']);
        }

        return $classGroup;

    }

    //Renvoie un objet ClassGroup ou null si pas trouvé

    /**
     * @param $id
     * @return ClassGroup|null
     * @throws Exception
     * Renvoie un objet ClassGroup correspondant à l'id donné, renvoie null sinon
     */
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

        foreach($this->students as $key => $currentStudent){
            if($student->getId() == $currentStudent->getId()){
                unset($this->students[$key]);
            }
        }

    }
}

?>