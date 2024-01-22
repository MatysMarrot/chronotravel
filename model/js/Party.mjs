import "./Player.mjs";
import "./Board.mjs";
import {Board} from "./Board.mjs";
import {Tableau} from "./Tableau.mjs";
import {Player} from "./Player.mjs";
import {VictoryPacket} from "./packets/VictoryPacket.js";
import {MovementPacket} from "./packets/MovementPacket.mjs";
export class Party{
    board;
    id;
    owner;
    players;
    isOver = false;
    inMiniJeux = false;
    socket;

    constructor(board, json, socket) {
        /**
         * FORME DU JSON:
         * {
         *     partyId: int
         *     owner: int
         *     players{
         *         student{
         *             id: int
         *             login: string
         *         }
         *     }
         *
         * }
         */

        //console.log(json);

        this.board = new Tableau(board);
        this.id = json.partyId;
        this.owner = json.owner;

        this.players = [];
        Object.values(json.players).forEach(joueurs => {
            //console.log("JOEURS DANS LA CLASSE PARTY : "+ joueurs.id + joueurs.login);
            this.players[joueurs.id] = new Player(joueurs.id,joueurs.login);
            console.log(new Player(joueurs.id,joueurs.login,0));
        });


        this.socket = socket;

        this.drawPlayerPosition();
    }

    get id() {
        return this.id;
    }

    get owner() {
        return this.owner;
    }

    get players() {
        return this.players;
    }

    get board (){
        return this.board;
    }

    handlePacket(parsedData){
        let packet = null;
        //On identifie le type de packet recu !
        switch (parsedData.action) {
            //ne doit jamais arriver
            case "create": return;
            case "victory":{
                packet = new VictoryPacket(this, parsedData);
            } break;

            case "movement":{
                packet = new MovementPacket(this, parsedData);
            } break;

            case "question":{

            } break;

        }

        //TODO : verifier la classe
        if (!this.isOver && !this.inMiniJeux && packet != null) packet.handle(this);
    }

    updatePlayerPosition(playersMovement){
        for (let p of playersMovement){
            //On cherche le joueur associé
            let playerObject = this.players[p.key];

            //Si on ne le trouve pas on passe au suivant
            if (playerObject == null){
                continue;
            }

            playerObject.move(p.value);
        }
    }

    declareWinner(winners){
        //TODO : PROPER VICTORY SCREEN AND MESSAGE
        if (winners == null  || winners.length === 0){
            alert("It's too bad, but no one won...");
            return;
        }

        this.isOver = false;
        switch (winners.length) {
            case 1: {
                alert("Le gagnant est " + winners.at(0));
            } break;

            default: {
                let msg = 'Les gagants sont ';
                for (let i = 0; i < winners.length-2; i++){
                    msg += winners.at(i) + ", ";
                }

                msg += winners.at(winners.length -1) + " ! ";
                alert(msg);
            }
        }
    }

    drawPlayerPosition(){
        this.board.clear();
        for (let players of this.players){
            this.board.listeCellules.at(players.position).textContent += " " + players.student.login +" ";
        }
    }
}