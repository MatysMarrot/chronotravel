import {AbstractPacket} from "../AbstractPacket.mjs";
//import {Party} from "../model/js/Party.mjs";
export class VictoryPacket extends AbstractPacket{

    winners = [];

    constructor(Party, data) {
        super(-1, Party.id);

        for (let winner of data.winners){
            console.log(winner);
                this.winners.push(Party.players.get(winner.id).login);
        }
    }

    get winners(){
        return this.winners;
    }

    handle(partie){
        partie.declareWinner(this.winners);
    }






}