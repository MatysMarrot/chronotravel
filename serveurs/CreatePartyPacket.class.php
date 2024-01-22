<?php

require_once(__DIR__ . '/Packet.abstract.php');
require_once(__DIR__ . '/enums/Action.enum.php');
require_once(__DIR__ . '/../model/Party.class.php');


class CreatePartyPacket extends Packet
{

    private Action $action;
    private int $partyId;
    private array $players;
    private $data;
    private int $owner;
    private Party $party;
    public function __construct(Party $party)
    {
        parent::__construct(-1,$party->getId());
        $this->party = $party;


    }

    public function stringify() : string{

        $this->data = [
            "action" => "create",
            "id" => -1,
            "partyId" => $this->pid,
            "owner" => -1,
            "players" => []
        ];

        foreach($this->players as $player){
            $this->data;
        }

        return $this->data;
    }


    public function handle()
    {
        // TODO: Implement handle() method.
    }

    public function stringify()
    {
        $infos = [
            "action" => "create",
            "id" => -1,
            "partyid" => $this->getPartyid(),
            "owner" => -1,
            "players" => [
            ]

        ];

        foreach ($this->party->getPlayers() as $p) {
            $infos['players'][] = [
                "id" => $p->getId(),
                "login" => Student::readStudent($p->getId())->getLogin()
            ];

        }

        return $infos;
    }
}

?>