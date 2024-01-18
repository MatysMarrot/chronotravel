<?php

require_once(__DIR__."/enum/era.enum.php");
require_once(__DIR__."/enum/PartyState.enum.php");
require_once(__DIR__."/Question.class.php");
require_once(__DIR__."/../serveurs/party.srvr.php");


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
    private PartyImpl $partyRoom;

    public function __construct(int $partyid,int $ownerid){
        $this->id = $partyid;
        $this->subscribers = array();
        $this->ownerId = $owner;
        $this->owner = $owner;
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
        $query = "INSERT INTO party (creatorid,partystate) VALUES (?,1)";
        $dao->exec($query, $data);
        $this->partyState = 1;

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
    public function addPlayer(int $cid)
    {
        if (count($this->players) >= 4) {
            //throw new Exception ("Groupe plein");
        } else {
            $this->players[$cid] = new Player($cid, $this->partyid);

        }
    }

    public function fetchQuestions(int $size, Era $era)
    {
        for ($i = 0; $i < 10; $i++) {
            $this->questions[] = Question::getRandomQuestionByEra($this->getEra());
        }

    }

    public function broadcast(){
        $data = json_encode($this->getQuestions());
        $this->partyRoom->broadcast($this->subscribers,$data);


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

    }

    public function broadcastQuestions()
    {
        $data = json_encode($this->getQuestions());
        $this->partyRoom->broadcast($this->players, $data);


    }

    public function move()
    {
        $packets = array();
        //TODO: Make the move size gettable
        $packet = new MovePacket($this->partyid, $this->players);
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

    public function getPlayers()
    {
        return $this->players;
    }

    public function getOwnerId()
    {
        return $this->ownerid;
    }

    //ajoute un élève à une partie en BD et dans l'objet
    public function insertPlayer($cid)
    {
        $dao = DAO::get();
        $data = [$cid, $this->id];
        $query = "INSERT INTO partystudent (studentid,partyid) VALUES(?,?)";
        $dao->exec($query, $data);
        $this->players[] = Student::readStudent($cid);
        $this->playerPosition[$cid] = new Position($cid);
    }

    public function removePlayer($cid)
    {
        $dao = DAO::get();
        $data = [$cid];
        $query = "DELETE FROM partystudent WHERE studentid = ?";
        $dao->exec($query, $data);
        foreach ($this->players as $key => $player) {
            if ($player->getId() == $cid) {
                unset($this->players[$key]);
            }
        }
    }

    public function addPackets($packet)
    {
        $this->packets[] = $packet;

    }

    public function getPackets()
    {
        return $this->packets;
    }

    public function getPartyState(){
        return $this->partyState;
    }

    public function getId()
    {
        return $this->id;
    }

    // DELETE LA PARTY
    public function deleteParty()
    {
        $dao = DAO::get();
        $data = [$this->id];
        $query = "DELETE FROM partystudent where partyid = ?";
        $dao->exec($query, $data);
        $query = "DELETE FROM partycode where partyid = ?";
        $dao->exec($query, $data);
        $query = "DELETE FROM party WHERE id = ?";
        $dao->exec($query, $data);
    }

    //return null si pas de party, un objet party sinon
    public static function getPartyFromId($id)
    {
        $dao = DAO::get();
        $data = [$id];
        $query = "SELECT id,partystate,theme,creatorid,code FROM party,partycode WHERE id = ? AND partyid = id";
        $table = $dao->query($query, $data);

        if (count($table) == 0) {
            return null;
        }

        $party = new Party($table[0]['creatorid']);
        $party->id = $table[0]['id'];
        $party->partyState = $table[0]['partystate'];
        $party->code = $table[0]['code'];
        $party->era = $table[0]['theme'];

        $query = "SELECT studentid from partystudent WHERE partyid = ?";
        $table = $dao->query($query, $data);

        foreach ($table as $row) {
            $party->players[] = Student::readStudent($row['studentid']);
        }

        return $party;
    }

    public function startMinigame()
    {
        echo "Sending questions";
        $packet = new QuestionPacket($this->id,$this->getPlayers(),$this->playerPosition);
        // TODO : mettre pour chaque player
        $subscribers = [];
        foreach ($this->getPlayers() as $students) {
            $subscribers[] = $students->getId();
        }
        $this->partyRoom->broadcast($subscribers,$packet->stringifyPlayers()[0]);
        var_dump($packet);


    }

    public function initGame(){

        /*
        $data = [
            "action" => "create",
            "id" => -1,
            "partyId" => 1,
            "owner" => 0,
            "players" => [
                ["id" => 0, "login" => "J1"],
                ["id" => 1, "login" => "J2"]
            ]
        ];
        */
        $this->partyState = 2;
        $dao = DAO::get();
        $query = "UPDATE party SET partystate = 2 WHERE id = ?";
        $dao->exec($query,[$this->id]);

        $packet = new CreatePartyPacket($this);
        $packet = $packet->stringify();
        $subscribers = [];
        foreach ($this->getPlayers() as $students) {
            $subscribers[] = $students->getId();
        }

        echo "Broadcasting";
        $this->partyRoom->broadcast($subscribers, json_encode($packet));
        $this->packets = [];

        $this->startMinigame();

    }


}

?>