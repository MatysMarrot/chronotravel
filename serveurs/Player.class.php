
<?php

    class Position{

        private int $id;
        private int $position; //Position sur le board
        private string $lastpacket;
        private int $currentMovement;

        public function __construct(int $id, $position = 0, $lastpacket = "")
        {
            $this->id = $id;
            $this->position = $position;
            $this->lastpacket = $lastpacket;
            $this->currentMovement = 0;
        }





        /**
         * @return int
         */
        public function getId(): int
        {
            return $this->id;
        }

        /**
         * @param int $currentMovement
         */
        public function setCurrentMovement(int $currentMovement): void
        {
            $this->currentMovement = $currentMovement;
        }

        /**
         * @return int
         */
        public function getCurrentMovement(): int
        {
            return $this->currentMovement;
        }

        /**
         * @return int
         */
        public function getPosition(): int
        {
            return $this->position;
        }

        /**
         * @param int $position
         */
        public function setPosition(int $position): void
        {
            $this->position = $position;
        }

        public function addPosition(int $movement):void
        {
            if (31 - $this->position <= $movement){
                $movement = 31 - $this->position;
            }

            $this->position += $movement;
            $this->currentMovement = $movement;
        }


    }