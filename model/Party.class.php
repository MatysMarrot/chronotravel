<?php

require_once(__DIR__."/enum/era.enum.php");
require_once(__DIR__."/enum/PartyState.enum.php");


class Party{

    private int $partyid;
    private int $ownerid;
    private bool $ingame = FALSE; // bool permettant de savoir si le jeu est en cours
    private array $studentPosition; //Sous la forme Student1 => Case1, Student2 => Case2 etc ...
    private array $subscribers; // liste des élèves
    private string $code; // code de la game
    private int $id; // laisser la BD gérer
    private Era $era; // thème du plateau courant
    private PartyState $partyState;
    private array $questions;

    public function __construct(int $partyid,int $ownerid){
        $this->id = $partyid;
        $this->subscribers = array();
        $this->ownerid = $ownerid;
        $this->partyState = PartyState::WAITING_FOR_ANSWER;
    }

    public function getEra(): Era {
        return $this->era;
    }

    public function setEra(Era $era): void {
        $this->era = $era;
    }

    // fonction permettant d'initialisé le jeu
    public function init(){}

    // ajoute un élève à la partie
    public function addStudent(Student $student){
        if(count($students) == 4){
            throw new Exception ("Groupe plein");
        }
        else{
            $this->students[] = $student;
        }
    }

    public function fetchQuestions(int $size, Era $era)
    {
        //TODO
    }

    



}

?>