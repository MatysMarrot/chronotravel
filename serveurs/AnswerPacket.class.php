<?php

require_once(__DIR__ . '/Packet.abstract.php');
require_once(__DIR__ . '/enums/Action.enum.php');
require_once(__DIR__ . '/../model/Question.class.php');
require_once(__DIR__ . '/../model/enum/era.enum.php');

class AnswerPacket extends Packet
{
    private int $id;
    private int $pid;
    private int $nbrQuestions;
    private int $nbrRightAnswers;
    public function __construct($data)
    {
        $this->id = $data["cid"];
        $this->pid = $data["partyId"];
        $this->nbrQuestions = $data['nbrQuestions'];
        $this->nbrRightAnswers = $data['nbrRightAnswers'];

        parent::__construct($data["cid"],$data["partyId"]);


    }

function handle()
{
    // TODO: Implement handle() method.
}

public
function stringify(): string
{
    $this->data = [
        "action" => Action::ANSWER->value,
        "id" => $this->id,
        "partyId" => $this->pid,
        "nbrQuestions" => $this->nbrQuestions,
        "nbrRightAnswers" => $this->nbrRightAnswers
    ];


    return json_encode($this->data);
}
}
?>