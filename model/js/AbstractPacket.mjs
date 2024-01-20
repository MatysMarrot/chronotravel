import "../Party.mjs";
export class AbstractPacket{
    id;
    partyId;

    constructor(id, partyId) {
        //throw new TypeError("Class \"AbstractPacket\" is abstract and cannot be instanciated !");
        this.id = id;
        this.partyId = partyId;
    }

    get id(){
        return this.id;
    }

    get partyid(){
        return this.partyid;
    }

    handle(partie);
}