<?php
require_once(__DIR__ . '/DAO.class.php');
require_once(__DIR__ . '/Student.class.php');
class Stat implements JsonSerializable {
    private Student $student;
    private Array $statPerGame;

    /**
     * @param Student $student
     * @param array $statPerGame
     */
    public function __construct(Student $student, array $statPerGame) {
        $this->student = $student;
        $this->statPerGame = $statPerGame;
    }
    public function jsonSerialize() {
        return array(
            'statPerGame' => $this->statPerGame
        );
    }

    public static function getStatOf(int $playerId) : Stat {
        $dao = DAO::get();
        $query = "SELECT * from stat WHERE playerid=? ORDER BY gamePlayed";
        $statTable = $dao->query($query, [$playerId]);
        if(count($statTable) == 0) {
            throw new Exception("Stat pour l'élève {$playerId} inexistant");
        } else {
            $student = Student::readStudent($playerId);
            $stat = [];
            foreach ($statTable as $row) {
                $statPerGame = new StatPerGame($row["gameplayed"], $row["gamewon"], $row["antiquityanswer"], $row["middleageanswer"], $row["contemporaryanswer"], $row["modernanswer"], $row["antiquitycorrectanswer"], $row["middleagecorrectanswer"], $row["contemporarycorrectanswer"], $row["moderncorrectanswer"]);
                $stat[] = $statPerGame;
            }
            return new Stat($student, $stat);
        }
    }

    public function getGamePlayed() : int {
        $lastGameStat = end($this->statPerGame);
        return $lastGameStat->getGamePlayed();
    }
    public function getGameWin() : int {
        $lastGameStat = end($this->statPerGame);
        return $lastGameStat->getGameWin();
    }


}
?>