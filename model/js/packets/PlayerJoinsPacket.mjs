import {AbstractPacket} from "../AbstractPacket.mjs";

export class PlayerJoinsPacket extends AbstractPacket {

    constructor(id, partyid) {
        super(id, partyid);
    }

    handle(socket){
        let data = {
            "action": "join",
            "id": this.id,
            "partyId": this.partyId,
        }

        console.log("Join data: " + JSON.stringify(data));

        socket.send(JSON.stringify(data));
    }

}