<?php

require_once(__DIR__ . '/Packet.abstract.php');
require_once(__DIR__ . '/enums/Action.enum.php');



class VictoryPacket extends Packet {

    private array $players;
    private $data;

    public function __construct(int $partyId, array $players)
    {
        parent::__construct(-1,$partyId);
        $this->players = $players;
    }

    public function handle()
    {
        // TODO: Implement handle() method.
    }

    public function stringify() : string
    {
        $this->data = [
            "action" => Action::VICTORY->value,
            "partyid" => self::getPartyid(),
            "winners" => [
            ]

        ];

        foreach ($this->players as $p){
            if ($p->getPosition() >= 31){
                $this->data['players'][] = [
                    "id" => $p->getId()
                ];
            }
        }

        return json_encode($this->data);
    }
}
?>