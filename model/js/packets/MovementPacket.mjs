import {AbstractPacket} from "../AbstractPacket.mjs";
//import {Party} from "../model/js/Party.mjs";

export class MovementPacket extends AbstractPacket {

    playersMovement;
    constructor(Partie, data) {
        super(data.id, data.partyId);
        this.playersMovement = [];

        for (let players of data.players){
            this.playersMovement[players.id] = players.movement;
        }

    }

    handle(partie){
        partie.updatePlayerPosition(this.playersMovement);
    }
}