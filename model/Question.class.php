<?php


require_once(__DIR__ . '/DAO.class.php');

class Question {
    private $id;
    private $content;
    private $themeid;

    public function __construct($id,$content, $themeid) {
        $this->id = $id;
        $this->content = $content;
        $this->themeid = $themeid;
    }

    public function getId() : int {
        return $this->id;
    }

    public function getContent() : string{
        return $this->content;
    }

    private function getThemeId() : int{
        return $this->themeId;
    }
    //TODO
    public function getAnswers() : array {
        $dao = Dao::get();

        

    }

    public function display() : void{
        echo "Question: $this->getContent()\n
        ";
    
    }

     // Méthode pour récupérer une question aléatoire depuis la base de données
     public static function getRandomQuestion() : Question
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