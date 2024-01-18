<?php
require_once(__DIR__ . '/Packet.abstract.php');

class JoinPacket extends Packet{


    public function __construct(int $cid, int $pid)
    {
        parent::__construct($cid, $pid);
    }

    public function handle()
    {
        // TODO: Implement handle() method.

    }
}


?>

