<?php
include_once(__DIR__."/../model/DAO.class.php");
include_once(__DIR__."/../model/Student.class.php");
include_once(__DIR__."/../model/StatPerGame.class.php");
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

    public static function getStatOf(int $playerId) : ?Stat {
        $dao = DAO::get();
        $query = "SELECT * from stat WHERE playerid=? ORDER BY gameplayed";
        $statTable = $dao->query($query, [$playerId]);
        if(count($statTable) == 0) {
            return null;
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
        return end($this->statPerGame)->getGamePlayed();
    }
    public function getGameWin() : int {
        return end($this->statPerGame)->getGameWin();
    }
    public function jsonSerialize() {
        return array(
            'statPerGame' => $this->statPerGame
        );
    }
}
?>