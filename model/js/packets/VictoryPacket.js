import {AbstractPacket} from "../AbstractPacket.mjs";
//import {Party} from "../model/js/Party.mjs";
export class VictoryPacket extends AbstractPacket{

    winners = [];

    constructor(Party, data) {
        super(-1, Party.id);

        for (let player of data.players){
            if (Party.players[player.id]){
                this.winners.push(Party.players[player.id].login);
            }
        }
    }

    get winners(){
        return this.winners;
    }

    handle(partie){
        partie.declareWinner(this.winners);
    }






}