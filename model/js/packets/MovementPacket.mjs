import {AbstractPacket} from "../AbstractPacket.mjs";
//import {Party} from "../model/js/Party.mjs";

export class MovementPacket extends AbstractPacket {
    //Documentation dans packet.doc.md
    //Packet contenant la quantité de case de laquelle chaque joueur doit avancer

    playersMovement;
    constructor(partie, data) {
        super(-1, data.partyId);

        //On crée une nouvelle map ([id, nbr de cases]
        this.playersMovement = new Map();

        for (let players of data.players){
            //Pour chaque joueur dans la packet
            //On map le contenu
            this.playersMovement.set(players.id, players.movement);
        }


    }

    handle(partie){
        //Appelle la fonction qui modifie les positions des joueurs
        partie.updatePlayerPosition(this.playersMovement);
    }
}