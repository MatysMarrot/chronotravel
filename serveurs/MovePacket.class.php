<?php

require_once(__DIR__ . '/Packet.abstract.php');

class MovePacket extends Packet{
    private array $players;
    private $data;
    public function __construct(int $pid, array $players)
    {
        parent::__construct(-1,$pid);
        $this->players = $players;
    }

    public function handle()
    {
        // TODO: Implement handle() method.
    }

    public function stringify() : string
    {
        $this->data = [
            "partyid" => self::getPartyid(),
            "players" => [
            ]

        ];

        foreach ($this->players as $p){
            $this->data['players'][] = [
                "id" => $p->getId(),
                "movement" => $p->getCurrentMovement()
            ];

            //On reset le movement pour pas le lire deux fois
            $p->setCurrentMovement(0);
        }

         return json_encode($this->data);
    }
}


//{
//  "partyId": 1,
//  "players":[
//    {
//      "id": 0,
//      "movement": 4
//    },
//    {
//      "id": 1,
//      "movement": 2
//    },
//    {
//      "id": 2,
//      "movement": 1
//    },
//    {
//      "id": 3,
//      "movement": 0
//    }
//  ]
//}

?>