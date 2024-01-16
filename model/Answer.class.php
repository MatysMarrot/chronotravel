<?php

require_once(__DIR__ . '/DAO.class.php');

class Answer{
    private int $id;
    private int $questionid;
    private string $content;
    private bool $correct;

    public function __construct($id,$questionid ,$content, $correct) {
        $this->id = $id;
        $this->questionid = $questionid;
        $this->content = $content;
        $this->correct = $correct;
    }

    public function getId() : int {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getQuestionid(): int
    {
        return $this->questionid;
    }

    public function getContent() : string {
        return $this->content;
    }

    public function isCorrect() : bool {
        return $this->correct;
    }

    

}


?>