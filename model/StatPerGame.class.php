<?php
include_once(__DIR__."/../model/DAO.class.php");
include_once(__DIR__."/../model/Student.class.php");
include_once(__DIR__."/../model/Stat.class.php");
class StatPerGame implements JsonSerializable {
    private int $gamePlayed;
    private int $gameWin;
    private int $antiquityAnswer;
    private int $middleAgeAnswer;
    private int $contemporaryAnswer;
    private int $modernAnswer;
    private int $antiquityCorrectAnswer;
    private int $middleAgeCorrectAnswer;
    private int $contemporaryCorrectAnswer;
    private int $modernCorrectAnswer;

    /**
     * @param int $gamePlayed
     * @param int $gameWin
     * @param int $antiquityAnswer
     * @param int $middleAgeAnswer
     * @param int $contemporaryAnswer
     * @param int $modernAnswer
     * @param int $antiquityCorrectAnswer
     * @param int $middleAgeCorrectAnswer
     * @param int $contemporaryCorrectAnswer
     * @param int $modernCorrectAnswer
     */
    public function __construct(int $gamePlayed, int $gameWin, int $antiquityAnswer, int $middleAgeAnswer, int $contemporaryAnswer, int $modernAnswer, int $antiquityCorrectAnswer, int $middleAgeCorrectAnswer, int $contemporaryCorrectAnswer, int $modernCorrectAnswer) {
        $this->gamePlayed = $gamePlayed;
        $this->gameWin = $gameWin;
        $this->antiquityAnswer = $antiquityAnswer;
        $this->middleAgeAnswer = $middleAgeAnswer;
        $this->contemporaryAnswer = $contemporaryAnswer;
        $this->modernAnswer = $modernAnswer;
        $this->antiquityCorrectAnswer = $antiquityCorrectAnswer;
        $this->middleAgeCorrectAnswer = $middleAgeCorrectAnswer;
        $this->contemporaryCorrectAnswer = $contemporaryCorrectAnswer;
        $this->modernCorrectAnswer = $modernCorrectAnswer;
    }

    /**
     * @return int
     */
    public function getGamePlayed(): int
    {
        return $this->gamePlayed;
    }

    /**
     * @return int
     */
    public function getGameWin(): int
    {
        return $this->gameWin;
    }

    /**
     * @return int
     */
    public function getAntiquityAnswer(): int
    {
        return $this->antiquityAnswer;
    }

    /**
     * @return int
     */
    public function getMiddleAgeAnswer(): int
    {
        return $this->middleAgeAnswer;
    }

    /**
     * @return int
     */
    public function getContemporaryAnswer(): int
    {
        return $this->contemporaryAnswer;
    }

    /**
     * @return int
     */
    public function getModernAnswer(): int
    {
        return $this->modernAnswer;
    }

    /**
     * @return int
     */
    public function getAntiquityCorrectAnswer(): int
    {
        return $this->antiquityCorrectAnswer;
    }

    /**
     * @return int
     */
    public function getMiddleAgeCorrectAnswer(): int
    {
        return $this->middleAgeCorrectAnswer;
    }

    /**
     * @return int
     */
    public function getContemporaryCorrectAnswer(): int
    {
        return $this->contemporaryCorrectAnswer;
    }

    /**
     * @return int
     */
    public function getModernCorrectAnswer(): int
    {
        return $this->modernCorrectAnswer;
    }
    public function jsonSerialize(): mixed {
        return [
            'gamePlayed' => $this->getGamePlayed(),
            'gameWin' => $this->getGameWin(),
            'antiquityAnswer' => $this->getAntiquityAnswer(),
            'middleAgeAnswer' => $this->getMiddleAgeAnswer(),
            'contemporaryAnswer' => $this->getContemporaryAnswer(),
            'modernAnswer' => $this->getModernAnswer(),
            'antiquityCorrectAnswer' => $this->getAntiquityCorrectAnswer(),
            'middleAgeCorrectAnswer' => $this->getMiddleAgeCorrectAnswer(),
            'contemporaryCorrectAnswer' => $this->getContemporaryCorrectAnswer(),
            'modernCorrectAnswer' => $this->getModernCorrectAnswer()
        ];
    }
}
?>