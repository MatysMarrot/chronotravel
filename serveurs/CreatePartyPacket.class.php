<?php

require_once(__DIR__ . '/Packet.abstract.php');
require_once(__DIR__ . '/enums/Action.enum.php');
require_once(__DIR__ . '/../model/Student.class.php');


class CreatePartyPacket extends Packet
{

    private Action $action;
    private int $id;
    private int $partyId;
    private int $owner;
    private array $players;

    public function __construct(int $id = -1, int $partyId, int $owner, array $players)
    {
        $this->action = Action::CREATE;
        $this->id = $id;
        $this->partyId = $partyId;
        $this->owner = $owner;
        $this->players = $players;
        parent::__construct($this->id, $this->partyId);


    }

    public function handle()
    {
        // TODO: Implement handle() method.
    }

    public function stringify()
    {
        $this->data = [
            "action" => $this->action->value,
            "id" => $this->id,
            "partyid" => self::getPartyid(),
            "owner" => $this->owner,
            "players" => [
            ]

        ];

        foreach ($this->players as $p) {
            $this->data['players'][] = [
                "id" => $p->getId(),
                "login" => Student::readStudent($p->getId())->getLogin()
            ];

        }
    }
}

?>