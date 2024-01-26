import {AbstractPacket} from "../AbstractPacket.mjs";
import {Player} from "../Player.mjs";

export class LeavePacket extends AbstractPacket {
//Documentation dans packet.doc.md
//Packet recu lorsqu'un joueur quitte la partie

    party;
    constructor(Party,data) {
        super(data.id, data.id);
        //n'a besoin que de l'objet partie
        this.party = Party
    }

    handle(){
        //fait quitter la partie si un joueur a quitté
        window.location.href = "../../../controler/home.ctrl.php";
    }

}