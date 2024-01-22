<?php
class Stat {
    private Student $student;
    private int $gamePlayed;
    private int $gameWon;
    private int $antiquityAnswer;
    private int $middleAgeAnswer;
    private int $modernAgeAnswer;
    private int $contemporaryTimesAnswer;
    private int $antiquityCorrectAnswer;
    private int $middleAgeCorrectAnswer;
    private int $modernAgeCorrectAnswer;
    private int $contemporaryTimesCorrectAnswer;

    /**
     * @param Student $student
     * @param int $gamePlayed
     * @param int $gameWon
     * @param int $antiquityAnswer
     * @param int $middleAgeAnswer
     * @param int $modernAgeAnswer
     * @param int $contemporaryTimesAnswer
     * @param int $antiquityCorrectAnswer
     * @param int $middleAgeCorrectAnswer
     * @param int $modernAgeCorrectAnswer
     * @param int $contemporaryTimesCorrectAnswer
     */
    public function __construct(Student $student, int $gamePlayed, int $gameWon, int $antiquityAnswer, int $middleAgeAnswer, int $modernAgeAnswer, int $contemporaryTimesAnswer, int $antiquityCorrectAnswer, int $middleAgeCorrectAnswer, int $modernAgeCorrectAnswer, int $contemporaryTimesCorrectAnswer) {
        $this->student = $student;
        $this->gamePlayed = $gamePlayed;
        $this->gameWon = $gameWon;
        $this->antiquityAnswer = $antiquityAnswer;
        $this->middleAgeAnswer = $middleAgeAnswer;
        $this->modernAgeAnswer = $modernAgeAnswer;
        $this->contemporaryTimesAnswer = $contemporaryTimesAnswer;
        $this->antiquityCorrectAnswer = $antiquityCorrectAnswer;
        $this->middleAgeCorrectAnswer = $middleAgeCorrectAnswer;
        $this->modernAgeCorrectAnswer = $modernAgeCorrectAnswer;
        $this->contemporaryTimesCorrectAnswer = $contemporaryTimesCorrectAnswer;
    }

    public static function getStatOf(int $playerId) : Stat {
        $dao = DAO::get();
        $query = "SELECT * from stat WHERE playerid=?";
        $statTable = $dao->query($query, [$playerId]);
        if(count($statTable) == 0) {
            throw new Exception("Stat pour l'élève {$playerId} inexistant");
        } else if (count($statTable) > 1) {
            throw new Exception("Plusieurs stats existantes pour l'élève {$playerId}");
        } else {
            $student = Student::readStudent($playerId);
            $row = $statTable[0];
            $stat = new Stat($student, $row["numgames"], $row["numgameswon"], $row["ancienthistoryscore"], $row["middleagesscore"], $row["modernhistoryscore"], $row["contemporaryscore"], $row["ancienthistorycorrectanswers"], $row["middleagescorrectanswers"], $row["modernhistorycorrectanswers"], $row["contemporarycorrectanswers"]);
        }
        return $stat;
    }


}
?>