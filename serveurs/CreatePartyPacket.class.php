<?php

require_once(__DIR__ . '/Packet.abstract.php');
require_once(__DIR__ . '/enums/Action.enum.php');

class CreatePartyPacket extends Packet{

    private Action $action;
    private int $id;
    private int $partyId;
    private int $owner;
    public function __construct($data)
    {
        parent::__construct($data['cid'],$data['partyId']);


    }
    public function handle()
    {
        // TODO: Implement handle() method.
    }
}
?>