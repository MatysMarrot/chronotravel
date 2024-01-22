<?php

abstract class Packet {

    private int $id;
    private int $partyid;

    public function __construct(int $id, int $pid)
    {
        $this->id = $id;
        $this->partyid = $pid;
    }

    public abstract function handle();

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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

