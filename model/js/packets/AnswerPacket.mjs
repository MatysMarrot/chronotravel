import {AbstractPacket} from "../AbstractPacket.mjs";


export class AnswerPacket extends AbstractPacket {
    //Documentation dans packet.doc.md
    //Packet a destination du serveur des reponses du joueur
    answersBoolean;

    constructor(id, partyid, answersBoolean) {
        super(id, partyid);
        //On set une liste de réponses (des booléens)
        this.answersBoolean = answersBoolean;
    }

    handle(socket) {
        //Données du packet comme définie dans la doc
        let data = {
            "action": "answer",
            "id": this.id,
            "partyId": this.partyId,
            "nbrQuestions": this.answersBoolean.length,
            "nbrRightAnswers": this.answersBoolean.filter((answer) => answer === true).length,
        }

        //console.log("Answer data: " + JSON.stringify(data));

        //On envoie le packet sous forme de json (language commun au deux)
        socket.send(JSON.stringify(data));

    }
}