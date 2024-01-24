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
    case CREATE = "create";
    case LEAVE = "leave";
}

function getPacketFromAction(Action $action, int $pid, array $players, $owner = null, $id = null)
{
    switch ($action) {
        case Action::MOVEMENT:
            try {
                return new MovePacket($pid, $players);
            } catch (Exception) {
                throw new Exception("Error while building packet");
            }
        case Action::VICTORY:
            try {
                return new VictoryPacket($pid, $players);
            } catch (Exception) {
                throw new Exception("Error while building packet");
            }
        case Action::QUESTION:
            try {
                return new QuestionPacket($pid, $players);
            } catch (Exception) {
                throw new Exception("Error while building packet");
            }
        case Action::JOIN:
            try {
                return new JoinPacket($pid, $players);
            } catch (Exception) {
                throw new Exception("Error while building packet");
            }
        case Action::ANSWER:
            try {
                return new AnswerPacket($pid, $players);
            } catch (Exception) {
                throw new Exception("Error while building packet");
            }
        case Action::CREATE:
            try {
                return new CreatePartyPacket($id, $pid, $owner, $players);
            } catch (Exception) {
                throw new Exception("Error while building packet");
            }
    }
}

?>