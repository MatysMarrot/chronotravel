import {AbstractPacket} from "../AbstractPacket.mjs";
import {Player} from "../Player.mjs";

export class LeavePacket extends AbstractPacket {

    party;
    constructor(Party,data) {
        super(data.id, data.id);
        this.party = Party
    }

    handle(){
        window.location.href = "../../../controler/home.ctrl.php";
    }

}