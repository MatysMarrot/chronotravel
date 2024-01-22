<?php

require_once(__DIR__ . '/Packet.abstract.php');
require_once(__DIR__ . '/enums/Action.enum.php');
require_once(__DIR__ . '/../model/Student.class.php');


class CreatePartyPacket extends Packet
{

    private Action $action;
    private int $id;
    private int $partyId;
    private array $players;
    private $data;
    private int $owner;
    private array $data;
    public function __construct($data)
    {
        parent::__construct($data['id'],$data['partyId']);


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