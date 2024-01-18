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

define('APP_PORT', 1313);

class PartyImpl implements MessageComponentInterface{

    protected $clients;
    private array $parties = array();
    private array $clientidLogin;
    private array $clientIdConn;


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

    function onMessage(ConnectionInterface $from, $msg)
    {
        // TODO: Implement onMessage() method.
    }
}


?>