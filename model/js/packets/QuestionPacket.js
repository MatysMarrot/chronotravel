import {AbstractPacket} from "../AbstractPacket.mjs";
import {Question} from "../Question.mjs";

export class QuestionPacket extends AbstractPacket {

    //Documentation dans packet.doc.md

    questions = [];
    data;

    constructor(Party, data) {
        super(-1, Party.id);
        //Construit des questions d'après les questions passé par le serveur (voir Question.mjs)
        for (let q of data.questions){
            this.questions.push(new Question(q))
        }
        this.data = data;
    }

    handle(partie){
        //Decale le début du mini jeu
        setTimeout(() => partie.startMinigame(this), 3000);
    }

}