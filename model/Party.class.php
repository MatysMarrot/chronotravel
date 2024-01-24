<?php

require_once(__DIR__."/enum/era.enum.php");

class Party{

    
    private bool $ingame = FALSE; // bool permettant de savoir si le jeu est en cours
    private array $studentPosition; //Sous la forme Student1 => Case1, Student2 => Case2 etc ...
    private array $students; // liste des élèves
    private Student $owner; // élève qui a lancé la partie
    private string $code; // code de la game
    private int $id; // laisser la BD gérer
    private Era $era; // thème du plateau courant

    public function __construct(Student $owner){
        $this->owner = $owner;
    }

    public function getEra(): Era {
        return $this->era;
    }

    public  function  getStudentPosition(): array{
        return $this->studentPosition;
    }

    public function setEra(Era $era): void {
        $this->era = $era;
    }

    public function create(){
        $roomCode = generateRandomCode();
        $query = "SELECT code FROM partycode WHERE code = ?";
        $data = [$roomCode];
        $dao = DAO::get();
        $table = $dao->query($query,$data);

        while(count($table) != 0){
            $code = generateRandomCode();
            $data = [$code];
            $table = $dao->query($query,$data);
        }

        $data = [$this->owner->getId()];
        $query = "INSERT INTO party (creatorid) VALUES (?)";
        $dao = DAO::get();
        $dao->query($query,$data);
        $this->id = $dao->lastInsertId();
        $data = [$this->id,$roomCode];
        $query = "INSERT INTO partycode (partyid,code) VALUES (?,?)";
        $dao->query($query,$data);

        $_SESSION['roomCode'] = $roomCode;

    }

    // fonction permettant d'initialisé le jeu
    public function init(){}

    // ajoute un élève à la partie
    public function addStudent(Student $student){
        if(count($this->students) == 4){
            throw new Exception ("Groupe plein");
        }
        else{
            $this->students[] = $student;
        }
    }

    



}

?>