<?php
require_once(__DIR__ . '/Packet.abstract.php');
require_once(__DIR__ . '/enums/Action.enum.php');

class JoinPacket extends Packet{


    public function __construct($data)
    {
        parent::__construct($data['cid'], $data['partyId']);
    }

    public function handle()
    {
        // TODO: Implement handle() method.

    }

    public function stringify() : string
    {
        $encode = [
            "action" => Action::JOIN->value,
            "id" => $this->getCid(),
            "partyId" => $this->getPartyid()
        ];
        return json_encode($encode);
    }


}


?>