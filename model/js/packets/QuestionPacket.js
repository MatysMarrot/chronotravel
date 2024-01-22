import {AbstractPacket} from "../AbstractPacket.mjs";

export class QuestionPacket extends AbstractPacket {

    questions = [];

    constructor(Party, data) {
        super(-1, Party.id);
        for (let q of data.questions){
            this.questions.push(new Question(q))
        }

    }

    get winners(){
        return this.winners;
    }

    handle(partie){
        partie.declareWinner(this.winners);
    }

}