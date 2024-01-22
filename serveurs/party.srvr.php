<?php
require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../model/DAO.class.php';
require_once __DIR__ . '/../model/Party.class.php';
require_once __DIR__ . '/../model/Student.class.php';
require_once(__DIR__ . '/enums/Action.enum.php');
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
        $this->clients->detach($conn);
        echo "Une connexion a été retirée. ID: {$conn->resourceId}\n";
    }

    function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "Une erreur est survenue sur une connexion. ID:  {$conn->resourceId}: {$e->getMessage()}\n";
        $conn->close();
    }

    function onMessage(ConnectionInterface $conn, $msg)
    {
        echo sprintf("New message from '%s': %s\n", $conn->resourceId, $msg);

        $decoded = json_decode($msg, true);

        if (!$decoded['action']) {
            return;
        }
        if ($decoded['action'] == Action::JOIN->value) {
            echo sprintf("Received '%s' from %s\n",$decoded['action'], $conn->resourceId);

            $packet = new JoinPacket($decoded['id'],$decoded['partyId']);
            $this->clientIdConn[$decoded['id']] = $conn;

            if(!isset($this->parties[$decoded['partyId']])){
                $this->parties[$decoded['partyId']] = Party::getPartyFromId($decoded['partyId']);
            }
            $party = $this->parties[$decoded['partyId']];
            $party->addPackets($packet);

            //Si on a suffisament de joueurs
            if (count($party->getPackets()) == count($party->getPlayers())){
                $party->startMinigame();
            }


        }
    }

    function startMinigame($pid){

    }

    public static function get(){
        if (self::$instance == null){
            self::$instance = new PartyImpl();
            echo "Server created on port " . APP_PORT . "\n\n";
            //self::$instance->run();
        }

        return self::$instance;
    }
    public function broadcast(array $subscribers, string $data)
    {

        foreach ($subscribers as $subscriber){
            $this->clientIdConn[$subscriber]->send($data);
        }

        return true;
    }
}


?>