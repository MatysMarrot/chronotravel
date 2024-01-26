//import {Party} from "../model/js/Party.mjs";
export class AbstractPacket{
    //Classe mère de tout les packets
    //Fausse abstraction car Javascript
    //Contenu dans packet.doc.md

    id;
    partyId;

    constructor(id, partyid) {
        //throw new TypeError("Class \"AbstractPacket\" is abstract and cannot be instanciated !");
        this.id = id;
        this.partyId = partyid;
    }

    handle(partie){};
}