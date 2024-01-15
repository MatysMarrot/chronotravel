<?php


require_once(__DIR__ . '/DAO.class.php');

class Question {
    private $id;
    private $content;
    private $themeid;

    public function __construct($id,$content, $themeid) {
        $this->text = $text;
        $this->answers = $answers;
    }

    public function getId() {
        return $this->id;
    }

    public function getContent() {
        return $this->content;
    }

    private function getThemeId() {
        return $this->themeId;
    }
    public function getAnswers() {
        return $this->answers;
    }

    public function display() {
        echo "Question: {$this->getContent()}\n";
    
    }

     // Méthode pour récupérer une question aléatoire depuis la base de données
     public static function getRandomQuestion()
     {
    
        $dao = DAO::get();

        //Avoid getting the size of the table by ordering by random and getting only one.
        $query = "SELECT id, content, themeid FROM Questions ORDER BY RANDOM() LIMIT 1";
 
    
        $result = $dao->query($query);
        var_dump($result);
 
        if ($result) {
            $rowData = $result[0];
            return new Question($rowData['id'], $rowData['content'], $rowData['themeid']);
        }
 
        // Aucune question trouvée
        return null;
     }
}

?>