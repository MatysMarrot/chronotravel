<?php

require_once(__DIR__ . '/DAO.class.php');

class Answer{
    private int $id;
    private int $questionid;
    private string $content;
    private boolean $correct;

    public function __construct($id,$questionid ,$content, $themeid, $correct) {
        $this->id = $id;
        $this->questionid;
        $this->content = $content;
        $this->themeid = $themeid;
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

    /**
     * @return mixed
     */
    public function getThemeid()
    {
        return $this->themeid;
    }

    public function getContent() : string {
        return $this->content;
    }

    public function isCorrect() : boolean {
        return $this->correct;
    }

    

}


?>