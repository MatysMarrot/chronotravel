//import {Party} from "../model/js/Party.mjs";
export class AbstractPacket{
    id;
    partyId;

    constructor(id, partyid) {
        //throw new TypeError("Class \"AbstractPacket\" is abstract and cannot be instanciated !");
        this.id = id;
        this.partyId = partyid;
    }

    // get id(){
    //     return this.id;
    // }
    //
    // get partyid(){
    //     return this.partyid;
    // }

    handle(partie){};
}