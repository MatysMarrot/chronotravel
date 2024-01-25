<?php

require_once(__DIR__ . "/enum/era.enum.php");
require_once(__DIR__ . "/../controler/utils/Utils.php");
require_once(__DIR__ . "/enum/PartyState.enum.php");
require_once(__DIR__ . "/Question.class.php");
require_once(__DIR__ . "/../serveurs/Player.class.php");
require_once(__DIR__ . "/../serveurs/CreatePartyPacket.class.php");

require_once(__DIR__ . "/../serveurs/party.srvr.php");


class Party
{

    private array $playerPosition = [];
    private int $ownerid;
    private array $players; // liste des élèves
    private string $code; // code de la game
    private int $id; // laisser la BD gérer
    private $era; // thème du plateau courant
    private int $partyState = 0;
    private array $questions;
    private PartyImpl $partyRoom;
    private $packets;


    public function __construct(int $ownerid)
    {
        $this->players = array();
        $this->ownerid = $ownerid;
        $this->questions = array();
        $this->partyRoom = PartyImpl::get();
    }

    public function getEra(): Era
    {
        return $this->era;
    }

    public  function  getStudentPosition(): array{
        return $this->studentPosition;
    }

    public function setEra(Era $era): void {
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

    public function broadcastQuestions()
    {
        $data = json_encode($this->getQuestions());
        $this->partyRoom->broadcast($this->players, $data);


    }

    public function move()
    {
        $packets = array();
        //TODO: Make the move size gettable
        $subscribers =[];
        foreach ($this->getPlayers() as $students) {
            $subscribers[] = $students->getId();
        }
        $packet = new MovePacket($this->id, $this->playerPosition);
        $encode = $packet->stringify();
        var_dump($encode);
        $this->partyRoom->broadcast($subscribers, $encode);

        // Gestion de la victoire
        $winners = [];
        foreach ($this->playerPosition as $player){
            var_dump($player->getPosition());
            if($player->getPosition() >= 31){
                $winners[] = $player;
                var_dump($player);
                var_dump($winners);
            }
        }

        if($winners){
            $packet = new VictoryPacket($this->id,$winners);
            $encode = $packet->stringify();
            var_dump($encode);
            $this->partyRoom->broadcast($subscribers,$encode);
        }
        else{
            $this->startMinigame();
        }


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
            $party->playerPosition[$row['studentid']] = new Position($row['studentid']);
        }

        return $party;
    }

    public function startMinigame()
    {
        echo "Sending questions";
        $this->packets = [];
        $packet = new QuestionPacket($this->id,$this->getPlayers(),$this->playerPosition);
        // TODO : mettre pour chaque player
        $subscribers = [];
        foreach ($this->getPlayers() as $students) {
            $subscribers[] = $students->getId();
        }
        $this->partyRoom->broadcast($subscribers,$packet->stringifyPlayers()[0]);


    }

    public function manageAnwser(){
        $mapPlayernbrAnswer = [];
        $dao = DAO::get();

        foreach($this->packets as $packet){
            if (!$packet instanceof AnswerPacket){
                echo "man faut passer un answer packet ici !\n";
                return;
            }

            $mapPlayernbrAnswer[$packet->getId()] = $packet->getNbrRightAnswers();

            //On prend la position des joueurs pour connaitre l'ere dans laquelle ils sont
            $pos = $this->playerPosition[$packet->getId()];

            //Function from utils.php
            $strEra = getEraFromInt((int) ($pos->getPosition() / 8));
            if ($strEra === false){
                continue;
            }

            $erascore = $strEra."score";
            $eraCorrect = $strEra."correctanswers";

            $dao = DAO::get();

            $query = "UPDATE STAT SET ". $erascore ." = ". $erascore . " + ?, ". $eraCorrect ." = ". $eraCorrect ."+ ? WHERE playerid = ? AND partyid = ?";
            $dao->query($query, array($packet->getNbrQuestions(), $packet->getNbrRightAnswers(), $packet->getId(), $packet->getPartyid()));
        }

        arsort($mapPlayernbrAnswer);

        $i = 5;
        foreach($mapPlayernbrAnswer as $id => $nbrAnswers){
            $this->playerPosition[$id]->setCurrentMovement($i);
            $this->playerPosition[$id]->addPosition($i);
            $i--;
        }

        $this->packets = [];
        $this->move();

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

            //On choppe les stats d'avant
            $query = "SELECT * FROM stat WHERE playerid = ? ORDER BY partyid DESC LIMIT 1";
            $reponse = $dao->query($query, array($students->getId()));

            $query = "INSERT INTO stat VALUES (?, false, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            if (!isset($reponse) || !isset($reponse[0]) || count($reponse[0]) != 11){
                //Insert de stats vides dans la bdd
                $dao->exec($query, array($students->getId(), 0, 0, 0, 0, 0, 0, 0, 0, $this->id));
            } else {
                //Insert de nouvelles
                //ld for last data
                $ld = $reponse[0];
                $dao->query($query, array($students->getId(), $ld[2], $ld[3], $ld[4], $ld[5], $ld[6], $ld[7], $ld[8], $ld[9], $this->id));
                $students->getId(). " -> " .$this->id;
            }
        }

        echo "Broadcasting";
        $this->partyRoom->broadcast($subscribers, json_encode($packet));
        $this->packets = [];

        $this->startMinigame();

    }


}

?>