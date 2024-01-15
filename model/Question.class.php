<?php


require_once(__DIR__ . '/DAO.class.php');

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

     // Méthode pour récupérer une question aléatoire depuis la base de données
     public static function getRandomQuestion()
     {
    
        $dao = DAO::get();

        //Avoid getting the size of the table by ordering by random and getting only one.
        $query = "SELECT id, content, themeId FROM Questions ORDER BY RANDOM() LIMIT 1";
 
    
        $result = $dao->query($query);
        var_dump($result);
 
        if ($result) {
            $rowData = $result[0];
            return new Question($rowData['id'], $rowData['content'], $rowData['themeId']);
        }
 
        // Aucune question trouvée
        return null;
     }
}

?>