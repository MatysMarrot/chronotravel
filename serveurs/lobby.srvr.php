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


    /*
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
    */

    private function broadCast(Party $party,string $data){

        $players = $party->getPlayers();

        foreach($players as $player){
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

        if (!$decoded['action']) {
            return;
        }

        if ($decoded['action'] == "JOIN") {
            echo sprintf("%d has joined party %d\n", $decoded['cid'],$decoded['pid']);
            $this->clientIdConn[$decoded['cid']] = $conn;

            /*
            $data =  [$decoded['cid'],$decoded['pid']];
            $query = "SELECT studentid FROM partystudent WHERE studentid = ? AND partyid = ?";
            $table = $dao->query($query,$data);

            if(count($table) == 1){
                // Il est déjà dans le groupe, on lui redonne tout les logins
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

                $this->clientIdConn[$decoded['cid']]->send(json_encode($data));

                return;

            }
            */

            $data =  [$decoded['pid']];
            $query = "SELECT count(*) FROM partystudent WHERE partyid = ? ";
            $table = $dao->query($query,$data);



            if ($table[0][0] == 4){
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

            /*
            if($party->getOwnerId() != $decoded['cid'] ){
                $party->insertPlayer($decoded['cid']);
            }
            */

            //$party->insertPlayer($decoded['cid']);

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
        }
        elseif($decoded['action'] == "START"){

            if($party->getOwnerId() != $decoded['cid']){
                return;
            }

            $data = [
                "action" => "start",
            ];

            $this->broadCast($party, json_encode($data));

            foreach ($party->getPlayers() as $player){
                $this->clientIdConn[$player->getId()]->close();
                $this->clients->detach($this->clientIdConn[$player->getId()]);
                unset($this->clientIdConn[$player->getId()]);

                // CHANGEMENT DU STATUS DE LA PARTY (FAIRE ATTENTION QUE C'EST BIEN DEFINI EN BD)
                $data = [$decoded['pid']];
                $query = "UPDATE party SET partystate = 2 WHERE id = ? ";
                $dao->exec($query,$data);


            }

        }
        elseif ($decoded['action'] == "LEAVE") {
            //On leave
            //TODO
            echo sprintf("%d is leaving party %d\n", $decoded['cid'],$decoded['pid']);
            $party->removePlayer($decoded['cid']);
            /*
            foreach ($party->getPlayers() as $player){
                $logins[] = $player->getLogin();
            }
            */
            $data = [
                "action" => "playerLeave",
                "name" => $decoded['login'],
            ];

            echo sprintf("Packet envoyé %s par %s\n",$data['name'],$data['action']);

            $this->broadCast($party,json_encode($data));

            $this->clientIdConn[$decoded['cid']]->close();
            $this->clients->detach($this->clientIdConn[$decoded['cid']]);
            unset($this->clientIdConn[$decoded['cid']]);


        }
    }

    public function onClose(ConnectionInterface $conn)
    {


        $key = array_search($conn, $this->clientIdConn);
        echo sprintf("On close, key %s = ",$key);

        if($key !== false){
            // Il exsite un cid lié à cette connexion
            $dao = DAO::get();
            $data = [$key];
            $query = "SELECT id FROM party p, partystudent s WHERE studentid = ? AND id = partyid AND partystate = 1";
            $table = $dao->query($query,$data);
            $party = Party::getPartyFromId($table[0][0]);
            $party->removePlayer($key);
            $student = Student::readStudent($key);

            $data = [
                "action" => "playerLeave",
                "name" => $student->getLogin(),
            ];

            echo sprintf("Packet envoyé %s par %s\n",$data['name'],$data['action']);

            $this->broadCast($party,json_encode($data));
            $this->clientIdConn[$key]->close();
            unset($this->clientIdConn[$key]);
        }

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

?>