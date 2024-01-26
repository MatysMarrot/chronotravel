import {AbstractPacket} from "../AbstractPacket.mjs";

export class PlayerJoinsPacket extends AbstractPacket {
    //Documentation dans packet.doc.md
    //Packet ENVOYE au debut de la partie pour notifier sa présence au serveur

    constructor(id, partyid) {
        super(id, partyid);
    }

    handle(socket){
        //Forme du packet comme définie dans la doc
        let data = {
            "action": "join",
            "id": this.id,
            "partyId": this.partyId,
        }

        //console.log("Join data: " + JSON.stringify(data));

        //Envoie le packet au serveur
        socket.send(JSON.stringify(data));
    }

}