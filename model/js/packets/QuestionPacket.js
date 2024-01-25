import {AbstractPacket} from "../AbstractPacket.mjs";
import {Question} from "../Question.mjs";

export class QuestionPacket extends AbstractPacket {

    questions = [];
    data;

    constructor(Party, data) {
        super(-1, Party.id);
        for (let q of data.questions){
            this.questions.push(new Question(q))
        }
        this.data = data;
    }

    handle(partie){
        setTimeout(() => partie.startMinigame(this), 300000);
    }

}