import {AbstractPacket} from "../AbstractPacket.mjs";
//import {Party} from "../model/js/Party.mjs";

export class MovementPacket extends AbstractPacket {

    playersMovement;
    constructor(partie, data) {
        super(-1, data.partyId);
        console.log("went here !");

        this.playersMovement = new Map();

        for (let players of data.players){
            this.playersMovement.set(players.id, players.movement);
        }

        console.log("got out of here !");


    }

    handle(partie){
        console.log("went there !");
        partie.updatePlayerPosition(this.playersMovement);
    }
}