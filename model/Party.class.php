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

    private array $playerPosition = []; // La position des joueurs sous forme de liste
    private int $ownerid; //L'identifiant de l'hôte de la partie (le créateur)
    private array $players; // liste des élèves
    private string $code; // code de la game
    private int $id; // laisser la BD gérer
    private $era; // thème du plateau courant
    private int $partyState = 0; //Etat de la partie
    private array $questions; //Liste de questions
    private PartyImpl $partyRoom; //Serveur de jeu
    private $packets; //Les packets qui servent à communiquer entre le client et le serveur

    //CONSTRUCTEUR
    public function __construct(int $ownerid)
    {
        $this->players = array();
        $this->ownerid = $ownerid;
        $this->questions = array();
        $this->partyRoom = PartyImpl::get();
    }

    //GETTERS
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

    /**
     * @return void
     * Insère dans la base de donnée une partie par rapport à l'objet
     */
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


    /**
     * @param int $cid l'ID du client (joueur)
     * @return void
     * Insérer un joueur dans la partie
     */
    public function addPlayer(int $cid)
    {
        if (count($this->players) >= 4) {
            //throw new Exception ("Groupe plein");
        } else {
            $this->players[$cid] = new Player($cid, $this->partyid);

        }
    }

    //DEPRECATED
    /**
     * @param int $size Le nombre de questions
     * @param Era $era L'époque des questions
     * @return void
     * Obtenir x questions suivant une époque
     */
    public function fetchQuestions(int $size, Era $era)
    {
        for ($i = 0; $i < 10; $i++) {
            $this->questions[] = Question::getRandomQuestionByEra($this->getEra());
        }

    }

    //DEPECATED
    /**
     * @return void
     * Envoyer les questions aux clients
     */
    public function broadcastQuestions()
    {
        $data = json_encode($this->getQuestions());
        $this->partyRoom->broadcast($this->players, $data);


    }

    /**
     * @return void
     * Déplace les élèves de la party et gère la victoire si des élèves gagnent
     */
    public function move()
    {
        $packets = array();
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
            // S'il existe des gagnants on envoie un packet de victoire aux joueurs
            $packet = new VictoryPacket($this->id,$winners);
            $encode = $packet->stringify();
            var_dump($encode);
            $this->partyRoom->broadcast($subscribers,$encode);
        }
        else{
            // S'il n'y a pas de gagnants on relance un mini jeux
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

    /**
     * @param $cid
     * @return void
     * Insère un élève dans la base de donnée et dans l'objet à partir de l'id de l'élève
     */
    public function insertPlayer($cid)
    {
        $dao = DAO::get();
        $data = [$cid, $this->id];
        $query = "INSERT INTO partystudent (studentid,partyid) VALUES(?,?)";
        $dao->exec($query, $data);
        $this->players[] = Student::readStudent($cid);
        $this->playerPosition[$cid] = new Position($cid);
    }

    /**
     * @param $cid
     * @return void
     * Supprime un élève appartenant à la party de la base de donnée et dans l'objet à partir de l'id d'un élève
     */
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


    /**
     * @return void
     * Supprime la party de la base de donnée
     */
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



    /**
     * @param $id
     * @return Party|null
     * Récupère un objet Party à partir d'un id, renvoie null si la party n'est pas trouvé
     */
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

    /**
     * @return void
     * Démarre un minijeu
     */
    public function startMinigame()
    {
        $this->packets = [];
        $packet = new QuestionPacket($this->id,$this->getPlayers(),$this->playerPosition);
        $subscribers = [];
        foreach ($this->getPlayers() as $students) {
            $subscribers[] = $students->getId();
        }
        $this->partyRoom->broadcast($subscribers,$packet->stringifyPlayers()[0]);


    }

    /**
     * @return void
     * Gère la récéption des packets answers
     */
    public function manageAnwser(){
        $mapPlayernbrAnswer = [];
        $dao = DAO::get();

        foreach($this->packets as $packet){
            if (!$packet instanceof AnswerPacket){
                echo "Mauvais packet reçu\n";
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

    /**
     * @return void
     * Initialise une partie
     */
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
