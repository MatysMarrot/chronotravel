<?php
require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../model/DAO.class.php';
require_once __DIR__ . '/../model/Party.class.php';
require_once __DIR__ . '/../model/Student.class.php';
require_once(__DIR__ . '/enums/Action.enum.php');
require_once(__DIR__ . '/LeavePacket.class.php');
//require_once __DIR__ . '/../model/Waitingroom.class.php'; May require another room

/**
 * Serveur de jeu:
 * Etablit une connexion avec les joueurs en jeu pour
 * leur permettre de jouer aux mini-jeux en même temps et se communiquer des
 * informations
 *
 *
 * DOIT ETRE LANCE AVEC PHP DANS LA CONSOLE!
 */

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

define('APP_PORT', 1414);

class PartyImpl implements MessageComponentInterface{

    protected $clients;
    private array $parties = array();
    private array $clientidLogin;
    private array $clientIdConn;
    private static $instance = null;


    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
        $this->parties = array();
        $this->clientidLogin = array();
        $this->clientIdConn = array();
    }

    function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        echo "Une nouvelle connexion a été ajoutée. ID: ({$conn->resourceId})\n";
    }

    function onClose(ConnectionInterface $conn)
    {

        $key = array_search($conn, $this->clientIdConn);
        echo sprintf("On close, key %s = ", $key);

        if ($key !== false) {
            // Il exsite un cid lié à cette connexion
            $dao = DAO::get();
            $data = [$key];
            $query = "SELECT id FROM party p, partystudent s WHERE studentid = ? AND id = partyid AND partystate = 2";
            $table = $dao->query($query, $data);
            $party = $this->parties[$table[0][0]];
            $party->removePlayer($key);
            $packet = new LeavePacket($key,$party->getId());

            $subscribers = [];
            foreach ($party->getPlayers() as $students) {
                $subscribers[] = $students->getId();
            }
            var_dump($packet);
            $this->broadcast($subscribers,$packet->stringify());

            $this->clientIdConn[$key]->close();
            unset($this->clientIdConn[$key]);

        }


        $this->clients->detach($conn);
        echo "Connection {$conn->resourceId} is gone.\n";

        $this->clients->detach($conn);
        echo "Une connexion a été retirée. ID: {$conn->resourceId}\n";
    }

    function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "Une erreur est survenue sur une connexion. ID:  {$conn->resourceId}: {$e->getMessage()}\n";
        $conn->close();
    }

    /**
     * @param ConnectionInterface $conn
     * @param $msg
     * @return void
     * Gère l'arrivée de packet venant des clients javascript
     */
    function onMessage(ConnectionInterface $conn, $msg)
    {
        echo sprintf("New message from '%s': %s\n", $conn->resourceId, $msg);

        $decoded = json_decode($msg, true);

        if (!$decoded['action']) {
            return;
        }
        // Gestion de l'arrivée des joueurs
        if ($decoded['action'] == Action::JOIN->value) {
            echo sprintf("Received '%s' from %s\n",$decoded['action'], $conn->resourceId);

            $packet = new JoinPacket($decoded);
            $this->clientIdConn[$decoded['id']] = $conn;

            // Si la partie n'est pas déjà stocké on la stocke
            if(!isset($this->parties[$decoded['partyId']])){
                $this->parties[$decoded['partyId']] = Party::getPartyFromId($decoded['partyId']);
            }
            $party = $this->parties[$decoded['partyId']];
            $party->addPackets($packet);

            var_dump($party->getPartyState());
            //Si on a suffisament de joueurs et que la partie n'est toujours pas lancé on initialise la partie
            if ($party->getPartyState() == 1 && count($party->getPackets()) == count($party->getPlayers())){
                var_dump("INIT GAME");
                $party->initGame();
            }
        }

        // Gestion de la réception des questions d'un joueur
        else if($decoded['action'] == Action::ANSWER->value){
            echo sprintf("Received '%s' from %s\n",$decoded['action'], $conn->resourceId);
            $packet = new AnswerPacket($decoded);

            //On trouve la partie
            $party = $this->parties[$decoded['partyId']];

            //Si elle n'existe pas
            if ($party == null){
                return;
            }

            //On ajoute le packet a liste des packets recu recemment
            $party->addPackets($packet);

            //Con
            if(count($party->getPackets()) == count($party->getPlayers())){
                $party->manageAnwser();
            }
        }
    }

    /**
     * @return PartyImpl|null
     */
    public static function get(){
        if (self::$instance == null){
            self::$instance = new PartyImpl();
        }

        return self::$instance;
    }

    /**
     * @param array $subscribers
     * @param string $data
     * @return true
     * Envoie le packet (data) à tout les clients javascript des joueurs (subscribers)
     */
    public function broadcast(array $subscribers, string $data)
    {
        foreach ($subscribers as $subscriber){
            $this->clientIdConn[$subscriber]->send($data);
        }

        return true;
    }
}


?>