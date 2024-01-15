<?php

class Question {
    private $text;
    private $answers;

    public function __construct($text, $answers) {
        $this->text = $text;
        $this->answers = $answers;
    }

    public function getText() {
        return $this->text;
    }

    public function getAnswers() {
        return $this->answers;
    }

    public function display() {
        echo "Question: {$this->text}\n";
        echo "Answers:\n";
        foreach ($this->answers as $answer) {
            echo "- $answer\n";
        }
    }
}

?>