<?php
require_once(__DIR__ . '/Packet.abstract.php');
require_once(__DIR__ . '/enums/Action.enum.php');

class JoinPacket extends Packet{


    public function __construct(int $cid, int $pid)
    {
        parent::__construct($cid, $pid);
    }

    public function handle()
    {
        // TODO: Implement handle() method.

    }

    public function stringify() : string
    {
        $this->data = [
            "action" => Action::JOIN->value,
            "id" => $this->getCid(),
            "partyId" => self::getPartyid()
        ];
        return json_encode($this->data);
    }


}


?>