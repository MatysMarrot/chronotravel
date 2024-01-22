<?php
class WaitingRoom{
    private int $id;
    private array $subscribers;
    private int $ownerId;
    private int $size;
    
    public function __construct(int $partyid, int $owner) {
        $this->id = $partyid;
        $this->subscribers = array();
        $this->ownerId = $owner;
        $this->size = 0;
    }

    public function getId() : int {
        return $this->id;
    }

    public function addSubscriber(...$clients) : void{
        foreach ($clients as $c){
            //Si la clé est déja présente on ne l'ajoute pas
            if (array_search($c, $this->subscribers)){
                continue;
            }
            $this->subscribers[] = $c;
            $this->size++;
        }
    }

    public function removeSubscriber(int $subscriber) : bool {
        $pos = array_search($subscriber, $this->subscribers);
        if (!$pos){
            return false;
        }

        unset($this->subscribers[$pos]);
        $this->size--;

        if ($subscriber == $this->getOwner()){
            if ($this->size >= 0)
                $this->setOwner($this->subscribers[0]);
        }
        
        return true;
    }

    public function setOwner(int $subscriber) : void{
        if (!array_search($subscriber, $this->subscribers)){
            throw new Exception("$subscriber is not part of the subsribers for room $id");
        }
        $this->ownerId = $subscriber;
    }

    public function getOwner() : int{
        return $this->ownerId;
    }

    public function getSubscribers() : array {
        return $this->subscribers;
    }

    public function size() : int {
        return $this->size;
    }


}


?>