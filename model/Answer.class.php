<?php

require_once(__DIR__ . '/DAO.class.php');

class Answer{
    private int $id; //L'Identifiant de la réponse en BD
    private int $questionid; //L'identifiant de la question relié à la réponse en BD
    private string $content; //Son contenu
    private bool $correct; //Est-elle correcte

    //CONSTRUCTEUR
    public function __construct($id,$questionid ,$content, $correct) {
        $this->id = $id;
        $this->questionid = $questionid;
        $this->content = $content;
        $this->correct = $correct;
    }

    //GETTERS
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