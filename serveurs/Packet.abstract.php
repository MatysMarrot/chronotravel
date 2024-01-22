<?php

abstract class Packet {

    private int $cid;
    private int $partyid;

    public function __construct(int $cid, int $pid)
    {
        $this->cid = $cid;
        $this->partyid = $pid;
    }

    public abstract function handle();

    /**
     * @return int
     */
    public function getCid(): int
    {
        return $this->cid;
    }

    /**
     * @return int
     */
    public function getPartyid(): int
    {
        return $this->partyid;
    }
}

?>

