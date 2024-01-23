import {AbstractPacket} from "../AbstractPacket.mjs";
import {Player} from "../Player.mjs";

export class LeavePacket extends AbstractPacket {

    party;
    constructor(Party,data) {
        super(data.id, data.id);
        this.party = Party
    }

    handle(party){

        for (let joueurs of party.players){
            party.players.delete(this.id);
        }

        console.log("DELETE PLAYER: " + this.id);
        party.drawPlayerPosition();

    }

}