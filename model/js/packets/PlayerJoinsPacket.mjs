import {AbstractPacket} from "../AbstractPacket.mjs";

export class PlayerJoinsPacket extends AbstractPacket {

    constructor(id, partyid) {
        super(id, partyid);
    }

    handle(socket){
        let data = {
            "action": "join",
            "id": super.id,
            "partyid": super.partyId
        }

        socket.send(JSON.stringify(data));
    }

}