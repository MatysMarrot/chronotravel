<?php

require_once(__DIR__."/enum/era.enum.php");
require_once(__DIR__."/enum/PartyState.enum.php");
require_once(__DIR__."/Question.class.php");
require_once(__DIR__."/../serveurs/Player.class.php");

require_once(__DIR__."/../serveurs/party.srvr.php");





    private int $partyid;
    private int $ownerid;
    private bool $ingame = FALSE; // bool permettant de savoir si le jeu est en cours
    private array $studentPosition; //Sous la forme Student1 => Case1, Student2 => Case2 etc ...
    private array $players; // liste des élèves
    private string $code; // code de la game
    private int $id; // laisser la BD gérer
    private Era $era; // thème du plateau courant
    private PartyState $partyState;
    private array $questions;
    private PartyImpl $partyRoom;


    public function __construct(int $ownerid){
        $this->players = array();
        $this->ownerid = $ownerid;
        $this->partyState = PartyState::WAITING_FOR_ANSWER;
        $this->questions = array();
        $this->partyRoom = new PartyImpl();
    }

    public function getEra(): Era
    {
        return $this->era;
    }

    public function setEra(Era $era): void
    {
        $this->era = $era;
    }

    public function create()
    {

        $roomCode = generateRandomCode();
        $query = "SELECT code FROM partycode WHERE code = ?";
        $data = [$roomCode];
        $dao = DAO::get();
        $table = $dao->query($query, $data);

        $data = [$this->ownerid];
        $query = "INSERT INTO party (creatorid) VALUES (?)";
        $dao = DAO::get();
        $dao->query($query,$data);
        $this->id = $dao->lastInsertId();
        $data[] = $this->id;
        $query = "INSERT INTO partystudent (studentid,partyid) VALUES (?,?)";
        $dao->exec($query, $data);
        $studentOwner = Student::readStudent($this->ownerid);
        $this->players[] = $studentOwner;
        $this->playerPosition[$studentOwner->getId()] = new Position($studentOwner->getId());


        $data = [$this->id, $roomCode];
        $query = "INSERT INTO partycode (partyid,code) VALUES (?,?)";
        $dao->exec($query, $data);

        $_SESSION['roomCode'] = $roomCode;
        $_SESSION['partyId'] = $this->id;


    }


    // ajoute un élève à la partie
    public function addPlayer(int $cid){
        if(count($this->players) >= 4){
            //throw new Exception ("Groupe plein");
        }
        else{
            $this->players[$cid] = new Player($cid, $this->partyid);
        }
    }

    public function fetchQuestions(int $size, Era $era)
    {
        for ($i = 0; $i < 10; $i++) {
            $this->questions[] = Question::getRandomQuestionByEra($this->getEra());
        }

    }

    public function broadcastQuestions(){
        $data = json_encode($this->getQuestions());
        $this->partyRoom->broadcast($this->players,$data);


    }

    public function move(){
        $packets = array();
            //TODO: Make the move size gettable
            $packet = new MovePacket($this->partyid,$this->players);
            $encode = $packet->stringify();
            $this->getPartyRoom()->broadcast($this->players, $encode);


    }

    /**
     * @param PartyState $partyState
     */
    public function setPartyState(PartyState $partyState): void
    {
        $this->partyState = $partyState;
    }

    /**
     * @return array
     */
    public function getQuestions(): array
    {
        return $this->questions;
    }

    /**
     * @return PartyImpl
     */
    public function getPartyRoom(): PartyImpl
    {
        return $this->partyRoom;
    }




}

?>