<?php

require_once(__DIR__ . '/Packet.abstract.php');
require_once(__DIR__ . '/enums/Action.enum.php');
require_once(__DIR__ . '/../model/Question.class.php');
require_once(__DIR__ . '/../model/enum/era.enum.php');



class QuestionPacket extends Packet
{

    private $data;
    private array $students;
    private array $position;

    // casté en INT Position/31/4

    public function handle()
    {
        // TODO: Implement handle() method.
    }

    public function __construct(int $partyId, array $students,array $position)
    {
        parent::__construct(-1, $partyId);
        $this->students =$students;
        $this->questions = array();
        foreach ($students as $student){
            for ($i = 0; $i < 10; $i++) {
                $this->questions[$student->getId()][] = Question::getRandomQuestionByEra(Era::MODERN_AGES/**EnumUtils::$ENUM_ORDER[$player->getPosition() / (31 / 4)]**/);
            }
        }
    }


    public function stringify(): string
    {
        $this->data = [
            "action" => Action::QUESTION->value,
            "partyId" => self::getPartyid(),
            "id" => $this->player->getId(),
            "questions" => [
            ]

        ];

        foreach ($this->questions as $question) {
            $questionData = [
                "id" => $question->getId(),
                "content" => $question->getContent(),
                "reponses" => [],
            ];

            foreach ($question->getAnswers() as $reponse) {
                $reponseData = [
                    "id" => $reponse->getId(),
                    "questionId" => $reponse->getQuestionId(),
                    "content" => $reponse->getContent(),
                    "right" => $reponse->isCorrect(),
                ];

                $questionData['reponses'][] = $reponseData;
            }

            $this->data['questions'][] = $questionData;
        }



        return json_encode($this->data);
    }

    public function stringifyPlayers(): array
    {
        $playersData = [];

        foreach ($this->students as $student) {
            $playerData = [
                "action" => Action::QUESTION->value,
                "partyId" => self::getPartyid(),
                "id" => $student->getId(),
                "questions" => [],
            ];

            foreach ($this->questions[$student->getId()] as $question) {
                $questionData = [
                    "id" => $question->getId(),
                    "content" => $question->getContent(),
                    "themeid" => $question->getThemeid(),
                    "reponses" => [],
                ];

                foreach ($question->getAnswers() as $reponse) {
                    $reponseData = [
                        "id" => $reponse->getId(),
                        "questionId" => $reponse->getQuestionId(),
                        "content" => $reponse->getContent(),
                        "right" => $reponse->isCorrect(),
                    ];

                    $questionData['reponses'][] = $reponseData;
                }

                $playerData['questions'][] = $questionData;
            }

            $playersData[] = json_encode($playerData);
        }

        return $playersData;
    }

}

?>