import {AbstractPacket} from "../AbstractPacket.mjs";
//import {Party} from "../model/js/Party.mjs";

export class MovementPacket extends AbstractPacket {

    playersMovement;
    constructor(partie, data) {
        super(-1, data.partyId);

        this.playersMovement = new Map();

        for (let players of data.players){
            //console.log(players.id,players.movement);
            this.playersMovement.set(players.id, players.movement);
        }


    }

    handle(partie){
        partie.updatePlayerPosition(this.playersMovement);
    }
}