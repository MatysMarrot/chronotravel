<?php
class Stat {
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
        $query = "SELECT * from stat WHERE playerid=?";
        $statTable = $dao->query($query, [$playerId]);
        if(count($statTable) == 0) {
            return null;
        } else {
            $student = Student::readStudent($playerId);
            $stat = [];
            foreach ($statTable as $row) {
                $statPerGame = new StatPerGame($row["gamePlayed"], $row["gameWon"], $row["antiquityAnswer"], $row["middleAgeAnswer"], $row["contemporaryAnswer"], $row["modernAnswer"], $row["antiquityCorrectAnswer"], $row["middleAgeCorrectAnswer"], $row["contemporaryCorrectAnswer"], $row["modernCorrectAnswer"]);
                $stat[] = $statPerGame;
            }
            return new Stat($student, $stat);
        }
    }


}
?>