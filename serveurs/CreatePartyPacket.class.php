<?php

require_once(__DIR__ . '/Packet.abstract.php');
require_once(__DIR__ . '/enums/Action.enum.php');

class CreatePartyPacket extends Packet{

    private Action $action;
    private int $id;
    private int $partyId;
    private array $players;
    private $data;
    private int $owner;
    public function __construct(array $players,$pid)
    {
        parent::__construct(-1, $pid);
        $this->players = $players;

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
}
?>