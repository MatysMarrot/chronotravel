<?php


require_once(__DIR__ . '/DAO.class.php');
require_once(__DIR__ . '/Answer.class.php');


class Question
{
    private int $id;
    private string $content;
    private int $themeid;

    private array $answers;


    private function __construct($id, $content, $themeid)
    {
        $this->id = $id;
        $this->content = $content;
        $this->themeid = $themeid;
        $this->answers = $this->readAnswers();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getContent(): string
    {
        return $this->content;
    }


    private function readAnswers(): ?array
    {
        $dao = DAO::get();
        $query = "SELECT * FROM Answers WHERE questionid = ?";

        $data = [];
        $data[] = $this->getId();

        $result = $dao->query($query, $data);

        if ($result) {

            $answers = array();
            //Create Answers objects and put it in array
            for ($i = 0; $i < count($result); $i++) {
                $rowData = $result[$i];
                $answers[] = new Answer($rowData['id'], $rowData['questionid'], $rowData['content'], $rowData['correct']);

            }
            //And then return
            return $answers;
        }
        //Result is null, there is no answer, return null
        return null;
    }

    /**
     * @return array
     */
    public function getAnswers(): array
    {
        return $this->answers;
    }

    /**
     * @return int
     */
    public function getThemeid(): int
    {
        return $this->themeid;
    }

    public function display(): void
    {
        echo "Question ID: " . $this->getId() . PHP_EOL;
        echo "Content: " . $this->getContent() . PHP_EOL;
        echo "Theme ID: " . $this->getThemeid() . PHP_EOL;

        echo "Answers:" . PHP_EOL;
        foreach ($this->getAnswers() as $answer) {
            echo "  Answer ID: " . $answer->getId() . PHP_EOL;
            echo "  Content: " . $answer->getContent() . PHP_EOL;
            echo "  Correct: " . ($answer->isCorrect() ? 'Yes' : 'No') . PHP_EOL;
            echo PHP_EOL;
        }
    }

    public function getRightAnswer(): ?Answer
    {
        foreach ($this->answers as $answer) {
            if ($answer->isCorrect()) {
                return $answer;
            }
        }

        // No right answer found
        throw new Exception("Il n'y a pas de réponse correcte à la question " . $this->getId());
        return null;
    }


// Méthode pour récupérer une question aléatoire depuis la base de données
    public static function getRandomQuestion(): ?Question
    {

        $dao = DAO::get();

        //Avoid getting the size of the table by ordering by random and getting only one.
        $query = "SELECT id, content, themeid FROM Questions ORDER BY RANDOM() LIMIT 1";


        $result = $dao->query($query);

        if ($result) {
            $rowData = $result[0];
            return new Question($rowData['id'], $rowData['content'], $rowData['themeid']);
        }

        // Aucune question trouvée
        return null;
    }

    public static function getRandomQuestionByEra(Era $era): ?Question
    {

        $dao = DAO::get();
        $data = array();
        $data[] = $era->value;
        //Avoid getting the size of the table by ordering by random and getting only one.
        $query = "SELECT QUESTIONS.id, QUESTIONS.content, themeid FROM QUESTIONS LEFT JOIN THEME ON QUESTIONS.themeid = THEME.ID WHERE THEME.content LIKE '?' ORDER BY RANDOM() LIMIT 1;";


        $result = $dao->query($query,$data);

        if ($result) {
            $rowData = $result[0];
            return new Question($rowData['id'], $rowData['content'], $rowData['themeid']);
        }

        // Aucune question trouvée
        return null;
    }


    public static function getQuestionsSize(): int
    {
        $dao = DAO::get();
        $query = "SELECT count(*) FROM Questions";
        $result = $dao->query($query);

        //If the return of the query isn't null
        if ($result) {
            //Get the first element of the list
            $rowData = $result[0];
            return $rowData['count'];
        }
        return 0;
    }

    public static function getQuestionFromId(int $id): ?Question
    {
        $dao = DAO::get();
        $query = "SELECT * FROM Questions WHERE id = ?";
        $data = array();
        $data[] = $id;

        $result = $dao->query($query, $data);

        if ($result) {
            $rowData = $result[0];
            return new Question($rowData['id'], $rowData['content'], $rowData['themeid']);
        }
        //Result is null
        throw new Exception("La question numéro " . $id . " n'existe pas !");
        return null;

    }

    /**
     * Add a question to database, /!\ be careful
     * @return void
     */
    public static function registerQuestion(string $content, int $themeid)
    {
        $dao = DAO::get();
        $insertquery = "INSERT INTO Questions (content, themeid) VALUES (?,?)";
        $data = array();
        $data[] = $content;
        $data[] = $themeid;

        $dao->exec($insertquery,$data);

        $result = $dao->query("SELECT id FROM Questions WHERE content = ? AND themeid = ?",$data);
        if ($result){
            echo "Votre question a été insérée sous l'id " . $result[0]['id'] . PHP_EOL;
            return;
        }
        //Insert went wrong
        throw new Exception("L'insertion de la question s'est mal passée." . PHP_EOL . "Content: " . $content . PHP_EOL . "Themeid: " . $themeid . PHP_EOL);


    }

}

?>