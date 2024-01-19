import "./Player.mjs";
import "./Board.mjs";
import {Board} from "./Board.mjs";
import {Tableau} from "./Tableau.mjs";
import {Player} from "./Player.mjs";
export class Party{
    board;
    id;
    owner;
    players;

    constructor(board, json) {
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
         *
         */

        //console.log(json);

        this.board = new Tableau(board);
        this.id = json.partyId;
        this.owner = json.owner;

        this.players = [];
        for (const joueurs of json.players){
            this.players.push(new Player(joueurs));
        }
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

    startMinigame(canva, minigame){
        //TODO :
    }

    updatePlayerPosition(positionsPacket){
        //TODO :
    }

    drawPlayerPosition(){
        this.board.clear();
        for (let players of this.players){
            this.board.listeCellules.at(players.position).textContent += " " + players.student.login +" ";
        }
    }
}