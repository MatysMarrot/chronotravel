<?php

class LeavePacket extends Packet{

    public function __construct(int $id, int $pid)
    {
        parent::__construct($id, $pid);
    }

    public function handle()
    {
        // TODO: Implement handle() method.
    }

    public function stringify() : string
    {
        $encode = [
            "action" => Action::LEAVE->value,
            "id" => $this->getId(),
            "partyId" => $this->getPartyid()
        ];
        return json_encode($encode);
    }
}
?>