<?php
include_once(__DIR__."/../model/DAO.class.php");
include_once(__DIR__."/../model/Student.class.php");
include_once(__DIR__."/../model/StatPerGame.class.php");
class Stat implements JsonSerializable {
    private Student $student; // L'élève
    private Array $statPerGame; // Ses statistiques par partie

    /**
     * @param Student $student
     * @param array $statPerGame
     */
    public function __construct(Student $student, array $statPerGame) {
        $this->student = $student;
        $this->statPerGame = $statPerGame;
    }

    /**
     * @param int $playerId
     * @return Stat|null
     * Obtenir les statistiques d'un joueur à partir de son ID
     */
    public static function getStatOf(int $playerId) : ?Stat {
        $dao = DAO::get();
        $query = "SELECT ROW_NUMBER() OVER (ORDER BY partyid) AS nb_row, ancienthistoryscore, middleagesscore, modernhistoryscore, contemporaryscore, ancienthistorycorrectanswers, middleagescorrectanswers, modernhistorycorrectanswers, contemporarycorrectanswers, SUM(CASE WHEN won = true THEN 1 ELSE 0 END) OVER (PARTITION BY playerid) AS nb_win FROM stat WHERE playerid=?";
        $statTable = $dao->query($query, [$playerId]);
        if(count($statTable) == 0) {
            return null;
        } else {
            $student = Student::readStudent($playerId);
            $stat = [];
            foreach ($statTable as $row) {
                $statPerGame = new StatPerGame($row["nb_row"], $row["nb_win"], $row["ancienthistoryscore"], $row["middleagesscore"], $row["contemporaryscore"], $row["modernhistoryscore"], $row["ancienthistorycorrectanswers"], $row["middleagescorrectanswers"], $row["contemporarycorrectanswers"], $row["modernhistorycorrectanswers"]);
                $stat[] = $statPerGame;
            }
            return new Stat($student, $stat);
        }
    }

    /**
     * @return int
     * Obtenir le nombre de parties jouées par le joueur
     */
    public function getGamePlayed() : int {
        return end($this->statPerGame)->getGamePlayed();
    }

    /**
     * @return int
     * Obtenir le nombre de parties gagnées par le joueur
     */
    public function getGameWin() : int {
        return end($this->statPerGame)->getGameWin();
    }

    /**
     * @return array[]
     * Sérialiser en JSON l'objet
     */
    public function jsonSerialize() {
        return array(
            'statPerGame' => $this->statPerGame
        );
    }
}
?>