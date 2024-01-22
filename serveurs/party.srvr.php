<?php
require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../model/DAO.class.php';
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
        //echo sprintf("New message from '%s': %s\n", $conn->resourceId, $msg);
        /*
        data:
            cid : int
            pid : int (party id hein)
            action : string
        */

        $decoded = json_decode($msg, true);

        if (!$decoded['action']) {
            return;
        }

            if ($decoded['action'] == "JOIN") {
                $this->clientIdConn[$decoded['cid']] = $conn;
                $this->clientidLogin[$decoded['cid']] = $decoded['login'];

                //Si la partie n'existe pas on la crée
                if (!isset($this->rooms[$decoded['pid']])) {
                    $this->rooms[$decoded['pid']] = new Party($decoded['pid'], $decoded['cid']);
                    echo sprintf("Created new room with partyid: '%d' and owner: '%d'\n", $decoded['pid'], $decoded['cid']);
                }

        }
    }

    public static function get(){
        if (self::$instance == null){
            self::$instance = IoServer::factory(
                new HttpServer(
                    new WsServer(
                        new PartyImpl()
                    )
                ),
                APP_PORT
            );
            //TODO: Enelebver
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