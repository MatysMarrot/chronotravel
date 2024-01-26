import {AbstractPacket} from "../AbstractPacket.mjs";
//import {Party} from "../model/js/Party.mjs";
export class VictoryPacket extends AbstractPacket{

    //Documentation dans packet.doc.md

    winners = [];

    constructor(Party, data) {
        super(-1, Party.id);

        //On récupère les logins en fonction des id transmits.
        for (let winner of data.winners){
            //console.log(winner);
                this.winners.push(Party.players.get(winner.id).login);
        }
    }

    get winners(){
        return this.winners;
    }

    handle(partie){
        //Appel de la fonction de gestion des gagnants.
        partie.declareWinner(this.winners);
    }






}