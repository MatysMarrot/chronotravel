<?php require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../model/DAO.class.php';
require_once __DIR__ . '/../model/Waitingroom.class.php';

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

class ServerImpl implements MessageComponentInterface
{
    protected $clients;
    private array $rooms;

    private array $clientidLogin;
    private array $clientIdConn;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
        $this->rooms = array();
        $this->clientidLogin = array();
        $this->clientIdConn = array();
    }


    private function broadCast(WaitingRoom $room, string $data)
    {
        if (!$room) {
            return false;
        }

        foreach ($room->getSubscribers() as $sub) {
            $this->clientIdConn[$sub]->send($data);
        }

        return true;
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        echo "New connection! ({$conn->resourceId}).\n";
    }

    public function onMessage(ConnectionInterface $conn, $msg)
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

            //Si la room n'existe pas on la crée
            if (!isset($this->rooms[$decoded['pid']])) {
                $this->rooms[$decoded['pid']] = new WaitingRoom($decoded['pid'], $decoded['cid']);
                echo sprintf("Created new room with partyid: '%d' and owner: '%d'\n", $decoded['pid'], $decoded['cid']);
            }


            //On ajoute le client a la room
            if ($this->rooms[$decoded['pid']]->size() == 4){
                //TODO : Envoyer un json_encode
                $conn->send("PARTY IS FULL");
                $conn->close();
                return false;
            }


            $room = $this->rooms[$decoded['pid']];
            $room->addSubscriber($decoded['cid']);

            //On trouve les autres joueurs de la room
            $listePseudo = array();
            foreach ($room->getSubscribers() as $sub) {
                $listePseudo[] = $this->clientidLogin[$sub];
            }

            $data = [
                "action" => "playerJoin",
                "names" => $listePseudo,
            ];

            $this->broadCast($room, json_encode($data));
        }
        else if ($decoded['action'] == "LEAVE") {
            //On leave
            //TODO
            $this->rooms[$decoded['pid']]->removeSubscriber($decoded['cid']);
        }

        else if ($decoded['action'] == "START") {
            //On leave
            $room = $this->rooms[$decoded['pid']];
            if ($room->getOwner() != $decoded['cid']){
                return;
            }

            $data = [
                "action" => "start",
            ];

            $this->broadCast($room, json_encode($data));
            echo sprintf("Room %d was started by %d\n", $decoded['pid'], $decoded['cid']);
            foreach ($room->getSubscribers() as $sub){
                try {
                    var_dump($this->clientIdConn.key());
                    $this->clientIdConn[$sub]->close();
                    $this->clients->detach($this->clientIdConn[$sub]);
                    unset($this->clientidLogin[$sub]);
                    unset($this->clientIdConn[$sub]);
                    unset($this->rooms[$decoded['pid']]);
                } catch (Exception){};
            }
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
        echo "Connection {$conn->resourceId} is gone.\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
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