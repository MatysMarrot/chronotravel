<?php require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../model/DAO.class.php';
require_once __DIR__ . '/../model/Waitingroom.class.php';
require_once __DIR__ . '/../model/Student.class.php';
require_once __DIR__ . '/../model/Party.class.php';

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

//define('APP_PORT', 1313);

class ServerImpl implements MessageComponentInterface
{
    static private $instance;
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

    private function broadCast(Party $party, string $data)
    {

        $players = $party->getPlayers();

        foreach ($players as $player) {
            $this->clientIdConn[$player->getId()]->send($data);
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
        $dao = DAO::get();
        $party = Party::getPartyFromId($decoded['pid']);
        $player = Student::readStudent($decoded['cid']);

        if (!$decoded['action']) {
            return;
        }

        if ($decoded['action'] == "JOIN") {
            echo sprintf("%d has joined party %d\n", $decoded['cid'], $decoded['pid']);
            $this->clientIdConn[$decoded['cid']] = $conn;

            $data = [$decoded['pid']];
            $query = "SELECT count(*) FROM partystudent WHERE partyid = ? ";
            $table = $dao->query($query, $data);


            if ($table[0][0] == 4) {
                //TODO : Envoyer un json_encode
                $conn->send("PARTY IS FULL");
                $conn->close();
                return false;
            }

            // Insertion de l'élève dans la party

            $isOwnerPresent = false;

            foreach ($party->getPlayers() as $player) {
                if ($player->getId() == $decoded['cid']) {
                    $isOwnerPresent = true;
                    break;  // On a trouvé le propriétaire, pas besoin de continuer la boucle
                }
            }

            if ($party->getOwnerId() == $decoded['cid']) {
                // Si c'est le propriétaire et qu'il n'est pas présent, l'insérer
                if (!$isOwnerPresent) {
                    $party->insertPlayer($decoded['cid']);
                }
            } else {
                // Si ce n'est pas le propriétaire, insérer le joueur
                $party->insertPlayer($decoded['cid']);
            }

            //On trouve les autres joueurs de la room
            $players = $party->getPlayers();

            $logins = [];
            foreach ($players as $player) {
                $student = Student::readStudent($player->getId());
                $logins[] = $student->getLogin();
            }

            $data = [
                "action" => "playerJoin",
                "names" => $logins,
            ];

            $this->broadCast($party, json_encode($data));
        } elseif ($decoded['action'] == "START") {

            if ($party->getOwnerId() != $decoded['cid']) {
                return;
            }

            $data = [
                "action" => "start",
            ];

            $this->broadCast($party, json_encode($data));

            foreach ($party->getPlayers() as $player) {
                $this->clientIdConn[$player->getId()]->close();
                $this->clients->detach($this->clientIdConn[$player->getId()]);
                unset($this->clientIdConn[$player->getId()]);
            }
            // CHANGEMENT DU STATUS DE LA PARTY (FAIRE ATTENTION QUE C'EST BIEN DEFINI EN BD)
            //$data = [$decoded['pid']];
            //$query = "UPDATE party SET partystate = 2 WHERE id = ? ";
            //$dao->exec($query,$data);

        } elseif ($decoded['action'] == "LEAVE") {
            echo sprintf("%d is leaving party %d\n", $decoded['cid'], $decoded['pid']);

            $this->close($player, $party);
        }


    }

    public function onClose(ConnectionInterface $conn)
    {


        $key = array_search($conn, $this->clientIdConn);
        echo sprintf("On close, key %s = ", $key);

        if ($key !== false) {
            // Il exsite un cid lié à cette connexion
            $dao = DAO::get();
            $data = [$key];
            $query = "SELECT id FROM party p, partystudent s WHERE studentid = ? AND id = partyid AND partystate = 1";
            $table = $dao->query($query, $data);
            $party = Party::getPartyFromId($table[0][0]);
            $student = Student::readStudent($key);

            $this->close($student, $party);

        }


        $this->clients->detach($conn);
        echo "Connection {$conn->resourceId} is gone.\n";
    }

    public function close($player, $party)
    {


        if ($party->getOwnerId() == $player->getId()) {
            // On envoie un packet à tout le monde pour delete la party
            $party->removePlayer($player->getId());
            $data = [
                "action" => "ownerLeft",
            ];
            echo sprintf("Packet envoyé %s \n", $data['action']);

        } else {
            $party->removePlayer($player->getId());
            $data = [
                "action" => "playerLeave",
                "name" => $player->getLogin(),
            ];
            echo sprintf("Packet envoyé %s par %s\n", $data['name'], $data['action']);
        }
        $this->broadCast($party, json_encode($data));
        if (count($party->getPlayers()) == 0) {
            $party->deleteParty();
        }

        $this->clientIdConn[$player->getId()]->close();
        unset($this->clientIdConn[$player->getId()]);
    }


    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error occured on connection {$conn->resourceId}: {$e->getMessage()}\n";
        $conn->close();
    }

    public static function get()
    {
        if (self::$instance == null) {
            self::$instance = IoServer::factory(
                new HttpServer(
                    new WsServer(
                        new ServerImpl()
                    )
                ),
                1313
            );
            echo "Server created on port " . 1313 . "\n\n";
            //self::$instance->run();
        }

        return self::$instance;
    }
}

?>