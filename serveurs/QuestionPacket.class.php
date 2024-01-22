<?php

require_once(__DIR__ . '/Packet.abstract.php');
require_once(__DIR__ . '/enums/Action.enum.php');
require_once(__DIR__ . '/../model/Question.class.php');
require_once(__DIR__ . '/../model/enum/era.enum.php');



class QuestionPacket extends Packet
{
    private array $players;
    private $data;
    private Player $player;

    // casté en INT Position/31/4

    public function handle()
    {
        // TODO: Implement handle() method.
    }

    public function __construct(int $pid, array $players)
    {
        parent::__construct(-1, $pid);
        $this->players = $players;
        $this->questions = array();
        foreach ($players as $player){
            for ($i = 0; $i < 10; $i++) {
                $this->questions[$player->getId()][] = Question::getRandomQuestionByEra(Era::MODERN_AGES/**EnumUtils::$ENUM_ORDER[$player->getPosition() / (31 / 4)]**/);
            }
        }
    }


    public function stringify(): string
    {
        $this->data = [
            "action" => Action::QUESTION->value,
            "partyid" => self::getPartyid(),
            "cid" => $this->player->getId(),
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

        foreach ($this->players as $player) {
            $playerData = [
                "partyid" => self::getPartyid(),
                "cid" => $player->getId(),
                "questions" => [],
            ];

            foreach ($this->questions[$player->getId()] as $question) {
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

                $playerData['questions'][] = $questionData;
            }

            $playersData[] = json_encode($playerData);
        }

        return $playersData;
    }

}

?>