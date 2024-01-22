<?php

class Qcm{

    const SIZE = 5;

    private array $students; // liste des élèves
    private array $questions; //Liste des questions posées
    private Era $era; //L'ère



    public function __construct(array $students, Era $era){

        for ($i=0; $i < self::SIZE; $i++) {
            $this->questions[] = Question::getRandomQuestion();
        }

    }

    



}

?>