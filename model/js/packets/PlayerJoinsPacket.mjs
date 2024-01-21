import {AbstractPacket} from "../AbstractPacket.mjs";

export class PlayerJoinsPacket extends AbstractPacket {

    constructor(Partie, id, partyid, login) {
        super(id, partyId);
    }

    handle(partie){
        let data = JSON.parse(this);
        console.log(data);
        partie.send(data);
    }

}