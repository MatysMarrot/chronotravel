import {AbstractPacket} from "../AbstractPacket.mjs";


export class AnswerPacket extends AbstractPacket {

    answersBoolean;

    constructor(id, partyid, answersBoolean) {
        super(id, partyid);
        this.answersBoolean = answersBoolean;
    }

    handle(socket) {
        let data = {
            "action": "answer",
            "id": this.id,
            "partyId": this.partyId,
            "nbrQuestions": this.answersBoolean.length,
            "nbrRightAnswers": this.answersBoolean.filter((answer) => answer === true).length,
        }

        console.log("Answer data: " + JSON.stringify(data));

        socket.send(JSON.stringify(data));

    }
}