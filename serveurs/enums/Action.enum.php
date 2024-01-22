<?php

require_once(__DIR__ . "/../MovePacket.class.php");
require_once(__DIR__ . "/../VictoryPacket.class.php");
require_once(__DIR__ . "/../QuestionPacket.class.php");
require_once(__DIR__ . "/../JoinPacket.class.php");
require_once(__DIR__ . "/../AnswerPacket.class.php");

enum Action: string
{
    case MOVEMENT = "movement";
    case VICTORY = "victory";
    case QUESTION = "question";
    case JOIN = "join";
    case ANSWER = "answer";
}

function getPacketFromAction(Action $action, int $pid, array $players)
{
    switch ($action) {
        case Action::MOVEMENT:
            return new MovePacket($pid, $players);
        case Action::VICTORY:
            return new VictoryPacket($pid, $players);
        case Action::QUESTION:
            return new QuestionPacket($pid, $players);
        case Action::JOIN:
            return new JoinPacket($pid, $players);
        case Action::ANSWER:
            return new AnswerPackcet($pid, $players);
    }
}

?>