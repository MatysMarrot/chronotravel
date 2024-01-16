<?php

require_once(__DIR__ . '/DAO.class.php');

class Answer{
    private int $id;
    private string $content;
    private boolean $correct;

    public function __construct($id,$content, $themeid, $correct) {
        $this->id = $id;
        $this->content = $content;
        $this->themeid = $themeid;
    }

    public function getId() : int {
        return $this->id;
    }

    public function getContent() : string {
        return $this->content;
    }

    public function isCorrect() : boolean {
        return $correct;
    }

    

}


?>