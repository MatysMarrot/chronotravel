<?php require __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../model/DAO.class.php';
require_once __DIR__.'/../model/Waitingroom.class.php';

/**
 * Serveur de salle d'attente:
 * Etabli une connection avec les joueurs en salle d'attente pour 
 * leurs permettre de lancer une partie et pour connaitre le nombre de joueurs présents
 * 
 * 
 * DOIT ETRE LANCE AVEC PHP DANS LA CONSOLE!
 */



use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

define('APP_PORT', 1312);

class ServerImpl implements MessageComponentInterface {
    protected $clients;
    private array $rooms;
    

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
        echo "New connection! ({$conn->resourceId}).\n";
    }

    public function onMessage(ConnectionInterface $conn, $msg) {
        //echo sprintf("New message from '%s': %s\n", $conn->resourceId, $msg);
        /*
        data:
            cid : int
            pid : int (party id hein)
            action : string
        */

        $decoded = json_decode($msg, true);
        
        if (!$decoded['action']){
            return;
        }
        
        if ($decoded['action'] == "JOIN"){
            //Si la room n'existe pas on la crée
            if ($this->rooms[$decoded['pid']] == null){
                $rooms[$decoded['pid']] = new WaitingRoom($decoded['pid'], $decoded['cid']);
            }
            
            //On ajouter le client a la room
            $this->rooms[$decoded['pid']]->addSubscriber($decoded['cid']);
        }

        if ($decoded['action'] == "LEAVE"){
            //On leave
            $this->rooms[$decoded['pid']]->removeSubscriber($decoded['cid']);
        } 
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
        echo "Connection {$conn->resourceId} is gone.\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error occured on connection {$conn->resourceId}: {$e->getMessage()}\n";
        $conn->close();
    }
}

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new ServerImpl()
        )
    ),
    APP_PORT
);
echo "Server created on port " . APP_PORT . "\n\n";
$server->run();