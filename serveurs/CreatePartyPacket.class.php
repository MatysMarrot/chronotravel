<?php

require_once(__DIR__ . '/Packet.abstract.php');
require_once(__DIR__ . '/enums/Action.enum.php');
require_once(__DIR__ . '/../model/Party.class.php');

class CreatePartyPacket extends Packet{

    private Action $action;
    private int $partyId;
    private int $owner;
    private Party $party;
    public function __construct(Party $party)
    {
        parent::__construct(-1,$party->getId());
        $this->party = $party;


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