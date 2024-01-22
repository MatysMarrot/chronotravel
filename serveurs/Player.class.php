
<?php

    class Player{

        private Student $student;
        private int $pid; //Party ID
        private int $position; //Position sur le board
        private string $lastpacket;
        private int $currentMovement;

        public function __construct(Student $student,int $pid, $position = 0, $lastpacket = "")
        {
            $this->student = $student;
            $this->pid = $pid;
            $this->position = $position;
            $this->lastpacket = $lastpacket;
            $this->currentMovement = 0;
        }

        /**
         * @return string
         */
        public function getLogin(): string
        {
            return $this->student->getLogin();
        }

        /**
         * @return Student
         */
        public function getStudent(): Student
        {
            return $this->student;
        }

        /**
         * @return int
         */
        public function getId(): int
        {
            return $this->student->getId();
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