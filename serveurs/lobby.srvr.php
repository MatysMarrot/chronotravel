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

    /**
     * @param Party $party
     * @param string $data
     * @return true
     * Envoie le packet (data) à tout les clients javascript des joueurs appartenant à la party
     */
    private function broadCast(Party $party, string $data)
    {

        $players = $party->getPlayers();

        foreach ($players as $player) {
            try {
                $this->clientIdConn[$player->getId()]->send($data);
            } catch (Exception){echo sprintf("Something went wrong while sending packet to %d", $player->getId());};
        }
        return true;
    }

    /**
     * @param ConnectionInterface $conn
     * @return void
     * Fonction d'ouverture d'une connexion
     */
    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        echo "New connection! ({$conn->resourceId}).\n";
    }

    /**
     * @param ConnectionInterface $conn
     * @param $msg
     * @return false|void
     * Gère l'arrivée de packet venant des clients javascript
     */
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

        // Gestion d'un joueur qui rejoins la salle d'attente
        if ($decoded['action'] == "JOIN") {
            echo sprintf("%d has joined party %d\n", $decoded['cid'], $decoded['pid']);
            $this->clientIdConn[$decoded['cid']] = $conn;

            $data = [$decoded['pid']];
            $query = "SELECT count(*) FROM partystudent WHERE partyid = ? ";
            $table = $dao->query($query, $data);


            if ($table[0][0] == 4) {
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

            // Gestion de la création de la partie
        } elseif ($decoded['action'] == "START") {

            if ($party->getOwnerId() != $decoded['cid']) {
                return;
            }

            // On regarde si le joueur est seul, si il est seul on ne lance pas la partie
            if(count($party->getPlayers()) == 1){
                var_dump($party->getId());
                var_dump($party->getPlayers());
                $data = [
                    "action" => "solo",
                ];

                $this->broadCast($party,json_encode($data));
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


            // Gestion des joueurs qui quittent la partie
        } elseif ($decoded['action'] == "LEAVE") {
            echo sprintf("%d is leaving party %d\n", $decoded['cid'], $decoded['pid']);

            $this->close($player, $party);
        }


    }

    /**
     * @param ConnectionInterface $conn
     * @return void
     * Gère les joueurs qui quittent la page et la partie
     */
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

    /**
     * @param $player
     * @param $party
     * @return void
     * Supprime de la party le joueur qui quitte ou supprime la partie
     * lorsque plus personne n'est dans la salle d'attente ou que le créateur
     * du groupe quitte
     */
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

    /**
     * @return IoServer
     */
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
        }

        return self::$instance;
    }
}

?>